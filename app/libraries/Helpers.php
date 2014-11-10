<?php

class Helper {

    public static function reward($ammount, $rate)
    {
    	$ammount = $ammount * $rate;
        return $ammount;
    }
}