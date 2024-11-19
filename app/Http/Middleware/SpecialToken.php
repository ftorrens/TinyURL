<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $array_token = str_split($request->bearerToken());
        $array_token_copy = $array_token;

        $values_allow = [
            '(' => ')',
            '[' => ']',
            '{' => '}',
        ];

        foreach ($array_token as $val) {
            if (!in_array($val, $values_allow) && !array_key_exists($val, $values_allow)) {
                return response()->json([
                    'status' => 'Error',
                    'mensaje' => 'Your token is invalid'
                ], 401);
            } else {

                if (in_array($val, $values_allow)) {
                    $clave = array_search($val, $array_token_copy);
                    if (array_key_exists($clave - 1, $array_token_copy)) {
                        if ($array_token_copy[$clave - 1] == array_search($val, $values_allow)) {
                            array_splice($array_token_copy, $clave - 1, 2);
                        } else {
                            return response()->json([
                                'status' => 'Error',
                                'mensaje' => 'Your token is invalid'
                            ], 401);
                        }
                    }
                }

            }
        }

        if (count($array_token_copy) > 0) {
            return response()->json([
                'status' => 'Error',
                'mensaje' => 'Your token is invalid'
            ], 401);
        }

        return $next($request);
    }
}
