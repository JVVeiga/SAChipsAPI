<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller {

    public function __construct() {
        $this->class = Client::class;
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required',
            'type' => 'required',
            'cpf_cnpj' => 'required|unique:App\Models\Client,cpf_cnpj|cpf_cnpj',
            'company_name' => 'exclude_if:type,F|required',
            'email' => 'required|email|unique:App\Models\Client,email',
            'password' => 'required|confirmed|min:6'
        ];
        $messages = [
            'name.required' => 'O nome é obrigatório.',
            'type.required' => 'O tipo de pessoa é obrigatório.',
            'cpf_cnpj.required' => 'O CPF/CNPJ é obrigatório.',
            'cpf_cnpj.unique' => 'O CPF/CNPJ digitado já está cadastrado.',
            'company_name.required' => 'A razão social é obrigatória.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail digitado é inválido.',
            'email.unique' => 'O e-mail digitado já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação de senha não é igual a senha digitada.',
            'password.min' => 'A senha deve ter um tamanho mínimo de :min.'
        ];

        $this->validate($request, $rules, $messages);

        $request->password = Hash::make($request->password);
        return parent::store($request);
    }
}
