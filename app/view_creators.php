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
    $show = true;

    // Show announcements only for logged in users.
    if (Auth::check()) {
        // Paid users get latest.
        /* @var $user \User */
        $user = Auth::user();
        if ($user->announcement_stream && !empty($user->announcement_start) && $user->announcement_start->isPast()) {
            $ajax = false;
            $announcement = Announcement::latestInStream(Auth::user()->announcement_stream);
            $config = Config::get('announcements-server.websocket');

            $view
                ->with('websocketPort', $config['port'])
                ->with('user', Auth::user()->id);
        } else {
            $announcement = Announcement::latestExpired();
        }
        $message = empty($announcement) ? null : $announcement->getMessage();
    } else {
        // Do not show the ticker.
        $show = false;
    }

    $view->with('show', $show)
        ->with('ajax', $ajax)
        ->with('message', $message);
});
