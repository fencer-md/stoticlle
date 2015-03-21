@macro('announcementStatus', $announcement)
@if ($announcement->success == Announcement::FAIL) <i class="fa fa-minus"></i>
@elseif($announcement->success == Announcement::SUCCESS) <i class="fa fa-plus"></i>
@endif
@endmacro

@macro('inlineAnnouncementStatus', $announcement)
@if ($announcement->success == Announcement::FAIL) <span class="text-red"><i class="fa fa-minus"></i></span>
@elseif($announcement->success == Announcement::SUCCESS) <span class="text-green"><i class="fa fa-plus"></i></span>
@endif
@endmacro
