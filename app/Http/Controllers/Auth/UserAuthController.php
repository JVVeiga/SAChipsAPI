<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;

class UserAuthController extends AbstractJWT {

    public function __construct() {
        parent::__construct(User::class, env('JWT_TOKEN_USER'));
    }
}
