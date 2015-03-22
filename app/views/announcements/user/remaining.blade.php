@if ($days !== null)
<div class="remaining-time">
    <img src="{{ asset('images/timer.png') }}" alt="timer">
    <div class="text">{{$days}} дней</div>
    <div class="info">осталось времени</div>
</div>
@endif
