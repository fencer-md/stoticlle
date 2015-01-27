<?php

/**
 * Set variables required for announcements ticker.
 */
View::creator('announcements.ticker', function($view)
{
    /*
     * Show the ticker.
     * Usually will be always show, but in case there are no announcements in database we hide it completely.
     */
    $show = false;
    /*
     * If the user does not have announcements enabled, he will see ajax version of it.
     * Updates will come with page update or once in 5 minutes.
     */
    $ajax = true;

    $view->with('show', $show)
        ->with('ajax', $ajax);
});
