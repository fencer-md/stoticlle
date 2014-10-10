<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTablesCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_roles', function($table)
        {
            $table->increments('id');
            $table->string('role');
            $table->timestamps();
        });
        Schema::create('users_info', function($table)
        {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('email')->unique;
            $table->string('password');
            $table->string('role');
            $table->integer('user_info_id')->unsigned();
            $table->foreign('user_info_id')->references('id')->on('users_info');
            $table->string('registration_code');  
            $table->string('registration_status');
            $table->string('remember_token', 100);
            $table->timestamps();
        });
		Schema::create('users_transaction', function($table)
        {
            $table->increments('id');
            $table->integer('ammount');
            $table->timestamp('date');
            $table->string('payment_method')->nullable();;
            $table->string('transaction_direction');
            $table->string('transaction_type');   
            $table->string('transaction_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('user_roles');
        Schema::drop('users_info');
		Schema::drop('users');
		Schema::drop('users_transaction');
	}

}