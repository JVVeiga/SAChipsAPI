<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientRecovery extends Migration {

    public function up() {
        Schema::create('client_recovery', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_client', false, true);
            $table->string('token', 80);
            $table->dateTime('validate', 0);
            $table->foreign('id_client', 'fk_client_id_recovery')->references('id')->on('client')->onUpdate('no action')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('client_recovery');
    }
}
