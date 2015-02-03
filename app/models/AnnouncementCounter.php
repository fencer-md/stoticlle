<?php

class AnnouncementCounter extends Eloquent {
    protected $table = 'announcements_counter';

    public function getDates()
    {
        return array('created_at', 'updated_at', 'ends_at');
    }
}
