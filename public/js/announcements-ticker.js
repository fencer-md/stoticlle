$(document).ready(function(){
    var marqueeOptions = {pauseOnHover: true};

    // Ajax version for users.
    var ajax = $('#announcements-ticker-ajax');
    if (ajax.length) {
        if(ajax.text().length) {
            // Do not create for empty message.
            ajax.marquee();
        }
        setInterval(function(){
            $.get('/announcements', function(data){
                ajax.marquee('destroy').text(data).marquee(marqueeOptions);
            });
        }, 300000); // 5 min
    }

    // WebSocket version for users with enabled announcements.
    var ws = $('#announcements-ticker-ws');
    if (ws.length) {
        Announcements.init(ws, marqueeOptions);
    }
});
