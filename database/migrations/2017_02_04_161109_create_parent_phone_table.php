<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('parent_phone'))
        {
            Schema::create('parent_phone', function (Blueprint $table) {
                $table->unsignedInteger('parent_id');
                $table->string('phone');
                $table->primary(['parent_id', 'phone']);
                $table->boolean('is_primary');
                $table->string('label');
                $table->timestamps();
            });
        }
        Schema::table('parent_phone', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('parent')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_phone');
    }
}
