<?php

/**
 * Set variables required for announcements ticker.
 */
View::creator('announcements.ticker', function($view)
{
    /*
     * If the user does not have announcements enabled, he will see ajax version of it.
     * Updates will come with page update or once in 5 minutes.
     */
    $ajax = true;
    $message = null;

    // Show announcements only for logged in users.
    if (Auth::check()) {
        // Paid users get latest.
        if (Auth::user()->announcements) {
            $ajax = false;
            $announcement = Announcement::latestInStream(Auth::user()->announcements);
        } else {
            $announcement = Announcement::latestExpired();
        }
        $message = empty($announcement) ? null : $announcement->getMessage();
    }

    /*
     * Show the ticker.
     * Usually will be always show, but in case there are no announcements in database we hide it completely.
     */
    $show = !empty($message);

    $view->with('show', $show)
        ->with('ajax', $ajax)
        ->with('message', $message);
});
