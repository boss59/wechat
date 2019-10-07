<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_brand', function (Blueprint $table) {
            $table->bigIncrements('brand_id');
            $table->string('brand_name', 100);
            $table->char('brand_url', 100);
            $table->char('brand_brand', 150);
            $table->integer('brand_show')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_brand');
    }
}
