<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPhone extends Model {

    protected $table = 'client_phone';

    protected $fillable = [
        'id_client', 'number', 'whatsapp'
    ];

    public function client() {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public static function getCustomAttrs(): array {
        return [
            'number' => 'Número',
            'boolean' => 'Whatsapp'
        ];
    }

    public static function getRules(): array {
        return [
            'number' => ['required', 'min:10', 'max:15'],
            'whatsapp' => 'boolean',
        ];
    }
}
