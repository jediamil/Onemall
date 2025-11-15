<?php   
    namespace App\Http\Controllers;
    use App\Models\UserAuthModel;
    use Illuminate\Http\Request;
    use App\Models\FirebaseModel;
    use App\Models\UserModel;

    class LoginController extends Controller {
        protected UserAuthModel $userAuthModel;
        protected UserModel $userModel;

        public function __construct() {
            $this->userAuthModel = new UserAuthModel();
            $this->userModel = new UserModel();
        }

        //  SHOW THE USER INTERFACE
        public function showLoginForm() {
            return view('components.pages.admin');
        }
        
        // LOGIN REQUEST
        public function login(Request $request): \Illuminate\Http\RedirectResponse {
            // Validate request method
            if ($request->isMethod('get')) {
                return redirect()->route('login');
            }

            // Validate the request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            $email = trim($request->input('email'));
            $password = trim($request->input('password'));

            // Attempt to login via Firebase
            $user = $this->userAuthModel->login($email, $password);

            if (!$user) {
                // Login failed — redirect back with an error message
                return back()->withErrors([
                    'email' => 'Incorrect email or password'
                ])->withInput(); // keeps the email field populated
            }

            // Attempt to get the current user from firestore
            $getUser = $this->userModel->getUser($user->firebaseUserId());

            // If UID of current user does not found, return redirection
            if (!$getUser) {
                return redirect()->route('login')->with('error', 'Invalid credentials or user not found.');
            }

            // If successfully found the user in firestore, saved data in session
            session([
                'vendor_name' => $getUser['vendor_name'],
                'food_stall' => $getUser['food_stall'],
                'role' => $getUser['role'],
                'email' => $getUser['email'],
                'created_at' => $getUser['created_at'],
                'user_uid' => $user->firebaseUserId(),
            ]);

            
            // Redirect to intended page
            return redirect()->intended('dashboard');
        }


        // LOG OUT REQUEST
        public function logout(Request $request)
        {
            // Clear the Firebase user from session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Optional: clear all session data
            // $request->session()->flush();

            // Redirect to login page
            return redirect()->route('login');
        }
    }