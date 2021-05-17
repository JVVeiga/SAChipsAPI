<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model {

    protected $table = 'client_address';
    protected $fillable = [
        'id_client', 'id_neighborhood', 'zip_code', 'address', 'number', 'complement'
    ];

    public function client() {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function neighborhood() {
        return $this->belongsTo(Neighborhood::class, 'id_neighborhood', 'id');
    }

    public static function getCustomAttrs(): array {
        return [
            'id_neighborhood' => 'Bairro',
            'zip_code' => 'CEP',
            'address' => 'Endereço',
            'number' => 'Número',
            'complement' => 'Complemento'
        ];
    }

    public static function getRules(): array {
        return [
            'id_neighborhood' => 'required|exists:App\Models\Neighborhood,id',
            'zip_code' => 'required|min:8|max:8',
            'address' => 'required|min:4|max:150',
            'number' => 'required|min:3|max:50',
            'complement' => 'max:50'
        ];
    }
}
