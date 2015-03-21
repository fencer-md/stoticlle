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
            var Announcements = {
                ws: null,
                options: {},
                init: function (ws, options) {
                    Announcements.ws = ws;
                    Announcements.options = options;
                    if(ws.text().length) {
                        // Do not create for empty message.
                        ws.marquee({pauseOnHover: true});
                    }

                    var host = 'ws.' + window.location.hostname;
                    var conn = new WebSocket('ws://' + host + ':{{$websocketPort}}?uid={{$user}}');
                    conn.onmessage = Announcements.onWebsocketMessage;
                },
                onWebsocketMessage: function(e){
                    var msg = JSON.parse(e.data);
                    switch (msg.type) {
                        case "message":
                            Announcements.onWSMessage(msg);
                            break;
                        case "notify":
                            Announcements.onWSNotify(msg);
                            break;
                        case "notifyCancel":
                            Announcements.onWSNotifyCancel(msg);
                            break;
                        case "result":
                            Announcements.onWSResult(msg);
                            break;
                    }
                },
                onWSMessage: function(msg, ws) {
                    Announcements.ws.marquee('destroy')
                            .text(msg.text)
                            .marquee(Announcements.options);

                    // Show new empty result with confirmation popover.
                    var display = $('.announcements');
                    if (display.length) {
                        var results = display.find('.day:last').find('.results');
                        var popup = msg.text + '<br />' +
                                '<div class="announcement-popover-confirmation">' +
                                '<a href="/user/announcements/bet/'+msg.id+'" class="btn btn-primary">Подтверждаю</a>' +
                                '</div>';
                        popup = popup.replace(/"/g, '&quot;');
                        var content = ($('#account-sum').val() / msg.ratio).toFixed(2);
                        var newItem = $('<div data-original-title="" class="result" data-placement="top" ' +
                        'data-toggle="popover" title="" data-content="' + popup + '">'+ content +'</div>');

                        results.append(newItem);
                        newItem.popover({html: true, trigger: 'click'}).popover('show');
                    }
                },
                onWSNotify: function(msg){
                    var now = Math.round(new Date().getTime()/1000);

                    // Hide previous canceled game.
                    $('#announcement-notification-canceled').hide();

                    var AnnouncementSound = document.getElementById('announcement-sound');
                    AnnouncementSound.play(); // Play sound.
                    var notification = $('#announcement-notification');
                    if (notification.length) {
                        notification.show(); // Show text notification.
                        setTimeout(function () {
                            notification.hide();
                        }, (msg.expires - now)*1000); //Hide after 5 sec.
                    }
                },
                onWSNotifyCancel: function(msg){
                    $('#announcement-notification').hide();
                    var canceled = $('#announcement-notification-canceled').show();
                    setTimeout(function(){
                        canceled.hide();
                    }, 120000); // Hide after 2 min
                },
                onWSResult: function(msg) {
                    // Refresh only announcements page.
                    var display = $('.announcements');
                    if (display.length) {
                        window.location.reload();
                    }
                }
            };
        </script>
    @endif
@endif
