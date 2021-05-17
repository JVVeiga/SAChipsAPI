<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller {

    public function __construct() {
        parent::__construct(City::class);
    }

    public function findByState(int $id) {
        return $this->model::where('id_state', $id)->get();
    }
}
