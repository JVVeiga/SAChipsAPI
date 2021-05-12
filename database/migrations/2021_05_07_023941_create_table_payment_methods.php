<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePaymentMethods extends Migration {

    public function up() {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name', 100);
        });
    }

    public function down() {
        Schema::dropIfExists('payment_methods');
    }
}
