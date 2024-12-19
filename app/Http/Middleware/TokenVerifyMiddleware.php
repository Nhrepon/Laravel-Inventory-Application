<?php

namespace App\Http\Middleware;

use App\Helper\JwtToken;
use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->header('token');
        $result = JwtToken::verifyToken($token);
        if($result == "unauthorized"){
            return response()->json([
                'status'=>'unauthorized',
                'message'=>'Verification failed',
            ]);
        }else{
            $request->headers->set('email', $result->email);
            return $next($request);
        }
    }
}
