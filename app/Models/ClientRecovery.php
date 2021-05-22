<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRecovery extends Model{

    protected $table = 'client_recovery';
    protected $fillable = [
        'id_client', 'token', 'validate'
    ];
    public $timestamps = false;

    public function client() {
        return $this->belongsTo(Client::class, 'id_client');
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
