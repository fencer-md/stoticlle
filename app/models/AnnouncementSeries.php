<?php

class AnnouncementSeries extends Eloquent {
    protected $table = 'announcements_series';

    public function getDates()
    {
        return array('created_at', 'updated_at', 'ended_at');
    }

    public static function latest()
    {
        return self::where('ended_at', '0000-00-00 00:00:00')->first();
    }
}
