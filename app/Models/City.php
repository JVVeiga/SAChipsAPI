<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    protected $table = 'city';
    public $timestamps = false;

    public function state() {
        return $this->belongsTo(State::class, 'id_state');
    }

    public function neighborhoods() {
        return $this->hasMany(Neighborhood::class, 'id_city');
    }
}
