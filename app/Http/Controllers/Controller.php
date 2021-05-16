<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {

    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index(Request $request) {
        return $this->model::paginate($request->perPage);
    }

    public function store(Request $request) {
        return response()->json($this->model::create($request->all()), 201);
    }

    public function show(int $id) {
        $resource = $this->model::find($id);
        if ( is_null($resource) ) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 204);
        }
        return response()->json($resource);
    }

    public function update(int $id, Request $request) {
        $resource = $this->model::find($id);
        if ( is_null($resource) ) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }
        $resource->fill($request->all());
        $resource->save();
        return $resource;
    }

    public function destroy(int $id) {
        $removed = $this->model::destroy($id);
        if ( $removed === 0 ) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }
        return response()->json('', 204);
    }
}
