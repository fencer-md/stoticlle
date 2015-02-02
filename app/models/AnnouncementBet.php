<?php

class AnnouncementBet extends Eloquent {
    protected $table = 'announcements_bets';
    protected $fillable = array('announcement_id', 'user_id', 'amount');
}
