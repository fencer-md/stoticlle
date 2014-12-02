<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->integer('country_id', true);
			$table->char('code', 2)->unique('idx_code');
			$table->string('name', 64);
			$table->string('full_name', 128);
			$table->char('iso3', 3);
			$table->smallInteger('number')->unsigned();
			$table->char('continent_code', 2)->index('idx_continent_code');
			$table->integer('display_order')->default(900);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}

}
