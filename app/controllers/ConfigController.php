<?php

class ConfigController extends \BaseController {

	public function update()
	{
		$rate = Input::get('rate');
		$days = Input::get('days');
		$contents = "<?php
		return array(
			'rate' => ".$rate."
		);";
		$filename = '../app/config/rate.php';
		$fileContent = file($filename, FILE_IGNORE_NEW_LINES);
		$fileContent[2] = "'rate' => ".$rate.",";
		$fileContent[3] = "'days' => ".$days.",";
		$lastLine = end($fileContent);
		$lastLine = ");";
		file_put_contents($filename, implode("\n", $fileContent));

		if ($filename === false)
		{
		    die("Error");
		}

		return Redirect::back();

	}


}
