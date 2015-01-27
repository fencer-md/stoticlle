<?php

class AnnouncementsController extends BaseController {

    public function getIndex()
    {
        $announcements = Announcement::all();
        return View::make(
            'announcements.admin.index',
            array(
                'announcements' => $announcements,
            )
        );
    }

    public function getCreate()
    {
        $data = new Announcement();
        return View::make(
            'announcements.admin.form',
            array(
                'data' => $data,
            )
        );
    }

    public function postCreate()
    {
        $data = new Announcement(Input::all());
        $data->save();

        // TODO: Send message to WebSocket server.

        return Redirect::to('announcements');
    }

}
