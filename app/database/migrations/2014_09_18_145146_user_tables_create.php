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
            $table->string('links')->nullable();
            $table->timestamps();
        });
        Schema::create('user_money_info', function($table)
        {
            $table->increments('id');
            $table->float('current_available');
            $table->integer('times_won');
            $table->float('ammount_won');
            $table->integer('times_invested');
            $table->float('ammount_invested');
            $table->integer('times_added');
            $table->float('ammount_added');
            $table->integer('times_withdrawn');
            $table->float('ammount_withdrawn');
            $table->timestamps();
        });
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('email')->unique;
            $table->string('password');
            $table->string('commentary')->nullable();
            $table->string('role');
            $table->string('investor');
            $table->string('awarded');
            $table->integer('awaiting_award');
            $table->timestamp('invested_date')->nullable();
            $table->integer('cycle_duration')->nullable();
            $table->string('monitored');
            $table->string('blocked');
            $table->integer('user_info_id')->unsigned();
            $table->foreign('user_info_id')->references('id')->on('users_info');
            $table->integer('user_money_id')->unsigned();
            $table->foreign('user_money_id')->references('id')->on('user_money_info');
            $table->timestamp('last_login')->nullable();
            $table->string('registration_code');
            $table->string('registration_status');
            $table->string('remember_token', 100);
            $table->timestamps();
        });
        Schema::create('payment_methods', function($table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('account_id')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('offers', function($table)
        {
            $table->increments('id');
            $table->text('body');
            $table->timestamp('offer_ends');
            $table->float('rate');
            $table->integer('recipient_id')->unsigned();
            $table->foreign('recipient_id')->references('id')->on('users');
            $table->timestamps();
        });
		Schema::create('users_transaction', function($table)
        {
            $table->increments('id');
            $table->float('ammount');
            $table->timestamp('date');
            $table->string('payment_system')->nullable();
            $table->integer('confirmed')->nullable();
            $table->string('transaction_direction');
            $table->string('comments');
            $table->integer('from_credentials')->unsigned()->nullable();
            $table->foreign('from_credentials')->references('id')->on('payment_methods');
            $table->string('to_credentials');
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
        Schema::drop('user_money_info');
		Schema::drop('users');
        Schema::drop('payment_methods');
        Schema::drop('offers');
		Schema::drop('users_transaction');
	}

}