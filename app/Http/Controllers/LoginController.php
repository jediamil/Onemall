<?php   
    namespace App\Http\Controllers;
    use App\Models\UserAuthModel;
    use Illuminate\Http\Request;
    use App\Models\FirebaseModel;

    class LoginController extends Controller {
        protected UserAuthModel $authModel;
        protected $firebase;

            public function __construct(FirebaseModel $firebase)
        {
            $this->authModel = new UserAuthModel();
            $this->firebase = $firebase;
        }

        //  SHOW THE USER INTERFACE
        public function showLoginForm(): string {
            return view('components.pages.admin');
        }
        

        // LOGIN REQUEST
        public function login(Request $request)
        {
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
            $user = $this->authModel->login($email, $password);

            if ($user === null) {
                // Login failed — redirect back with an error message
                return back()->withErrors([
                    'email' => 'Incorrect email or password'
                ])->withInput(); // keeps the email field populated
            }

            // Login successful — store Firebase UID in session
            session(['user_uid' => $user->firebaseUserId()]);
            $uid = session('user_uid');

        
            // ✅ Use cached name if available
            if (!session()->has('account_name')) {
                try {
                    $firestore = $this->firebase->getFirestore();
                    $userDoc = $firestore->collection('users')->document($uid)->snapshot();

                    // Get user data safely
                    $accountName = $userDoc->get('Account') ?? 'Guest user';

                    // Store in session
                    session(['account_name' => $accountName]);

                } catch (\Throwable $e) {
                    logger()->error('Firestore role verification failed: ' . $e->getMessage());
                    return redirect()->route('login')->with('error', 'Unable to verify user role.');
                }
            }
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