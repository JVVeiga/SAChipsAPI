<?php
namespace App\Http\Controllers;

use App\Http\Middleware\AbstractAuth;
use Illuminate\Http\Request;
use App\Models\ClientPhone;
use Illuminate\Validation\Rule;

class ClientPhoneController extends Controller {

    public function __construct() {
        parent::__construct(ClientPhone::class);
    }

    public function store(Request $request) {
        $rules = $this->model::getRules();
        $rules['number'][] = Rule::unique('client_phone')->where('id_client', AbstractAuth::$entity->id);

        $this->validate($request, $rules, [], $this->model::getCustomAttrs());

        $request->merge(['id_client' => AbstractAuth::$entity->id]);
        return parent::store($request);
    }

    public function update(int $id, Request $request) {
        $rules = $this->model::getRules();
        $rules['number'][] = Rule::unique('client_phone')->where('id', '<>', $id)->where('id_client', AbstractAuth::$entity->id);

        $this->validate($request, $rules, [], $this->model::getCustomAttrs());

        $resource = $this->model::where('id_client', AbstractAuth::$entity->id)->find($id);
        if ( is_null($resource) ) {
            return response()->json(['error' => 'Telefone não encontrado.'], 404);
        }
        $resource->fill($request->all());
        $resource->save();
        return $resource;
    }

    public function destroy(int $id) {
        if ( $this->model::where('id_client', AbstractAuth::$entity->id)->count() <= 1 ) {
            return response()->json(['error' => 'Você precisa ter pelo menos 1 telefone cadastrado.'], 404);
        }
        $removed = $this->model::where('id', $id)->where('id_client', AbstractAuth::$entity->id)->delete();
        if ( $removed === 0 ) {
            return response()->json(['error' => 'Telefone não encontrado.'], 404);
        }
        return response()->json(['success' => 'Telefone deletado com sucesso.'], 203);
    }
}
