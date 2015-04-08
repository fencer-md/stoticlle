<div class="notification warning" id="announcement-notification" style="display: none">
    <div class="text">{{trans('userpage.atention')}}!</div>
    <div class="info">{{trans('userpage.incomming')}}</div>
    <div id="announcement-notification-name"></div>
</div>
<div class="notification danger" id="announcement-notification-canceled" style="display: none">
    <div class="text">{{trans('userpage.cancel')}}</div>
</div>
<div class="notification warning" id="announcement-notification-paused" style="display: none">
    <div class="text">{{trans('userpage.paused')}}</div>
    <div id="announcement-notification-pause-countdown">{{$paused}}</div>
</div>

@if ($paused)
    <script>
        $(document).ready(function(){
            var counter = $('#announcement-notification-pause-countdown');
            var countdown = new Date(parseInt(counter.text()) * 1000);
            var block = $('#announcement-notification-paused');
            block.show();
            counter.countdown({
                until: countdown,
                compact: true,
                format: 'dhMS',
                description: '',
                localization: $('html').attr('lang'),
                onExpiry: function(){
                    block.hide();
                }
            });
        });
    </script>
@endif
