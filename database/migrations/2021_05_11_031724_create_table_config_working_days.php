<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigWorkingDays extends Migration {

    public function up() {
        Schema::create('config_working_days', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name', 50);
            $table->boolean('open')->default(0);
        });
    }

    public function down() {
        Schema::dropIfExists('config_working_days');
    }
}
