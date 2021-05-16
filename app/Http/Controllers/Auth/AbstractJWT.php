<?php
namespace App\Http\Controllers\Auth;

use Laravel\Lumen\Routing\Controller;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

abstract class AbstractJWT extends Controller {

    protected $model;
    protected $tokenJWT;

    public function __construct($model, $tokenJWT) {
        $this->model = $model;
        $this->tokenJWT = $tokenJWT;
    }

    public function index(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ],
        [
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'O e-mail digitado é inválido',
            'password.required' => 'A senha é obrigatória'
        ]);

        $entity = $this->model::where('email', $request->email)->first();
        if ( is_null($entity) || !Hash::check($request->password, $entity->password) ) {
            return response()->json(['error' => 'E-mail ou senha inválidos.'], 401);
        }
        $token = JWT::encode([
            'id' => $entity->id,
            'name' => $entity->name,
            'email' => $request->email,
            'exp' => time() + (env('JWT_EXP', 1440) * 60)
        ], $this->tokenJWT);

        return [
            'access_token' => $token
        ];
    }
}
