<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($user = Auth::user()) {
            switch ($user->user_role) {
                case 'admin':
                    break;

                case 'user':
                    Auth::logout();
                    return redirect()->route('loginPage');               
                    break;

                default:
                    Auth::logout();
                    return redirect()->route('loginPage');
                    break;
            }
        }
        else{
            Auth::logout();
            return redirect()->route('loginPage');
        }
        return $next($request);
    }
}

