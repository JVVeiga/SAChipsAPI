<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    protected $table = 'state';
    public $timestamps = false;

    public function cities() {
        return $this->hasMany(City::class, 'id_state');
    }
}
