@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Announcements</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{{ URL::to('admin/announcements/series-start') }}" class="btn btn-default">Начать серию</a>
                <a href="{{ URL::to('admin/announcements/countdown') }}" class="btn btn-default">Начать отчет</a>
                <a href="{{ URL::to('admin/announcements/create') }}" class="btn btn-default">Отправить анонс</a>
                <a href="{{ URL::to('admin/announcements/series-end') }}" class="btn btn-default">Закончить серию</a>
            </div>
        </div>

        <div class="col-md-1 pull-right">
            <div id="server-status" class="badge">Status</div>
        </div>
        @if ($countdownEnd)
            <div class="col-md-1 pull-right" id="countdown-wrapper">
                <span class="btn btn-default">
                    <i class="fa fa-clock-o"></i>
                    <span id="countdown-end"></span>
                </span>
            </div>
        @endif
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Тип</th>
            <th>Текст</th>
            <th>Коэффициент</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($announcements as $a)
            <tr>
                <td>{{ $a->announcement_type }}</td>
                <td>{{ $a->message }}</td>
                <td>{{ $a->coefficient }}</td>
                <td>@if ($a->expires_at->isPast()) Public @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop

@section('custom_scripts')
    <script src="{{ URL::asset('js/jquery.plugin.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.countdown.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            function checkServer() {
                $.get('/admin/announcements/status', function(data){
                    var status = $('#server-status');
                    status.removeClass(function (index, css) {
                        return (css.match (/(^|\s)badge-\S+/g) || []).join(' ');
                    });
                    if (data == 1) {
                        status.addClass('badge-success');
                    } else {
                        status.addClass('badge-danger');
                    }
                });
            }

            checkServer();
            setInterval(checkServer, 30000); // Check status each 30sec

            @if ($countdownEnd)
            var countdown = new Date({{$countdownEnd}}*1000);
            $('#countdown-end').countdown({
                until: countdown,
                compact: true,
                format:'MS',
                description: '',
                onExpiry: function(){
                    $('#countdown-wrapper').remove();
                }
            });
            @endif
        });
    </script>
@stop
