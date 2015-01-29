@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Announcements</h3>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ URL::to('admin/announcements/create') }}">Add</a>
        </div>
        <div class="col-md-1 pull-right">
            <div id="server-status" class="badge">Status</div>
        </div>
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
        });
    </script>
@stop