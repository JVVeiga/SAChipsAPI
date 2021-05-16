<?php
namespace App\Http\Controllers;

use App\Http\Middleware\AbstractAuth;
use Illuminate\Http\Request;
use App\Models\ClientAddress;

class ClientAddressController extends Controller {

    public function __construct() {
        parent::__construct(ClientAddress::class);
    }

    public function index(Request $request) {
        return $this->model::where('id_client', AbstractAuth::$entity->id)->with(['neighborhood', 'neighborhood.city', 'neighborhood.city.state'])->paginate($request->perPage);
    }
}
