@if ($show)
    @if ($ajax)
        <div id="announcements-ticker-ajax" class="announcements-ticker clearfix">{{ $message }}</div>
    @else
        <div id="announcements-ticker-ws" class="announcements-ticker clearfix">{{ $message }}</div>
        <audio id="announcement-sound">
            <source src="{{ asset('snd/announcement.ogg') }}" type="audio/ogg">
            <source src="{{ asset('snd/announcement.mp3') }}" type="audio/mpeg">
        </audio>
        <script>
            var AnnouncementSound = document.getElementById('announcement-sound');
            var Announcements = {
                init: function(ws, options){
                    ws.marquee({pauseOnHover: true});
                    var host = 'ws.' + window.location.hostname;
                    var conn = new WebSocket('ws://'+host+':{{$websocketPort}}?uid={{$user}}');
                    conn.onmessage = function(e) {
                        var msg = JSON.parse(e.data);
                        switch (msg.type) {
                            case "message":
                                ws.marquee('destroy').text(msg.text).marquee(options);
                                break;
                            case "notify":
                                AnnouncementSound.play(); // Play sound.
                                var notification = $('#announcement-notification');
                                if (notification.length) {
                                    notification.show(); // Show text notification.
                                    setTimeout(function(){
                                        notification.hide();
                                    }, 5000); //Hide after 5 sec.
                                }
                                break;

                            default:
                                console.log('WS msg', e.data);
                        }
                    };
                }
            };
        </script>
    @endif
@endif
