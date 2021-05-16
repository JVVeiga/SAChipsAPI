<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller {

    public function __construct() {
        parent::__construct(Client::class);
    }

    public function store(Request $request) {
        $this->validate($request, $this->model::getRules(), [], $this->model::getCustomAttrs());
        return parent::store($request);
    }
}
