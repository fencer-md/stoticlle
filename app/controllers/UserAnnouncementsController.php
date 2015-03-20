<?php

use Carbon\Carbon;

class UserAnnouncementsController extends BaseController
{
    /**
     * User: Handle ajax announcements update.
     */
    public function getNew()
    {
        $announcement = Announcement::latestExpired();
        $message = empty($announcement) ? null : $announcement->getMessage();
        echo $message;
    }

    /**
     * User: Confirm announcement.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function anyBet($id)
    {
        $bet = new AnnouncementBet();
        $bet->announcement_id = $id;
        $bet->user_id = Auth::user()->id;
        $bet->save();
        Flash::success('Ставка сохранена');

        return Redirect::back();
    }

    public function postAccountSum()
    {
        $sum = Input::get('sum');
        Session::set('announcemntsSum', $sum);
    }
}
