<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function __construct() {
        parent::__construct(User::class);
    }

    public function store(Request $request) {
        $this->validate($request, $this->model::getRules(), [], $this->model::getCustomAttrs());
        return parent::store($request);
    }
}
