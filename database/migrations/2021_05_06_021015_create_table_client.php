<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClient extends Migration {

    public function up() {
        Schema::create('client', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name', 150);
            $table->enum('type', ['F', 'J']);
            $table->string('cpf_cnpj', 18);
            $table->string('company_name', 150)->nullable();
            $table->string('email', 150);
            $table->string('password', 100);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('client');
    }
}
