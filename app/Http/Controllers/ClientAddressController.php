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

    public function store(Request $request) {
        $this->validate($request, $this->model::getRules(), [], $this->model::getCustomAttrs());

        $request->merge(['id_client' => AbstractAuth::$entity->id]);
        return parent::store($request);
    }

    public function update(int $id, Request $request) {
        $this->validate($request, $this->model::getRules(), [], $this->model::getCustomAttrs());

        $resource = $this->model::where('id_client', AbstractAuth::$entity->id)->find($id);
        if ( is_null($resource) ) {
            return response()->json(['error' => 'Endereço não encontrado.'], 404);
        }
        $resource->fill($request->all());
        $resource->save();
        return $resource;
    }

    public function destroy(int $id) {
        $removed = $this->model::where('id', $id)->where('id_client', AbstractAuth::$entity->id)->delete();
        if ( $removed === 0 ) {
            return response()->json(['error' => 'Endereço não encontrado.'], 404);
        }
        return response()->json(['success' => 'Endereço deletado com sucesso.'], 203);
    }
}
