<?php

class Announcement extends Eloquent {
    protected $table = 'announcements';
    protected $fillable = array('message', 'coefficient', 'announcement_type', 'series_id', 'success');

    public function getDates()
    {
        return array('created_at', 'updated_at', 'expires_at');
    }

    public static function latest($expired=true)
    {
        $query = self::orderBy('expires_at', 'DESC');
        if ($expired) {
            $query->where('expires_at', '<', new \DateTime());
        }
        return $query->first();
    }
}
