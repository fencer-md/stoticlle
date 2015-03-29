<?php

class UserAnnouncementsController extends BaseController
{
    public function getIndex()
    {
        $user = Auth::user();

        return View::make('announcements.user.announcements')
            ->with('stream', AnnouncementSeries::find($user->announcement_stream))
            ->with('user', $user)
            ->with('accountSum', Session::get('announcemntsSum', 1000));
    }

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
