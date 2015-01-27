<?php

class AnnouncementObserver
{
    public function creating($model)
    {
        var_dump($model->created_at);
        // $model->expires_at = $model->created_at + 10min
    }
}