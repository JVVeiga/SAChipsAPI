<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigCompanyAddress extends Migration {

    public function up() {
        Schema::create('config_company_address', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('id_neighborhood', false, true);
            $table->string('zip_code', 8);
            $table->string('address', 150);
            $table->string('number', 50);
            $table->string('complement', 50);
            $table->foreign('id_neighborhood', 'fk_neighborhood_id_cfg_company_adrss')->references('id')->on('client')->onUpdate('no action')->onDelete('restrict');
        });
    }

    public function down() {
        Schema::dropIfExists('config_company_address');
    }
}
