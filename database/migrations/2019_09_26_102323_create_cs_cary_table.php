<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsCaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_cary', function (Blueprint $table) {
            $table->bigIncrements('cary_id');
            $table->integer('user_id');
            $table->integer('goods_id');
            $table->decimal('add_price',10,2);
            $table->tinyInteger('buy_number');
            $table->integer('add_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_cary');
    }
}
