<?php

class LanguageController extends BaseController
{
    public function index($lang)
    {
        var_dump($lang);
        Session::set('lang', $lang);

        return Redirect::back();
    }
}
