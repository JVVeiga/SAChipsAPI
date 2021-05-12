<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUser extends Migration {

    public function up() {
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name', 100);
            $table->string('email', 150);
            $table->string('password', 100);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('user');
    }
}
