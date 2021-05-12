<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNeighborhood extends Migration {

    public function up() {
        Schema::create('neighborhood', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_city', false, true);
            $table->string('name', 150);
            $table->foreign('id_city', 'fk_city_id_neighborhood')->references('id')->on('city')->onUpdate('no action')->onDelete('restrict');
        });
    }

    public function down() {
        Schema::dropIfExists('neighborhood');
    }
}
