<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status_translates', function (Blueprint $table) {
            $table->bigInteger('order_status_id')->unsigned();
            $table->string('lang', 2);
            $table->string('name')->nullable();

            $table->foreign('order_status_id', 'foreign_order_status_translate_order_status')
                ->references('id')->on('order_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_status_translates', function(Blueprint $table) {
            $table->dropForeign('foreign_order_status_translate_order_status');
        });
        Schema::dropIfExists('order_status_translates');
    }
}
