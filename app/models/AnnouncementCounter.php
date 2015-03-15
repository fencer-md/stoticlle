<?php

class AnnouncementCounter extends Eloquent {
    protected $table = 'announcements_counter';

    public function getDates()
    {
        return array('created_at', 'updated_at', 'ends_at');
    }

    public static function getByStream($id)
    {
        $counter = self::firstOrNew(array(
            'series_id' => $id
        ));

        if (!$counter) {
            $counter = new static();
            $counter->series_id = $id;
        }

        return $counter;
    }
}
