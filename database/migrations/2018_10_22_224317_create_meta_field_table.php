<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_field', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('key_name')->nullable();
            $table->text('key_value')->nullable();

            $table->integer('article_content_id')->unsigned();
            $table->foreign('article_content_id')->references('id')->on('article_content')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meta_field');
    }
}
