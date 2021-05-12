<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientOrder extends Migration {

    public function up() {
        Schema::create('client_order', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_client', false, true);
            $table->integer('id_status', false, true);
            $table->integer('id_payment_method', false, true);

            $table->string('code_gateway', 100)->nullable();
            $table->decimal('value', 8, 2, true);
            $table->integer('quantity_potato')->comment('Quantidade de batatas em gramas');
            $table->text('observation')->nullable();
            $table->time('delivery_hour');
            $table->decimal('payback', 8, 2, true)->nullable()->comment('Troco de dinheiro');
            $table->decimal('delivery_value', 8, 2, true)->default(0)->comment('Valor da entrega');

            $table->foreign('id_client', 'fk_client_id_client_order')->references('id')->on('client');
            $table->foreign('id_status', 'fk_status_id_client_order')->references('id')->on('payments_status');
            $table->foreign('id_payment_method', 'fk_payment_method_client_order')->references('id')->on('payment_methods');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('client_order');
    }
}
