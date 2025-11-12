<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\FirebaseModel;

class RoleMiddleware
{
    protected $firebase;

    public function __construct(FirebaseModel $firebase)
    {
        $this->firebase = $firebase;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Get the UID from session (assuming you store it after Firebase login)
        $uid = session('user_uid');

        if (!$uid) {
            return redirect()->route('login');
        }

         // ✅ Use cached role if available
        if (!session()->has('user_role')) {
            try {
                $firestore = $this->firebase->getFirestore();
                $userDoc = $firestore->collection('users')->document($uid)->snapshot();

                if (!$userDoc->exists()) {
                    return redirect()->route('login')->with('error', 'User not found.');
                }

                session(['user_role' => $userDoc->get('Role') ?? 'user']);
            } catch (\Throwable $e) {
                logger()->error('Firestore role verification failed: '.$e->getMessage());
                return redirect()->route('login')->with('error', 'Unable to verify user role.');
            }
        }

        // 🧠 Get role from session (fast)
        $userRole = session('user_role');

        // 🚫 Deny access if not allowed
        if (!in_array($userRole, $roles)) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
