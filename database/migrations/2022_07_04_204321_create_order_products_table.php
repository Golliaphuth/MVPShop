<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->softDeletes();

            $table->foreign('order_id', 'foreign_order_products_orders')
                ->references('id')->on('orders')->onDelete('cascade');

            $table->foreign('product_id', 'foreign_order_products_products')
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
        Schema::table('order_products', function(Blueprint $table) {
            $table->dropForeign('foreign_order_products_orders');
            $table->dropForeign('foreign_order_products_products');
        });
        Schema::dropIfExists('order_products');
    }
}
