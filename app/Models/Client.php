<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Client extends Model {

    protected $table = 'client';

    protected $fillable = [
        'name', 'type', 'cpf_cnpj', 'company_name', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public static function getCustomAttrs(): array {
        return [
            'name' => 'nome',
            'type' => 'tipo de pessoa',
            'cpf_cnpj' => 'CPF/CNPJ',
            'company_name' => 'razão social',
            'password' => 'senha'
        ];
    }

    public static function getRules(): array {
        return [
            'name' => 'required|min:4|max:150',
            'type' => ['required', 'min:1', 'max:1', Rule::in(['F', 'J'])],
            'cpf_cnpj' => 'required|min:11|max:18|unique:App\Models\Client,cpf_cnpj|cpf_cnpj',
            'company_name' => 'exclude_if:type,F|min:4|max:150|required',
            'email' => 'required|min:4|max:150|email|unique:App\Models\Client,email|email:rfc,dns',
            'password' => 'required|confirmed|min:6|max:100'
        ];
    }
}
