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
            $table->unsignedBigInteger('status');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('shipmentID');

            $table->string('payment_token')->nullable();
            $table->string('payment_url')->nullable();

            $table->string('nameSend');
            $table->string('phone');
            $table->string('whatsapp')->nullable();

            $table->decimal('grand_total', 16, 2);
            $table->decimal('ongkir', 16, 2);

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
