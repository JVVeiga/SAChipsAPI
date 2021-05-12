<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigCompany extends Migration {

    public function up() {
        Schema::create('config_company', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('cnpj', 18);
            $table->string('logo', 80);
        });
    }

    public function down() {
        Schema::dropIfExists('config_company');
    }
}
