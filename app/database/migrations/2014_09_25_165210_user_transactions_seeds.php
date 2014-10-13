<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTransactionsSeeds extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('users_info')->insert(
        	array(
            	array(
                	'first_name' => 'John',
                	'last_name' => 'Doe',
                	'gender' => 'male',                	
                    'birth_date' => '1980-06-04',
                    'city'  => 'Washington',
                    'country' => 'USA',
                ),
            	array(
                	'first_name' => 'Foo',
                	'last_name' => 'Bar',
                	'gender' => 'male',                	
                    'birth_date' => '1980-06-04',
                    'city'  => 'Cologne',
                    'country' => 'Germany',
                ),
        	)
		);

		DB::table('user_roles')->insert(
            array(
                array(
                    'role' => 'administror'
                ),
                array(
                    'role' => 'user'
                ),
            )
        );

		DB::table('users')->insert(
        	array(
            	array(
                	'email' => 'user@mail.com',
                	'password' => Hash::make('user'),
                	'role' => '2',                	
                    'user_info_id' => '1',
                    'registration_code'  => '0',
                    'registration_status' => '1',
                ),
                array(
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('admin'),
                    'role' => '1',                  
                    'user_info_id' => '2',
                    'registration_code'  => '0',
                    'registration_status' => '1',
                ),
        	)
		);

		DB::table('users_transaction')->insert(
			array(
            	array(
                	'ammount' => '10',
                	'date' => '2014-10-10',
                	'transaction_direction' => 'added',
                	'user_id' => '1',
                    'transaction_type' => 'external',
                ),
            	array(
                	'ammount' => '6',
                	'date' => '2014-10-10',
                	'transaction_direction' => 'extracted',
                	'user_id' => '1',
                    'transaction_type' => 'external',
                ),
                array(
                    'ammount' => '2',
                    'date' => '2014-10-10',
                    'transaction_direction' => 'invested',
                    'user_id' => '1',
                    'transaction_type' => 'internal',
                ),
            )
		);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
