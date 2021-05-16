<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model{

    protected $table = 'neighborhood';
    public $timestamps = false;

    public function city() {
        return $this->belongsTo(City::class, 'id_city');
    }
}
