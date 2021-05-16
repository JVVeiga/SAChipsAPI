<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model {

    protected $table = 'client_address';
    protected $fillable = [
        'id_neighborhood', 'zip_code', 'address', 'number', 'complement'
    ];

    public $timestamps = false;

    public function client() {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function neighborhood() {
        return $this->belongsTo(Neighborhood::class, 'id_neighborhood', 'id');
    }
}
