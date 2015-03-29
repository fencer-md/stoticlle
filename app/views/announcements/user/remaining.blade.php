@if ($left !== null)
<div class="remaining-time">
    <i class="fa fa-clock-o pull-right"></i>
    @if ($left->d)
    <div class="text">{{$left->d}} дней</div>
    @elseif ($left->h)
        <div class="text">{{$left->h}} часов</div>
    @else
        <div class="text">иеньше часа</div>
    @endif
    <div class="info">осталось времени</div>
</div>
@endif
