<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JWTController extends Controller {

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

        $client = Client::where('email', $request->email)->first();
        if ( is_null($client) || !Hash::check($request->password, $client->password) ) {
            return response()->json(['error' => 'E-mail ou senha inválidos.'], 401);
        }
        $token = JWT::encode([
            'name' => $client->name,
            'email' => $request->email,
            'exp' => time() + (env('JWT_EXP', 1440) * 60)
        ], env('JWT_TOKEN'));

        return [
            'access_token' => $token
        ];
    }
}
