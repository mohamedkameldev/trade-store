<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }
        if (!in_array($user->type, $types)) {
            abort(403);
        }

        return $next($request); // return the response


        #-- if you want to edit the response:
        // $response = $next($request);
        // $response->headers->set('Accept', 'application/json');
        // dd($response->headers);
        // return response($response->getContent());  // return the response to the user
    }
}
