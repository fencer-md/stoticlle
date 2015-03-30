@extends('layouts.backend.base')

@include('announcements.common.stream-helpers')

@section('content')
    @if($stream)
        <h3 class="page-title">{{trans('userpage.userchat')}}</h3>

        <div class="col-md-12">
            <div class="clearfix">
                <form class="pull-left form-inline clearfix" id="account-sum-form">
                    <div class="form-group user-chart-form">
                        <label for="account-sum">{{trans('userpage.accountsum')}}</label>
                        <input type="text" class="form-control" id="account-sum" value="{{$accountSum}}">
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 stream-wrapper">
                <div class="col-md-10 announcements-wrapper">
                    <div class="scroll-button-right"><i class="fa fa-chevron-right"></i></div>

                    <div class="announcements">
                        {? $grouped = $stream->groupedByDate('d.m.Y', $user) ?}
                        @include('announcements.common.stream')
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="package-footer">
                        <div class="package-footer-header">{{trans('userpage.totalbids')}}:</div>
                        <div class="package-footer-body">{{$grouped['count']}}</div>
                        <div class="package-footer-footer"><img src="{{asset('images/calendar.png')}}" alt="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-12">
            {{trans('userpage.signupfor')}}
        </div>
    @endif
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

        // Save sum on change.
        $('#account-sum').blur(function(){
            $.post('/user/announcements/account-sum',{sum: $(this).val()});
        });

        // Prevent "sum" form submit.
        $('#account-sum-form').submit(function(e){
            e.preventDefault();
        });
    });
</script>
@stop

@macro('groupMessage', $group)
@foreach($group as $a)
    {{inlineAnnouncementStatus($a)}} {{$a->getMessage()}}<br />
@endforeach
@endmacro
