<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_address', function (Blueprint $table) {
            $table->bigIncrements('address_id');
            $table->char('address_name');
            $table->integer('user_id');
            $table->char('consignee');
            $table->char('email');
            $table->integer('province');
            $table->integer('city');
            $table->integer('district');
            $table->char('address');
            $table->char('zipcode');
            $table->char('tel');
            $table->char('mobile');
            $table->char('sign_building');
            $table->integer('best_time');
            $table->integer('is_delete')->default('1');
            $table->integer('is_deff')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_address');
    }
}
