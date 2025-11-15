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
        $uid = session('user_uid');

        if (!$uid) {
            return redirect()->route('login');
        }

        $role = session('role');

        if (!in_array($role, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
