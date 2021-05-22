<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'user';

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function recoveries() {
        return $this->hasMany(UserRecovery::class, 'id_user');
    }

    public static function getCustomAttrs(): array {
        return [
            'name' => 'nome',
            'password' => 'senha'
        ];
    }

    public static function getRules(): array {
        return [
            'name' => 'required|min:4|max:100',
            'email' => 'required|min:4|max:150|email|unique:App\Models\User,email|email:rfc,dns',
            'password' => 'required|confirmed|min:6|max:100'
        ];
    }
}
