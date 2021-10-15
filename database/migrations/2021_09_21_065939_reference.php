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
        Schema::create('ref_payment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('ref_province', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('ref_gender', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('ref_order_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $this->customSeed('ref_payment', [
            ['name' => 'Mandiri'],
            ['name' => 'BNI'],
            ['name' => 'BCA'],
            ['name' => 'Gopay'],
            ['name' => 'OVO'],
            ['name' => 'Dana'],
        ]);

        $this->customSeed('ref_province', [
            ['name' => 'Aceh'],
            ['name' => 'Sumatra Utara'],
            ['name' => 'Sumatra Barat'],
            ['name' => 'Riau'],
            ['name' => 'Kepulauan Riau'],
            ['name' => 'Jambi'],
            ['name' => 'Bengkulu'],
            ['name' => 'Sumatra Selatan'],
            ['name' => 'Kepulauan Bangka Belitung'],
            ['name' => 'Lampung'],
            ['name' => 'Daerah Khusus Ibukota Jakarta'],
            ['name' => 'Banten'],
            ['name' => 'Jawa Barat'],
            ['name' => 'Jawa Tengah'],
            ['name' => 'Daerah Istimewa Yogyakarta'],
            ['name' => 'Jawa Timur'],
            ['name' => 'Bali'],
            ['name' => 'Nusa Tenggara Barat'],
            ['name' => 'Nusa Tenggara Timur'],
            ['name' => 'Kalimantan Barat'],
            ['name' => 'Kalimantan Tengah'],
            ['name' => 'Kalimantan Selatan'],
            ['name' => 'Kalimantan Timur'],
            ['name' => 'Kalimantan Utara'],
            ['name' => 'Sulawesi Utara'],
            ['name' => 'Gorontalo'],
            ['name' => 'Sulawesi Tengah'],
            ['name' => 'Sulawesi Barat'],
            ['name' => 'Sulawesi Selatan'],
            ['name' => 'Sulawesi Tenggara'],
            ['name' => 'Maluku Utara'],
            ['name' => 'Maluku'],
            ['name' => 'Papua Barat'],
            ['name' => 'Papua'],
        ]);

        $this->customSeed('ref_gender', [
            ['name' => 'Laki-Laki'],
            ['name' => 'Perempuan'],
        ]);

        $this->customSeed('ref_order_status', [
            ['name' => 'pending'],  // 1
            ['name' => 'menunggu'], // 2
            ['name' => 'diproses'], // 3
            ['name' => 'dikirim'],  // 4
            ['name' => 'selesai'],  // 5
            ['name' => 'Error'],  // 6
            ['name' => 'Error'],  // 7
            ['name' => 'Error'],  // 8
            ['name' => 'Error'],  // 9
            ['name' => 'dibatalkan'],  // 10
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_bank');
        Schema::dropIfExists('ref_province');
        Schema::dropIfExists('ref_gender');
        Schema::dropIfExists('ref_order_status');
    }

    public function customSeed($table, $data)
    {
        DB::table($table)
            ->insertOrIgnore($data);
    }
}
