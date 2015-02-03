<?php

use Illuminate\Database\Migrations\Migration;

class AnnouncementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('announcements', function($table)
		{
			/* @var $table \Illuminate\Database\Schema\Blueprint */
			$table->increments('id');
			$table->string('message');
			$table->double('coefficient', 15, 8);
			$table->enum('announcement_type', array(1, 2, 3));
			$table->timestamps();
			$table->timestamp('expires_at');
			$table->index('expires_at');
			$table->integer('series_id');
			$table->boolean('success')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('announcements');
	}

}
