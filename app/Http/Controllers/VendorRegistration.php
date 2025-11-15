<?php 
namespace App\Http\Controllers;

use App\Models\UserAuthModel;
use Illuminate\Http\Request;
use App\Models\UserModel;

class VendorRegistration extends Controller 
{
    protected UserModel $userModel;
    protected UserAuthModel $userAuthModel;

    public function __construct()
    {
        $this->userAuthModel = new UserAuthModel();
        $this->userModel = new UserModel();
    }

    public function showVendorManagement() 
    {
        return view('components.pages.vendor-management');
    }

        public function vendorCreate(Request $request) 
        {
            // Prevent access via GET
            if ($request->isMethod('get')) {
                return redirect()->route('login');
            }

            // Validation
            $validated = $request->validate([
                'vendor_name' => 'required|string',
                'food_stall' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $email = trim($validated['email']);
            $password = trim($validated['password']);


            // Register authentication data
            $user = $this->userAuthModel->registerUser($email, $password);

            if (!$user) {
                try {
                    // Check if the email already exists in Firebase Authentication
                    $existingUser = $this->userModel->getAuth()->getUserByEmail($email);
                    if ($existingUser) {
                        return back()->withErrors('The email entered was already exists.')->withInput();
                    }
                } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                    // Email does not exist in Firebase, something else caused null
                    return back()->withErrors('User registration failed for another reason.');
                } catch (\Kreait\Firebase\Exception\AuthException $e) {
                    // Any other auth-related exception
                    return back()->withErrors('Firebase Auth Error: "' . $e->getMessage());
                }
            }

            $data = [
                'vendor_name'   => (string) $validated['vendor_name'],
                'food_stall'    => (string) $validated['food_stall'],
                'email'         => (string) $email,
                'role'          => (string) 'Vendor',
                'firebase_uid'  => (string) $user->uid,           
                'created_at'    => now()->toDateTimeString(),      
            ];
            
            session(['vendor_uid' => $data['firebase_uid']]);

            // Create vendor record
            $vendor = $this->userModel->createUser($data['firebase_uid'], $data);

            if ($vendor) {
                return redirect()
                    ->route('admin.vendorManagement')
                    ->with('success', 'Vendor created successfully!');
            }

            return back()->withErrors(['error' => 'Failed to create vendor record.']);
        }
}
