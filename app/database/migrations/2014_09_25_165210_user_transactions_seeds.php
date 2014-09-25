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
            	array(
                	'first_name' => 'Sarah',
                	'last_name' => 'Connor',
                	'gender' => 'female',                	
                    'birth_date' => '1980-06-04',
                    'city'  => 'Madrid',
                    'country' => 'Spain',
                ),
            	array(
                	'first_name' => 'Andrew',
                	'last_name' => 'Pollock',
                	'gender' => 'male',                	
                    'birth_date' => '1980-06-04',
                    'city'  => 'Minnesota',
                    'country' => 'USA',
                ),
            	array(
                	'first_name' => 'Liz',
                	'last_name' => 'Botticelli',
                	'gender' => 'female',                	
                    'birth_date' => '1980-06-04',
                    'city'  => 'Florence',
                    'country' => 'Italy',
                ),
            	array(
                	'first_name' => 'Ivan',
                	'last_name' => 'Petrov',
                	'gender' => 'male',                	
                    'birth_date' => '1980-06-04',
                    'city'  => 'Sankt-Petersburg',
                    'country' => 'Russia',
                ),
        	)
		);

		DB::table('user_roles')->insert(
            array(
                array(
                    'role' => 'administrator'
                ),
                array(
                    'role' => 'user'
                ),
            )
        );

		DB::table('users')->insert(
        	array(
            	array(
                	'email' => 'user1@mail.com',
                	'password' => '',
                	'role' => '2',                	
                    'user_info_id' => '1',
                    'registration_code'  => '0',
                    'registration_status' => '1',
                ),
            	array(
                	'email' => 'user2@mail.com',
                	'password' => '',
                	'role' => '2',                	
                    'user_info_id' => '2',
                    'registration_code'  => '0',
                    'registration_status' => '1',
                ),
            	array(
                	'email' => 'user3@mail.com',
                	'password' => '',
                	'role' => '2',                	
                    'user_info_id' => '3',
                    'registration_code'  => '0',
                    'registration_status' => '1',
                ),
            	array(
                	'email' => 'user4@mail.com',
                	'password' => '',
                	'role' => '2',                	
                    'user_info_id' => '4',
                    'registration_code'  => '0',
                    'registration_status' => '1',
                ),
            	array(
                	'email' => 'user5@mail.com',
                	'password' => '',
                	'role' => '2',                	
                    'user_info_id' => '5',
                    'registration_code'  => '0',
                    'registration_status' => '1',
                ),
            	array(
                	'email' => 'user6@mail.com',
                	'password' => '',
                	'role' => '2',                	
                    'user_info_id' => '6',
                    'registration_code'  => '0',
                    'registration_status' => '1',
                ),
        	)
		);

		DB::table('users_transaction_internal')->insert(
			array(
            	array(
                	'ammount' => '10',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'to',
                	'user_id' => '1',
                ),
            	array(
                	'ammount' => '13',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'from',
                	'user_id' => '1',
                ),
            	array(
                	'ammount' => '25',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'to',
                	'user_id' => '2',
                ),
            	array(
                	'ammount' => '12',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'from',
                	'user_id' => '2',
                ),
            	array(
                	'ammount' => '41',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'to',
                	'user_id' => '3',
                ),
            	array(
                	'ammount' => '32',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'from',
                	'user_id' => '3',
                ),
            	array(
                	'ammount' => '111',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'to',
                	'user_id' => '4',
                ),
            	array(
                	'ammount' => '222',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'from',
                	'user_id' => '4',
                ),
            	array(
                	'ammount' => '553',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'to',
                	'user_id' => '5',
                ),
            	array(
                	'ammount' => '234',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'from',
                	'user_id' => '5',
                ),
            	array(
                	'ammount' => '23',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'to',
                	'user_id' => '6',
                ),
            	array(
                	'ammount' => '142',
                	'date' => '2014-09-25',
                	'transaction_direction' => 'from',
                	'user_id' => '6',
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
