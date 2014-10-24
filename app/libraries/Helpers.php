<?php

class Helper {

    public static function reward($ammount, $rate)
    {
    	$ammount = $ammount * 20 * $rate;
        return $ammount;
    }
}