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
        public function showLoginForm(): string {
            return view('components.pages.admin');
        }
        

        // LOGIN REQUEST
        public function login(Request $request) {
            // Validate request method
            if ($request->isMethod('get')) {
                return redirect()->route('login');
            }

            // Validate the request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            $email = trim($request->email);
            $password = trim($request->password);

            // Attempt to login via Firebase
            $user = $this->userAuthModel->login($email, $password);

            if (!$user) {
                // Login failed — redirect back with an error message
                return back()->withErrors([
                    'email' => 'Incorrect email or password'
                ])->withInput(); // keeps the email field populated
            }

            // Login successful — store Firebase UID in session
            session(['user_uid' => $user->firebaseUserId()]);
            $uid = session('user_uid');
            $getUser = $this->userModel->getUser($uid);

            session([
                'vendor_name' => $getUser['vendor_name'],
                'food_stall' => $getUser['food_stall'],
                'role' => $getUser['role'],
                'email' => $getUser['email'],
                'created_at' => $getUser['created_at'],
            ]);

            // Redirect to intended page
            return redirect()->intended('dashboard');
        }


        // LOG OUT REQUEST
        public function logout(Request $request)
        {
            // Clear the Firebase user from session
            $request->session()->forget('user_uid');

            // Optional: clear all session data
            // $request->session()->flush();

            // Redirect to login page
            return redirect()->route('login');
        }
    }