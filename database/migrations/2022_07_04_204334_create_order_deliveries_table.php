<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_deliveries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('delivery_id')->unsigned();
            $table->string('type')->nullable();
            $table->string('city_ref')->nullable();
            $table->string('city')->nullable();
            $table->string('warehouse_ref')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('street_ref')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('flat')->nullable();
            $table->timestamps();

            $table->foreign('order_id', 'foreign_order_deliveries_orders')
                ->references('id')->on('orders');

            $table->foreign('delivery_id', 'foreign_order_deliveries_deliveries')
                ->references('id')->on('deliveries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_deliveries', function(Blueprint $table) {
            $table->dropForeign('foreign_order_deliveries_orders');
            $table->dropForeign('foreign_order_deliveries_deliveries');
        });
        Schema::dropIfExists('order_deliveries');
    }
}
