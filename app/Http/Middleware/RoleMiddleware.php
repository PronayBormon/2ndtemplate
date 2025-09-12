<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // If not authenticated OR role not allowed
        if (! $user || ! in_array($user->role, $roles)) {

            // 1) If token-based (Sanctum personal access token), delete current access token
            // if ($user && method_exists($user, 'currentAccessToken')) {
            //     // Deletes only the current token (safe). To log out everywhere use $user->tokens()->delete()
            //     $user->currentAccessToken()?->delete();
            // }

            // 2) If using session (cookie-based / web guard), logout that guard explicitly
            try {
                $webGuard = Auth::guard('web');
                if ($webGuard instanceof SessionGuard) {
                    $webGuard->logout();
                }
            } catch (\Throwable $e) {
                // guard may not support logout — ignore
            }

            // 3) Invalidate session and regenerate CSRF token if session exists
            if ($request->hasSession()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            // 4) Respond appropriately: JSON for API clients, redirect for web
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }

            return redirect()->route('login')->with('t-error', 'You cannot access this dashboard.');
        }


        return $next($request);
    }
}
