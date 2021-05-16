<?php
namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;

abstract class AbstractAuth {

    protected $model;
    protected $tokenJWT;

    public function __construct($model, $tokenJWT) {
        $this->model = $model;
        $this->tokenJWT = $tokenJWT;
    }

    public function handle(Request $request, \Closure $next) {
        try {
            if ( !$request->hasHeader('Authorization') ) {
                throw new \Exception();
            }

            $headerAuth = $request->header('Authorization');
            $bearerToken = str_replace(['Bearer', ' '], '', $headerAuth);

            $response = JWT::decode($bearerToken, $this->tokenJWT, ['HS256']);

            $entity = $this->model::where('email', $response->email)->first();
            if ( is_null($entity) ) {
                throw new \Exception();
            }
            return $next($request);
        } catch ( \Exception $e ) {
            return response()->json(['error' => 'Não autorizado: ' . $e->getMessage()], 401);
        }
    }
}
