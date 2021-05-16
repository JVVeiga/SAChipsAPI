<?php
namespace App\Http\Controllers\Auth;

use App\Models\Client;

class ClientAuthController extends AbstractJWT {

    public function __construct() {
        parent::__construct(Client::class, env('JWT_TOKEN_CLIENT'));
    }
}
