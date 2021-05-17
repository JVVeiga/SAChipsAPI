<?php
namespace App\Http\Controllers;

use App\Models\Neighborhood;

class NeighborhoodController extends Controller {

    public function __construct() {
        parent::__construct(Neighborhood::class);
    }

    public function findByCity(int $id) {
        return $this->model::where('id_city', $id)->get();
    }
}
