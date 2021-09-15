<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
            $table->unsignedBigInteger('addressID')->nullable();
            $table->string('photoURL')->nullable();
            $table->date('dateofbirth')->nullable();
            
            $table->unsignedBigInteger('genderID')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            
            $table->unsignedBigInteger('BankID')->nullable();
            $table->string('BankNum')->nullable();
            $table->string('BankName')->nullable();
            
            $table->unsignedBigInteger('shopID')->nullable();
            // $table->foreignId('shopID')
            //     ->nullable()
            //     ->constrained('shops');
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
        Schema::dropIfExists('users');
    }
}
