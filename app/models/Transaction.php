<?php
class Transaction extends Eloquent {

	protected $table = 'users_transaction';

	public function user()
	{
		return $this->belongsTo('User', 'user_id', 'id');
	}

	public function transactionFrom()
	{
		return $this->belongsTo('PaymentMethod', 'from_credentials', 'id');
	}

}