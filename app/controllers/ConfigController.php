<?php

class ConfigController extends \BaseController {

	public function update()
	{
		$rate = Input::get('rate');
		$contents = "<?php
		return array(
			'rate' => ".$rate."
		);";
		$file = File::put('app/config/rate.php', $contents);
		if ($file === false)
		{
		    die("Error");
		}

		return Redirect::back();

	}


}
