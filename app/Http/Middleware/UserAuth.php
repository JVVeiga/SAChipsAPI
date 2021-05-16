<?php
namespace App\Http\Middleware;

use App\Models\User;

class UserAuth extends AbstractAuth {

    public function __construct() {
        parent::__construct(User::class, env('JWT_TOKEN_USER'));
    }
}
