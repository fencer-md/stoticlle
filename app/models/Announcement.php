<?php
class Announcement extends Eloquent {
    protected $table = 'announcements';
    protected $fillable = array('message', 'coefficient', 'announcement_type');

    public function getDates()
    {
        return array('created_at', 'updated_at', 'expires_at');
    }

}
