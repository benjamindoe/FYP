<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoreAddressComponentsCityCountyLocality extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('address', function (Blueprint $table) {
            $table->renameColumn('address_line_5', 'locality');
            $table->string('city');
            $table->string('county');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address', function (Blueprint $table) {
            $table->renameColumn('locality', 'address_line_5');
            $table->dropColumn(['city', 'county']);
        });
    }
}
