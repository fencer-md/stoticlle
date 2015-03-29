<?php

class LanguageController extends BaseController
{
    public function index($lang)
    {
        $cookie = Cookie::forever('lang', $lang);
        $response = Redirect::back();
        $response->withCookie($cookie);
        return $response;
    }
}
