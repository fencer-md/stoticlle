<?php

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Mail\Message;

class SubscriptionReminder extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'subscription:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send subscription expiration reminders.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $config = Config::get('announcements');
        $expires = array(
            $config['expiryReminder1'],
            $config['expiryReminder2'],
        );

        foreach ($expires as $days) {
            $this->sendExpiryEmails($days);
        }
    }

    protected function getUsers($days)
    {
        $expires = new Carbon();
        $expires->setTime(0, 0, 0)->addDays($days);
        $expires = $expires->format('Y-m-d H:i:s');
        $users = User::where('announcement_expires', '=', $expires)->get();
        return $users;
    }

    protected function sendExpiryEmails($days)
    {
        $users = $this->getUsers($days);

        foreach ($users as $user) {
            /* @var $user \User */
            $subj = Lang::get('emails.subscription.subject');

            $name = null;
            $genderNumber = 0;
            $userInfo = $user->userInfo;
            if ($userInfo) {
                $name = trim($userInfo->first_name . ' ' . $userInfo->last_name);
                $genderNumber = $userInfo->genderNumber();
            }
            if (empty($name)) {
                $name = trans('emails.user');
            }

            $data = array(
                'days' => $days,
                'name' => $name,
                'genderNumber' => $genderNumber,
                'lang' => Lang::getLocale(),
                'url' => '#',
            );

            Mail::send('emails.announcements.expires', $data, function(Message $message) use($user, $subj) {
                $message->to($user->email)
                    ->subject($subj);
            });
        }
    }


}
