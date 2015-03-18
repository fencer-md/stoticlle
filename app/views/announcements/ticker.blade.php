@if ($show)
    @if ($ajax)
        <div id="announcements-ticker-ajax" class="announcements-ticker clearfix">{{ $message }}</div>
    @else
        <div id="announcements-ticker-ws" class="announcements-ticker clearfix">{{ $message }}</div>
        <script>
            var Announcements = {
                init: function(ws, options){
                    ws.marquee({pauseOnHover: true});
                    var host = 'ws.' + window.location.hostname;
                    var conn = new WebSocket('ws://'+host+':8080');
                    conn.onmessage = function(e) {
                        ws.marquee('destroy').text(e.data).marquee(options);
                    };
                }
            };
        </script>
    @endif
@endif
