<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCity extends Migration {

    public function up() {
        Schema::create('city', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_state', false, true);
            $table->string('name', 100);
            $table->foreign('id_state', 'fk_state_id_city')->references('id')->on('state')->onUpdate('no action')->onDelete('restrict');
        });
    }

    public function down() {
        Schema::dropIfExists('city');
    }
}
