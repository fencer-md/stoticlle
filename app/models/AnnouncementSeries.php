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

    public function announcements()
    {
        return $this->hasMany('Announcement', 'series_id');
    }

    public function countdown()
    {
        return $this->hasOne('AnnouncementCounter', 'series_id');
    }

    /**
     * Group stream announcements by date and by "-/+" logic.
     *
     * @param string $format Date format for output.
     * @param User $user Show only stream for specific user.
     * @return array
     */
    public function groupedByDate($format, $user=null)
    {
        $output = array();

        $query = $this->announcements()->orderBy('created_at');
        if ($user) {
            $query->where('series_id', '=', $user->announcement_stream)
                ->where('created_at', '>=', $user->announcement_start);
        }

        // Group by date.
        $result = array();
        $count = 0;
        foreach($query->get() as $a) {
            $date = $a->created_at->format($format);
            $dateKey = $a->created_at->format('Y-m-d');

            if (empty($result[$dateKey])) {
                $day = new stdClass();
                $day->date = $date;
                $day->announcements = array();
                $result[$dateKey] = $day;
            }
            $result[$dateKey]->announcements[] = $a;
            $count++;
        }

        // Add current date if needed.
        $today = new \Carbon\Carbon();
        $todayDate = $today->format($format);
        $dateKey = $today->format('Y-m-d');
        if (empty($result[$dateKey])) {
            $day = new stdClass();
            $day->date = $todayDate;
            $day->announcements = array();
            $result[$dateKey] = $day;
        }

        // Group by "+/-".
        foreach($result as $date => $data) {
            $announcements = array();
            $currentSet = array();
            foreach ($data->announcements as $a) {
                // If announcement is success add it to currentSet and show it.
                if ($a->success == Announcement::SUCCESS) {
                    $currentSet[] = $a;
                    $announcements[] = $currentSet;
                    $currentSet = array();
                    continue;
                }

                // Add failed to currentSet.
                $currentSet[] = $a;

                // If all 3 are minus set it complete, show it.
                if (count($currentSet) == 3) {
                    $announcements[] = $currentSet;
                    $currentSet = array();
                }
            }
            // Add last 1-2 failed.
            if (!empty($currentSet)) {
                $announcements[] = $currentSet;
            }

            // Build output for date.
            $day = new stdClass();
            $day->date = $data->date;
            $day->announcements = $announcements;

            $output[$date] = $day;
        }
        uksort($output, function($a, $b){ return -strcmp($a, $b);});

        $result = array(
            'count' => $count,
            'data' => $output,
        );

        return $result;
    }

    public function getCountdownTimestamp()
    {
        $countdown = $this->countdown;
        if ($countdown) {
            return $countdown->ends_at->format('U');
        }
        return 0;
    }
}
