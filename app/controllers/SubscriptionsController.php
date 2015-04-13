<?php

use Carbon\Carbon;

class SubscriptionsController extends BaseController
{
    public function getIndex()
    {
        $users = User::whereNotNull('announcement_stream')->get();

        return View::make(
            'backend.admin.subscriptions.index',
            [
                'users' => $users,
                'period' => Config::get('announcements.duration'),
            ]
        );
    }

    public function getExtend($uid, $period)
    {
        /* @var $user User */
        $user = User::find($uid);

        if (empty($user->announcement_stream)) {
            Flash::error('Пользователь не подписан на рассылку.');
            return Redirect::to('admin/subscriptions');
        }


        // Already has an active subscription.
        if ($user->announcement_expires && $user->announcement_expires->isFuture()) {
            $user->announcement_expires = $user->announcement_expires->addDays($period);
        }
        // Subscription expired.
        if ($user->announcement_expires && $user->announcement_expires->isPast()) {
            // Start tomorrow.
            $start = new Carbon();
            $start->setTime(0,0,0)->addDays(1);
            $user->announcement_start = $start;

            // Expire in $period from tomorrow.
            $expires = clone $start;
            $expires->addDays($period);
            $user->announcement_expires = $expires;
        }

        $user->save();

        Flash::success('Подписка продленна.');
        return Redirect::to('admin/subscriptions');
    }
}
