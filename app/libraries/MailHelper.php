<?php

class MailHelper
{
    public static function prepareData(User $user)
    {
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
            'name' => $name,
            'genderNumber' => $genderNumber,
            'lang' => Lang::getLocale(),
        );

        return $data;
    }
}
