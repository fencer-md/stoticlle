<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnouncementsCounterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('announcements_counter', function($table)
		{
			/* @var $table \Illuminate\Database\Schema\Blueprint */
			$table->increments('id');
			$table->timestamps();
			$table->timestamp('ends_at');
			$table->index('ends_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('announcements_counter');
	}

}
