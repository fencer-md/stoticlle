<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function getDates()
    {
        return array('created_at', 'updated_at', 'session_expires');
    }

    public function userInfo()
	{
		return $this->hasOne('UserInfo', 'id', 'user_info_id');
	}

	public function userMoney()
	{
		return $this->hasOne('UserMoney', 'id', 'user_money_id');
	}

	public function userTransaction()
	{
		return $this->hasMany('Transaction', 'user_id');
	}

	public function userTransactionNext()
	{
		return $this->hasMany('Transaction', 'user_id');
	}

	public function userOffer()
	{
		return $this->hasMany('Offer', 'recipient_id');
	}

	public function paymentMethods()
	{
		return $this->hasMany('PaymentMethod', 'user_id');
	}

}