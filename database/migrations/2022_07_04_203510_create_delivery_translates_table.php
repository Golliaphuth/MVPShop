<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_translates', function (Blueprint $table) {
            $table->bigInteger('delivery_id')->unsigned();
            $table->string('lang', 2);
            $table->string('name')->nullable();

            $table->foreign('delivery_id', 'foreign_delivery_translates_delivery')
                ->references('id')->on('deliveries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_translates', function(Blueprint $table) {
            $table->dropForeign('foreign_delivery_translates_delivery');
        });
        Schema::dropIfExists('delivery_translates');
    }
}
