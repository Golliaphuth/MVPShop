<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('barcode')->nullable();
            $table->string('vendorCode')->nullable();
            $table->integer('balance')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('slug')->unique();
            $table->string('brand_ref')->nullable();
            $table->string('category_ref')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('brand_id', 'brands_to_products')
                ->references('id')->on('brands');

            $table->foreign('category_id', 'category_to_products')
                ->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
