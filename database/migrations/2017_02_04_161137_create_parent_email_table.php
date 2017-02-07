<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('parent_email'))
        {
            Schema::create('parent_email', function (Blueprint $table) {
                $table->unsignedInteger('parent_id');
                $table->string('email');
                $table->primary(['parent_id', 'email']);
                $table->boolean('is_primary');
                $table->string('label');
                $table->timestamps();
            });
        }
        Schema::table('parent_email', function (Blueprint $table) {
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
        Schema::dropIfExists('parent_email');
    }
}
