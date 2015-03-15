<div class="announcements">
    @foreach($grouped['data'] as $day)
        <div class="pull-left day">
            <div class="date">{{$day->date}}</div>
            <div class="results">
                @foreach($day->announcements as $group){{--
                --}}<div class="result @if($group[count($group)-1]->success == 1) text-red @elseif($group[count($group)-1]->success == 2) text-green @endif"
                    data-placement="top" data-toggle="popover" title=""
                    data-content="{{{groupMessage($group)}}}">{{announcementStatus($group[count($group)-1])}}</div>{{--
            --}}@endforeach
            </div>
        </div>
    @endforeach
</div>
