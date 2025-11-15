<?php

namespace App\Http\Controllers;

use App\Models\UserAuthModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(
        protected UserAuthModel $userAuthModel,
        protected UserModel $userModel
    ) {}

    public function showLoginForm(): View|RedirectResponse
    {
        if (session('user_uid')) {
            return redirect()->route('admin.dashboard');
        }

        return view('components.pages.admin');
    }
    
    public function login(Request $request): RedirectResponse
    {
        if (!$request->isMethod('post')) {
            abort(404, 'Page not found');
        }

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $email = trim($validated['email']);
        $password = trim($validated['password']);

        $user = $this->userAuthModel->login($email, $password);

        if (!$user) {
            return back()
                ->withErrors(['email' => 'Incorrect email or password'])
                ->withInput();
        }

        $userData = $this->userModel->getUser($user->firebaseUserId());

        if (!$userData) {
            return back()
                ->withErrors(['email' => 'Invalid credentials or user not found.'])
                ->withInput();
        }

        $this->storeUserSession($userData, $user->firebaseUserId());

        return redirect()->intended('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function storeUserSession(array $userData, string $firebaseUserId): void
    {
        session([
            'vendor_name' => $userData['vendor_name'],
            'food_stall' => $userData['food_stall'],
            'role' => $userData['role'],
            'email' => $userData['email'],
            'created_at' => $userData['created_at'],
            'user_uid' => $firebaseUserId,
        ]);
    }
}