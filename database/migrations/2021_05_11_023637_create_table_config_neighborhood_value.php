<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigNeighborhoodValue extends Migration {

    public function up() {
        Schema::create('config_neighborhood_value', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_neighborhood', false, true);
            $table->decimal('value', 8, 2, true);
            $table->foreign('id_neighborhood', 'fk_neighborhood_id_cfg_negb_value')->references('id')->on('neighborhood');
        });
    }

    public function down() {
        Schema::dropIfExists('config_neighborhood_value');
    }
}
