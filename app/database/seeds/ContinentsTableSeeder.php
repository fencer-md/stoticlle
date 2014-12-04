<?php

class ContinentsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('continents')->truncate();
        
		\DB::table('continents')->insert(array (
			0 => 
			array (
				'code' => 'AF',
				'name' => 'Africa',
			),
			1 => 
			array (
				'code' => 'AN',
				'name' => 'Antarctica',
			),
			2 => 
			array (
				'code' => 'AS',
				'name' => 'Asia',
			),
			3 => 
			array (
				'code' => 'EU',
				'name' => 'Europe',
			),
			4 => 
			array (
				'code' => 'NA',
				'name' => 'North America',
			),
			5 => 
			array (
				'code' => 'OC',
				'name' => 'Oceania',
			),
			6 => 
			array (
				'code' => 'SA',
				'name' => 'South America',
			),
		));
	}

}
