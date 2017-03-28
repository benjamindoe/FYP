<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassCloudFilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('class_cloud_files', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('class_id');
			$table->unsignedInteger('subject_id');
			$table->string('path')->nullable();
			$table->string('status');
			$table->string('name');
			$table->string('notes');
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('class_id')->references('id')->on('class');
			$table->foreign('subject_id')->references('id')->on('subject');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('class_cloud_files');
	}
}
