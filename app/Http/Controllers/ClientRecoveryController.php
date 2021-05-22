<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ClientRecovery;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientRecoveryController extends Controller {

    public function __construct() {
        parent::__construct(ClientRecovery::class);
    }

    public function sendToken(Request $request) {
        $rules = [
            'email' => 'required|min:4|max:150|email|exists:App\Models\Client,email|email:rfc,dns',
        ];

        $this->validate($request, $rules, $this->model::getMessages(), []);

        $client = Client::where('email', $request->email)->first();
        $token = md5(uniqid(time()) . $request->email);
        $request->merge([
            'id_client' => $client->id,
            'token'     => $token,
            'validate'  => date('Y-m-d H:i:s', strtotime('+1 day'))
        ]);

        Mail::send('client-recovery', [
            'name'  => $client->name,
            'url'   => env('APP_URL') . '/recuperar-senha/' . $token
        ], function($message) use ($client) {
            $message->to($client->email, $client->name)->subject('Redefinir senha');
            $message->from('contato@joaoveiga.com.br', 'S.A Chips');
        });
        return parent::store($request);
    }

    public function checkToken($token) {
        $recovery = ClientRecovery::where('token', $token)->where('validate', '>', date('Y-m-d H:i:s'))->first();
        if ( is_null($recovery) ) {
            return response()->json(['error' => 'Recuperação de senha não encontrada ou já foi realizado a recuperação da senha.'], 404);
        }

        return response()->json([
            'name' => $recovery->client->name,
            'email' => $recovery->client->email
        ], 200);
    }

    public function setPassword($token, Request $request) {
        $recovery = ClientRecovery::where('token', $token)->where('validate', '>', date('Y-m-d H:i:s'))->first();
        if ( is_null($recovery) ) {
            return response()->json(['error' => 'Recuperação de senha não encontrada ou já foi realizado a recuperação da senha.'], 404);
        }

        $rules = ['password' => 'required|confirmed|min:6|max:100'];
        $this->validate($request, $rules, $this->model::getMessages(), $this->model::getCustomAttrs());

        $client = Client::find($recovery->client->id);
        $client->password = Hash::make($request->password);
        $client->save();

        $recovery->delete();
        return response()->json(['message' => 'Senha alterada com sucesso.'], 200);
    }
}
