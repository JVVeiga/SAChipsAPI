<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    protected $table = 'client';

    protected $fillable = [
        'name', 'type', 'cpf_cnpj', 'company_name', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];
}
