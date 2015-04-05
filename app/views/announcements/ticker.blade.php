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
                conn: null,
                url: null,
                connect: function(){
                    var conn = new WebSocket(Announcements.url);
                    conn.onmessage = Announcements.onWebsocketMessage;
                    conn.onclose = Announcements.onWebsocketClose;
                    Announcements.conn = conn;
                },
                init: function (ws, options) {
                    Announcements.ws = ws;
                    Announcements.options = options;
                    if(ws.text().length) {
                        // Do not create for empty message.
                        ws.marquee({pauseOnHover: true});
                    }

                    var host = 'ws.' + window.location.hostname;
                    Announcements.url = 'ws://' + host + ':{{$websocketPort}}?uid={{$user}}';
                    Announcements.connect();
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
                onWebsocketClose: function(){
                    setTimeout(function(){
                        Announcements.connect();
                    }, 2000); // reconnect in 2 sec.
                },
                onWSMessage: function(msg, ws) {
                    Announcements.ws.marquee('destroy')
                            .text(msg.text)
                            .marquee(Announcements.options);

                    $('#announcement-notification').hide();
                    var AnnouncementSound = document.getElementById('announcement-sound');
                    AnnouncementSound.play(); // Play sound.

                    // Show new empty result with confirmation popover.
                    var display = $('.announcements');
                    if (display.length) {
                        var results = display.find('.day-date:first .results');
                        var popup = msg.text + '<br />' +
                                '<div class="announcement-popover-confirmation">' +
                                '<a href="/user/announcements/bet/'+msg.id+'" class="btn btn-primary">Подтверждаю</a>' +
                                '</div>';
                        popup = popup.replace(/"/g, '&quot;');
                        var content = ($('#account-sum').val() / msg.ratio).toFixed(2);
                        var newItem = $('<div data-original-title="" class="result" data-placement="top" ' +
                        'data-toggle="popover" title="" data-content="' + popup + '">'+ content +'</div>');

                        var placeholder = results.find(".result-placeholder");
                        if (placeholder.length) {
                            placeholder.before(newItem);
                        } else {
                            results.append(newItem);
                        }
                        var position = newItem.position();
                        var startingPosition = $('.announcements-wrapper').width();
                        newItem.css({zIndex: 100, left: startingPosition, position:"absolute"});

                        newItem.animate({"left": position.left}, 2000, function(){
                            if (placeholder.length) {
                                placeholder.remove();
                            }

                            newItem.css({position:"relative", zIndex:0, left:0});
                            newItem.popover({html: true, trigger: 'click'}).popover('show');
                        });
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
                        var text = notification.find('#announcement-notification-name');
                        text.text(msg.text);
                        notification.show(); // Show text notification.
                        setTimeout(function () {
                            notification.hide();
                            text.text('');
                        }, (msg.expires - now)*1000); //Hide after 5 sec.
                    }
                },
                onWSNotifyCancel: function(msg){
                    var AnnouncementSound = document.getElementById('announcement-sound');
                    AnnouncementSound.play(); // Play sound.

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
                        var AnnouncementSound = document.getElementById('announcement-sound');
                        AnnouncementSound.play(); // Play sound.

                        window.location.reload();
                    }
                }
            };
        </script>
    @endif
@endif
