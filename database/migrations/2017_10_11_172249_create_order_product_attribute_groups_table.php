<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_attribute_groups', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_product_detail_id')->unsigned();
            $table->foreign('order_product_detail_id', 'order_groups_order_sp_details_id')->references('id')->on('order_product_details');
            $table->integer('order_product_attribute_id')->unsigned();
            $table->foreign('order_product_attribute_id', 'order_groups_order_attr_id')->references('id')->on('order_product_attributes');
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
        Schema::drop('order_product_attribute_groups');
    }
}
