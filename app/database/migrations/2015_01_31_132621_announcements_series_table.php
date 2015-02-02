<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnouncementsSeriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('announcements_series', function($table)
		{
			/* @var $table \Illuminate\Database\Schema\Blueprint */
			$table->increments('id');
			$table->timestamps();
			$table->timestamp('ended_at');
			$table->index('ended_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('announcements_series');
	}

}
