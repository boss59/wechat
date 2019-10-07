<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_goods', function (Blueprint $table) {
            $table->bigIncrements('goods_id');
            $table->string('goods_name');
            $table->string('goods_article');
            $table->integer('cate_id');
            $table->integer('brnad_id');
            $table->decimal('goods_price',10,2);
            $table->char('goods_img',191);
            $table->char('goods_imgs',191);
            $table->integer('goods_num');
            $table->longText('goods_desc',191);
            $table->integer('is_show')->default('0');
            $table->integer('is_new')->default('0');
            $table->integer('is_sell')->default('0');
            $table->integer('is_up')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_goods');
    }
}
