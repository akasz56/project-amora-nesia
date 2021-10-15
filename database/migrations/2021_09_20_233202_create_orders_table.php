<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('orderUUID');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('paymentID');
            $table->unsignedBigInteger('shipmentID');
            $table->unsignedBigInteger('status');

            $table->string('nameSend');
            $table->string('phone');
            $table->string('whatsapp')->nullable();

            $table->unsignedBigInteger('provinceID');
            $table->string('city');
            $table->string('rt');
            $table->string('rw');
            $table->string('address');
            $table->string('postcode');

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
        Schema::dropIfExists('orders');
    }
}
