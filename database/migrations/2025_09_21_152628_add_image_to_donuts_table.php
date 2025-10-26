<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('donuts', function (Blueprint $table) {
        $table->string('image')->nullable()->after('stock'); // You can change position
    });
}

public function down()
{
    Schema::table('donuts', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}

};
