<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserRecovery;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserRecoveryController extends Controller {

    public function __construct() {
        parent::__construct(UserRecovery::class);
    }

    public function sendToken(Request $request) {
        $rules = [
            'email' => 'required|min:4|max:150|email|exists:App\Models\User,email|email:rfc,dns',
        ];

        $this->validate($request, $rules, $this->model::getMessages(), []);

        $user = User::where('email', $request->email)->first();
        $token = md5(uniqid(time()) . $request->email);
        $request->merge([
            'id_user' => $user->id,
            'token'     => $token,
            'validate'  => date('Y-m-d H:i:s', strtotime('+1 day'))
        ]);

        Mail::send('user-recovery', [
            'name'  => $user->name,
            'url'   => env('ADM_URL') . '/recuperar-senha/' . $token
        ], function($message) use ($user) {
            $message->to($user->email, $user->name)->subject('Redefinir senha');
            $message->from(env('MAIL_FROM_MAIL'), 'S.A Chips');
        });
        return parent::store($request);
    }

    public function checkToken($token) {
        $recovery = UserRecovery::where('token', $token)->where('validate', '>', date('Y-m-d H:i:s'))->first();
        if ( is_null($recovery) ) {
            return response()->json(['error' => 'Recuperação de senha não encontrada ou já foi realizado a recuperação da senha.'], 404);
        }

        return response()->json([
            'name' => $recovery->user->name,
            'email' => $recovery->user->email
        ], 200);
    }

    public function setPassword($token, Request $request) {
        $recovery = UserRecovery::where('token', $token)->where('validate', '>', date('Y-m-d H:i:s'))->first();
        if ( is_null($recovery) ) {
            return response()->json(['error' => 'Recuperação de senha não encontrada ou já foi realizado a recuperação da senha.'], 404);
        }

        $rules = ['password' => 'required|confirmed|min:6|max:100'];
        $this->validate($request, $rules, $this->model::getMessages(), $this->model::getCustomAttrs());

        $user = User::find($recovery->user->id);
        $user->password = Hash::make($request->password);
        $user->save();

        $recovery->delete();
        return response()->json(['message' => 'Senha alterada com sucesso.'], 200);
    }
}
