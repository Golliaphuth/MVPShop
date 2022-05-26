<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductToAttributeTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_to_attribute_translates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_to_attribute_id')->unsigned();
            $table->string('lang', 2);
            $table->text('value')->nullable();

            $table->foreign('product_to_attribute_id')
                ->references('id')->on('product_to_attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_to_attribute_translates');
    }
}
