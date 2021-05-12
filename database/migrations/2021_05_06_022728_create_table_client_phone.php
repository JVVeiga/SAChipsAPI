<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientPhone extends Migration {

    public function up() {
        Schema::create('client_phone', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_client', false, true);
            $table->string('number', 15);
            $table->boolean('whatsapp')->default(0);
            $table->foreign('id_client', 'fk_client_id_phone')->references('id')->on('client')->onUpdate('no action')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('client_phone');
    }
}
