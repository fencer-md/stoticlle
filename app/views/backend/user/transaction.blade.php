@extends('layouts.backend.base')

@include('announcements.common.stream-helpers')

@section('content')
    <h3 class="page-title">User Chat</h3>

    <div class="col-md-12">
        <div class="clearfix">
            <form class="pull-left form-inline clearfix">
                <div class="form-group user-chart-form">
                    <label for="account-sum">Сумма на счету</label>
                    <input type="text" class="form-control" id="account-sum">
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 stream-wrapper">
        {? $grouped = $stream->groupedByDate('d.m.Y', $user) ?}
        @include('announcements.common.stream')
        <div class="package-footer">
            <div class="package-footer-header">Всего ставок:</div>
            <div class="package-footer-body">{{$grouped['count']}}</div>
            <div class="package-footer-footer"><img src="{{asset('images/calendar.png')}}" alt="calendar"></div>
        </div>
    </div>
@stop

@section('custom_scripts')
<script>
    $(document).ready(function() {
        $('#info-dialog').on('hidden.bs.modal', function() {
            $(this).removeData('bs.modal');
        });

        $('[data-toggle="popover"]').popover({html: true, trigger: 'hover'});

        var aP = $('.user-anouncements').outerWidth();
        var pH = $('.user-anouncements .package-footer').outerWidth();
        var x = Math.round(pH);
        $('.user-anouncements .package-footer').outerWidth(x+1);
        $('.user-anouncements .package-body').width(aP-pH-1);
    });
</script>
@stop
