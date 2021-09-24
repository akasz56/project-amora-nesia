<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Reference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('province', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('gender', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $this->customSeed('bank', [
            ['name' => 'Mandiri'],
            ['name' => 'BNI'],
            ['name' => 'BCA'],
        ]);

        $this->customSeed('gender', [
            ['name' => 'Laki-Laki'],
            ['name' => 'Perempuan'],
        ]);

        $this->customSeed('order_status', [
            ['name' => 'pending'],
            ['name' => 'menunggu'],
            ['name' => 'diproses'],
            ['name' => 'dikirim'],
            ['name' => 'selesai'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    public function customSeed($table, $data)
    {
        DB::table($table)
            ->insertOrIgnore($data);
    }
}
