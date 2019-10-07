<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_info', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->string('order_sn');
            $table->mediumInteger('user_id');
            $table->tinyInteger('order_status');
            $table->tinyInteger('shipping_status');
            $table->tinyInteger('pay_status');
            $table->string('consignee');
            $table->mediumInteger('province');
            $table->mediumInteger('city');
            $table->mediumInteger('country');
            $table->mediumInteger('district');
            $table->char('address');
            $table->char('zipcode');
            $table->char('tel');
            $table->char('mobile');
            $table->char('email');
            $table->char('best_time');
            $table->char('sign_building');
            $table->char('postscript');
            $table->tinyInteger('shipping_id');
            $table->string('shipping_name');
            $table->tinyInteger('pay_id');
            $table->string('pay_name');
            $table->decimal('goods_amount',10,2);
            $table->decimal('shipping_fee',10,2);
            $table->decimal('order_amount',10,2);
            $table->integer('add_time');
            $table->integer('confirm_time');
            $table->integer('pay_time');
            $table->integer('shipping_time');
            $table->integer('grade');
            $table->char('goods_id');
            $table->char('address_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_info');
    }
}
