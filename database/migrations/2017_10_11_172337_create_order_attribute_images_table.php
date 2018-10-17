<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAttributeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_attribute_images', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_product_attribute_id')->unsigned();
            $table->foreign('order_product_attribute_id')->references('id')->on('order_product_attributes');
            $table->integer('order_product_id')->unsigned();
            $table->foreign('order_product_id')->references('id')->on('order_products');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_attribute_images');
    }
}
