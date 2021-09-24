<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderID');
            $table->uuid('orderUUID');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('shopID');
            $table->unsignedBigInteger('productID');
            $table->unsignedBigInteger('productTypeID');
            $table->unsignedBigInteger('productWrapID');
            $table->unsignedBigInteger('productSizeID');
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
        Schema::dropIfExists('order_items');
    }
}
