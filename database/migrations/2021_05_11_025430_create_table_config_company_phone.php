<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigCompanyPhone extends Migration {

    public function up() {
        Schema::create('config_company_phone', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('number', 15);
            $table->boolean('whatsapp')->default(0);
        });
    }

    public function down() {
        Schema::dropIfExists('config_company_phone');
    }
}
