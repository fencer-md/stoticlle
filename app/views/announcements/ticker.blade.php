@if ($show)
    @if ($ajax)
        <div id="announcements-ticker-ajax" class="announcements-ticker">{{ $message }}</div>
    @else
        <div id="announcements-ticker-ws" class="announcements-ticker">{{ $message }}</div>
        <audio id="announcement-sound">
            <source src="{{ asset('snd/announcement.ogg') }}" type="audio/ogg">
            <source src="{{ asset('snd/announcement.mp3') }}" type="audio/mpeg">
        </audio>
        <script>
            var AnnouncementSound = document.getElementById('announcement-sound');
            var Announcements = {
                init: function (ws, options) {
                    if(ws.text().length) {
                        // Do not create for empty message.
                        ws.marquee({pauseOnHover: true});
                    }

                    var host = 'ws.' + window.location.hostname;
                    var conn = new WebSocket('ws://' + host + ':{{$websocketPort}}?uid={{$user}}');
                    conn.onmessage = function (e) {
                        var msg = JSON.parse(e.data);
                        switch (msg.type) {
                            case "message":
                                ws.marquee('destroy').text(msg.text).marquee(options);

                                // Show new empty result with confirmation popover.
                                var display = $('.announcements');
                                if (display) {
                                    var results = display.find('.day:last').find('.results');
                                    var content = msg.text + '<br /><div class="announcement-popover-confirmation"><a href="#" class="btn btn-primary">Подтверждаю</a></div>';

                                    content = content.replace(/"/g, '&quot;');
                                    var newItem = $('<div data-original-title="" class="result" data-placement="top" ' +
                                    'data-toggle="popover" title="" data-content="' + content + '"></div>');

                                    results.append(newItem);
                                    newItem.popover({html: true, trigger: 'click'}).popover('show');
                                }
                                break;
                            case "notify":
                                    var now = Math.round(new Date().getTime()/1000);

                                AnnouncementSound.play(); // Play sound.
                                var notification = $('#announcement-notification');
                                if (notification.length) {
                                    notification.show(); // Show text notification.
                                    setTimeout(function () {
                                        notification.hide();
                                    }, (msg.expires - now)*1000); //Hide after 5 sec.
                                }
                                break;
                            case "notifyCancel":
                                $('#announcement-notification').hide();
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
