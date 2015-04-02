<?php
class UserInfo extends Eloquent
{

    protected $table = 'users_info';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function genderNumber()
    {
        $result = 0;
        switch($this->gender) {
            case 'male':
                $result = 1;
                break;
            case 'female':
                $result = 2;
                break;
        }

        return $result;
    }
}