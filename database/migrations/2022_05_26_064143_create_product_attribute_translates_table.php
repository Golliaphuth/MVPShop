<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_translates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_attribute_id')->unsigned();
            $table->string('lang', 2);
            $table->string('name');

            $table->foreign('product_attribute_id', 'attribute_to_translate')
                ->references('id')->on('product_attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_translates');
    }
}
