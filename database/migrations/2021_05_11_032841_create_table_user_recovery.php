<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserRecovery extends Migration {

    public function up() {
        Schema::create('user_recovery', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_user', false, true);
            $table->string('token', 80);
            $table->dateTime('validate', 0);
            $table->foreign('id_user', 'fk_user_id_recovery')->references('id')->on('user')->onUpdate('no action')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('user_recovery');
    }
}
