<?php

use Illuminate\Console\Command;
use Carbon\Carbon;

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
            $subj = Lang::get('emails.subscription.subject');
            Mail::send('emails.announcements.expires', array('days' => $days), function($message) use($user, $subj) {
                /* @var $user \User */
                /* @var $message \Illuminate\Mail\Message */
                $message->to($user->email)
                    ->subject($subj);
            });
        }
    }


}
