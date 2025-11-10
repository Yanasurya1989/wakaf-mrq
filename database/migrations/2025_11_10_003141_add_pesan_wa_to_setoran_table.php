<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('setoran', function (Blueprint $table) {
            $table->text('pesan_wa')->nullable()->after('keterangan');
        });
    }

    public function down()
    {
        Schema::table('setoran', function (Blueprint $table) {
            $table->dropColumn('pesan_wa');
        });
    }
};
