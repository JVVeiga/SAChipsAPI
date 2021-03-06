<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientOrderAddress extends Migration {

    public function up() {
        Schema::create('client_order_address', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_order', false, true);
            $table->integer('id_neighborhood', false, true);
            $table->string('zip_code', 8);
            $table->string('address', 150);
            $table->string('number', 50);
            $table->string('complement', 50)->nullable();
            $table->foreign('id_order', 'fk_order_id_client_order')->references('id')->on('client_order')->onUpdate('no action')->onDelete('cascade');
            $table->foreign('id_neighborhood', 'fk_neighborhood_id_client_order_address')->references('id')->on('neighborhood')->onUpdate('no action')->onDelete('restrict');
        });
    }

    public function down() {
        Schema::dropIfExists('client_order_address');
    }
}
