<?php

class ConfigController extends \BaseController {

	public function update()
	{
		$original = Input::get('rate');
		$period = Input::get('days');
		$rate = $original / 100 / $period;

		$config = [
			'original_rate' => $original,
			'days' => $period,
			'rate' => $rate,
			'min' =>  Input::get('min'),
		];

		$filename = app_path() . '/config/rate.php';
		$content = '<?php return ' . var_export($config, true) . ';';
		file_put_contents($filename, $content);

		return Redirect::back();
	}
}
