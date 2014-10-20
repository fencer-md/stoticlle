<?php
class Message extends Eloquent {

	protected $table = 'messages';

	public function recipient(){
		return $this->hasOne('User', 'id');
	}
}