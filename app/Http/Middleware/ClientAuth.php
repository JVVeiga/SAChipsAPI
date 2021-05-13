<?php
namespace App\Http\Middleware;

use App\Models\Client;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class ClientAuth {

    public function handle(Request $request, \Closure $next) {
        try {
            if ( !$request->hasHeader('Authorization') ) {
                throw new \Exception();
            }

            $headerAuth = $request->header('Authorization');
            $bearerToken = str_replace(['Bearer', ' '], '', $headerAuth);

            $response = JWT::decode($bearerToken, env('JWT_TOKEN'), ['HS256']);

            $client = Client::where('email', $response->email)->first();
            if ( is_null($client) ) {
                throw new \Exception();
            }
            return $next($request);
        } catch ( \Exception $e ) {
            return response()->json(['error' => 'Não autorizado: ' . $e->getMessage()], 401);
        }
    }
}
