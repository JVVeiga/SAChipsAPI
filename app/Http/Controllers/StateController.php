<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller {

    public function __construct() {
        parent::__construct(State::class);
    }

    public function index(Request $request) {
        return $this->model::all();
    }
}
