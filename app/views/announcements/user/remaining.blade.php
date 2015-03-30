@if ($left !== null)
<div class="remaining-time">
    <i class="fa fa-clock-o pull-right"></i>
    @if ($left->d)
    <div class="text">{{$left->d}} {{trans('userpage.days')}}</div>
    @elseif ($left->h)
        <div class="text">{{$left->h}} {{trans('userpage.hours')}}</div>
    @else
        <div class="text">{{trans('userpage.lesshour')}}</div>
    @endif
    <div class="info">{{trans('userpage.timeleft')}}</div>
</div>
@endif
