<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\FirebaseModel;

class LoggedInMiddleware
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
        // // Get the UID from session (assuming you store it after Firebase login)
        // $uid = session('user_uid');

        // // 1️⃣ If user is logged in and trying to access the login route, redirect them
        // if ($uid && $request->routeIs('login')) {
        //     return redirect()->route('admin.dashboard');
        // }

        return $next($request);
    }
}
