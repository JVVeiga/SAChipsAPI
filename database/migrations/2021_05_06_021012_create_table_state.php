<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableState extends Migration {
    public function up() {
        Schema::create('state', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name', 50);
            $table->string('uf', 2);
        });
    }

    public function down() {
        Schema::dropIfExists('state');
    }
}
