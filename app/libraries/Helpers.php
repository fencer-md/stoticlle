<?php

class Helper {

    public static function reward($ammount, $days, $rate)
    {
    	$ammount = $ammount * $days * $rate;
        return $ammount;
    }
}