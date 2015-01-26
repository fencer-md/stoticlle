<?php

use Illuminate\Database\Migrations\Migration;

class PaymentMethodsIndexes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('payment_methods', function($table)
		{
			$table->dropUnique('payment_methods_account_id_unique');
			$table->unique(['title', 'account_id', 'user_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('payment_methods', function($table)
		{
			$table->dropUnique('payment_methods_title_account_id_user_id_unique');
			$table->unique('account_id');
		});
	}
}
