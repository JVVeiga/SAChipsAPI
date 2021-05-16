<?php
namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;

abstract class AbstractAuth {

    public static $entity;

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

            self::$entity = $this->model::where('id', $response->id)->where('email', $response->email)->first();
            if ( is_null(self::$entity) ) {
                throw new \Exception();
            }
            return $next($request);
        } catch ( \Exception $e ) {
            return response()->json(['error' => 'Não autorizado: ' . $e->getMessage()], 401);
        }
    }
}
