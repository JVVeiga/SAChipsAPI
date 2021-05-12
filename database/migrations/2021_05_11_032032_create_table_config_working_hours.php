<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigWorkingHours extends Migration {

    public function up() {
        Schema::create('config_working_hours', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_working_day', false, true);
            $table->time('hour_initial');
            $table->time('hour_final');
            $table->foreign('id_working_day', 'fk_working_day_id_cfg_work_hour')->references('id')->on('config_working_days');
        });
    }

    public function down() {
        Schema::dropIfExists('config_working_hours');
    }
}
