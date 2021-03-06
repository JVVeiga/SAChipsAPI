<?php
namespace App\Http\Middleware;

use App\Models\Client;

class ClientAuth extends AbstractAuth {

    public function __construct() {
        parent::__construct(Client::class, env('JWT_TOKEN_CLIENT'));
    }
}
