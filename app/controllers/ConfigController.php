<?php

class ConfigController extends BaseController
{

    public function getRate()
    {
        $defaults = array(
            'original_rate' => '20',
            'days' => '26',
            'min' => '50',
        );
        $config = Config::get('rate');

        $config = array_merge($defaults, $config);

        return View::make('config.rate')
            ->with('config', $config);
    }

    public function postRate()
    {
        $original = Input::get('rate');
        $period = Input::get('days');
        $min = Input::get('min');
        $rate = $original / 100 / $period;

        $config = [
            'original_rate' => $original,
            'days' => $period,
            'rate' => $rate,
            'min' => $min,
        ];

        $this->saveConfig($config, 'rate');

        return Redirect::to('/admin/config/rate');
    }

    public function getAnnouncements()
    {
        $defaults = array(
            'duration' => 7,
            'expiryReminder1' => 2,
            'expiryReminder2' => 1,
        );
        $config = Config::get('announcements');

        $config = array_merge($defaults, $config);

        return View::make('config.announcements')
            ->with('config', $config);
    }

    public function postAnnouncements()
    {
        $duration = Input::get('duration');
        $expiryReminder1 = Input::get('expiryReminder1');
        $expiryReminder2 = Input::get('expiryReminder2');

        $config = [
            'duration' => $duration,
            'expiryReminder1' => $expiryReminder1,
            'expiryReminder2' => $expiryReminder2,
        ];

        $this->saveConfig($config, 'announcements');

        return Redirect::to('/admin/config/announcements');
    }

    protected function saveConfig($data, $file)
    {
        $filename = app_path() . '/config/'.$file.'.php';
        $content = "<?php\nreturn " . var_export($data, true) . ";\n";
        file_put_contents($filename, $content);
    }
}
