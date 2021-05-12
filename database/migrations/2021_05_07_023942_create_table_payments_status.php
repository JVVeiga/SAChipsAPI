<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePaymentsStatus extends Migration {

    public function up() {
        Schema::create('payments_status', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name', 100);
        });
    }

    public function down() {
        Schema::dropIfExists('payments_status');
    }
}
