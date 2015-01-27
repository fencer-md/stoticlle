@if ($show)
    @if ($ajax)
        <div id="announcements-ticker-ajax">Ajax</div>
    @else
        <div id="announcements-ticker-ws">WebSocket</div>
    @endif
@endif
