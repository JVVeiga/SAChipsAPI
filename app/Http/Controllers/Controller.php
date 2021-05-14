<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {

    protected $class;

    public function index(Request $request) {
        return $this->class::paginate($request->perPage);
    }

    public function store(Request $request) {
        return response()->json($this->class::create($request->all()), 201);
    }

    public function show(int $id) {
        $resource = $this->class::find($id);
        if ( is_null($resource) ) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 204);
        }
        return response()->json($resource);
    }

    public function update(int $id, Request $request) {
        $resource = $this->class::find($id);
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
        $removed = $this->class::destroy($id);
        if ( $removed === 0 ) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }
        return response()->json('', 204);
    }
}
