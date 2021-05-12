<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigValues extends Migration {

    public function up() {
        Schema::create('config_values', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->decimal('delivery_fee', 8, 2, true);
            $table->decimal('standard_gram_value', 8, 2, true);
            $table->decimal('maximum_grams_day', 8, 2, true);
            $table->decimal('minimum_amount_potato', 8, 2, true);
        });
    }

    public function down() {
        Schema::dropIfExists('config_values');
    }
}
