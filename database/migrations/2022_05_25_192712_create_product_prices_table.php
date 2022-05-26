<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->float('retail')->unsigned()->nullable();
            $table->float('retail_old')->unsigned()->nullable();
            $table->float('purchase')->unsigned()->nullable();
            $table->float('purchase_old')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('product_id', 'price_to_products')
                ->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_prices');
    }
}
