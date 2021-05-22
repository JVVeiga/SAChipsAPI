<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRecovery extends Model{

    protected $table = 'user_recovery';
    protected $fillable = [
        'id_user', 'token', 'validate'
    ];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public static function getCustomAttrs(): array {
        return [
            'password' => 'senha'
        ];
    }

    public static function getMessages(): array {
        return [
            'email.exists' => 'E-mail não encontrado, verifique o e-mail digitado.'
        ];
    }
}
