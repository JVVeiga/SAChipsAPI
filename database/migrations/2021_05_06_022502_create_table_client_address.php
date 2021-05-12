<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientAddress extends Migration {

    public function up() {
        Schema::create('client_address', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_client', false, true);
            $table->integer('id_neighborhood', false, true);
            $table->string('zip_code', 8);
            $table->string('address', 150);
            $table->string('number', 50);
            $table->string('complement', 50);
            $table->foreign('id_client', 'fk_client_id_address')->references('id')->on('client')->onUpdate('no action')->onDelete('cascade');
            $table->foreign('id_neighborhood', 'fk_neighborhood_id_client_address')->references('id')->on('client')->onUpdate('no action')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('client_address');
    }
}
