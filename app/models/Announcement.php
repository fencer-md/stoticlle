<?php

class Announcement extends Eloquent
{
    const SUCCESS = 2;
    const FAIL = 1;

    protected $table = 'announcements';
    protected $fillable = array('name', 'game', 'coefficient', 'announcement_type', 'series_id', 'success', 'probability');

    public function getDates()
    {
        return array('created_at', 'updated_at', 'expires_at');
    }

    public function stream()
    {
        return $this->belongsTo('AnnouncementSeries', 'series_id');
    }

    public static function latestExpired()
    {
        $query = self::orderBy('expires_at', 'DESC')
            ->where('expires_at', '<', new \DateTime());

        return $query->first();
    }

    public static function latestInStream($stream)
    {
        $query = self::orderBy('created_at', 'DESC')
            ->where('series_id', '=', $stream);

        return $query->first();
    }

    public function getMessage()
    {
        return implode(' ', array(
            $this->announcement_type,
            $this->name,
            'game',
            $this->game,
            'k-' . $this->coefficient
        ));
    }
}
