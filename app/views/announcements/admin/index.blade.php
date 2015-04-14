@extends('layouts.backend.base')

@include('announcements.common.stream-helpers')

@section('content')
    <h3 class="page-title">Announcements</h3>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ URL::to('admin/announcements/stream-create') }}" class="btn btn-primary">Сформировать поток</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".send-announcement">Анонс</button>
        </div>

        <div class="col-md-1 pull-right">
            <div id="server-status" class="badge pull-right">Status</div>
        </div>
    </div>

    @foreach($streams as $stream)
        <div class="row">
            <div class="col-md-12 stream-wrapper">
                <div class="col-md-1 stream">
                    <div class="name">{{$stream->name}}</div>
                    <div class="buttons">
                        <a class="clock start-countdown" href="{{ URL::to('admin/announcements/start-countdown', array('id' => $stream->id)) }}">
                            <i class="fa fa-clock-o"></i>
                        </a>
                        <a class="cancel" href="{{ URL::to('admin/announcements/stop-countdown', array('id' => $stream->id)) }}">
                            <i class="fa fa-times"></i>
                        </a>
                        <a class="pause" href="{{ URL::to('admin/announcements/pause', array('id' => $stream->id)) }}">
                            <i class="fa fa-pause"></i>
                        </a>
                    </div>
                    <input type="text" class="announcement-name-input">
                    <div class="timer" id="timer-{{$stream->id}}">{{$stream->getCountdownTimestamp()}}</div>
                </div>

                <div class="col-md-11 announcements-wrapper">
                    <div class="scroll-button-right"><i class="fa fa-chevron-right"></i></div>

                    <div class="announcements">
                        {? $grouped = $stream->groupedByDate('d.m.Y') ?}
                        @include('announcements.common.stream')
                    </div>
                </div>

            </div>
        </div>
    @endforeach

    <table class="table table-hover result-announcements">
        <thead>
        <tr class="blue">
            <th width="150">Результат</th>
            <th>Номер</th>
            <th>Имя</th>
            <th>Гейм</th>
            <th>Коеффициент</th>
            <th>Время</th>
            <th>Поток</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($announcements as $a)
            <tr>
                <td>
                    <a href="{{ URL::to(
                        'admin/announcements/result',
                        array('id' => $a->id, 'value' => Announcement::SUCCESS)
                     ) }}" class="result text-green"><i class="fa fa-plus"></i></a>
                    <a href="{{ URL::to(
                        'admin/announcements/result',
                        array('id' => $a->id, 'value' => Announcement::FAIL)
                     ) }}" class="result text-red"><i class="fa fa-minus"></i></a>
                </td>
                <td>{{$a->announcement_type}}</td>
                <td>{{$a->name}}</td>
                <td>{{$a->game}}</td>
                <td>{{$a->coefficient}}</td>
                <td>{{$a->created_at->format('H:i / m.d.Y')}}</td>
                <td>{{$a->stream->name}}</td>
                <td><a href="{{ URL::to(
                        'admin/announcements/result',
                        array('id' => $a->id, 'value' => 0)
                     ) }}" class="result"><i class="fa fa-trash-o"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade send-announcement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center" id="send_announcement">Отправить анонс</h4>
                </div>
                <div class="modal-body row">
                    {{ Form::open(array(
                        'url' => 'admin/announcements/create',
                        'class' => 'form-inline col-md-12',
                        'method' => 'post',
                        'role' => 'form'
                     )) }}
                        <div class="radio-buttons-group col-sm-3">
                            <div class="radio-list col-sm-4">
                                {{ Form::radios('probability', $probabilityRadios, null, ['required']) }}
                            </div>
                            <div class="radio-list col-sm-4">
                                {{ Form::radios('series_id', $streamsRadios, null, ['required']) }}
                            </div>
                            <div class="radio-list col-sm-4">
                                {{ Form::radios('announcement_type', $typeRadios, null, ['required']) }}
                            </div>
                        </div>

                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="announcement-name">Имя</label>
                            {{ Form::text('name', null, ["class" => "form-control", "placeholder" => "Имя", "required"]) }}
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="sr-only" for="announcement-name">Гейм</label>
                            {{ Form::text('game', null, ["class" => "form-control", "placeholder" => "Гейм", "required"]) }}
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="sr-only" for="announcement-name">Коеффициент</label>
                            {{ Form::text('coefficient', null, ["class" => "form-control", "placeholder" => "Коеффициент", "required"]) }}
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn blue">Отправить</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_scripts')
    <script src="{{ URL::asset('js/jquery.plugin.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.countdown.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Check websocket server status.
            function checkServer() {
                $.get('/admin/announcements/server-status', function (data) {
                    var status = $('#server-status');
                    status.removeClass(function (index, css) {
                        return (css.match(/(^|\s)badge-\S+/g) || []).join(' ');
                    });
                    if (data == 1) {
                        status.addClass('badge-success');
                    } else {
                        status.addClass('badge-danger');
                    }
                });
            }

            checkServer();
            setInterval(checkServer, 300000); // Check status each 5 minutes.

            // Update countdowns for each stream.
            $('.stream .timer').each(function () {
                var countdown = new Date(parseInt($(this).text()) * 1000);
                var selector = '#' + this.id;
                $(selector).countdown({
                    until: countdown,
                    compact: true,
                    format: 'MS',
                    description: ''
                }).show();
            });

            $.fn.hScroll = function (options) {
                function scroll(obj, e) {
                    var evt = e.originalEvent;
                    var direction = evt.detail ? evt.detail * (-120) : evt.wheelDelta;
                    if (direction > 0) {
                        direction = $(obj).scrollLeft() - 120;
                    } else {
                        direction = $(obj).scrollLeft() + 120;
                    }
                    $(obj).scrollLeft(direction);
                    e.preventDefault();
                }

                $(this).width($(this).find('div').width());
                $(this).bind('DOMMouseScroll mousewheel', function (e) {
                    scroll(this, e);
                });
            };

            $('[data-toggle="popover"]').popover({html: true, trigger: 'hover'});

            $('.start-countdown').click(function(e){
                e.preventDefault();

                var name = $(this).parent().parent().find('input').val();
                if (name) {
                    $.post(this.href, {name: name}, function(){
                        window.location.reload();
                    });
                } else {
                    alert('Укажите имя');
                }
            });

            $('.pause').each(function(){
                var $this = $(this);
                var url = this.href;

                $this.datetimepicker({
                    autoclose: true,
                    todayBtn: false,
                    pickerPosition: "bottom"
                }).on('hide', function(ev){
                    $.post(url, {time: ev.date.toISOString()});
                });
            });
        });
    </script>
@stop

@macro('groupMessage', $group)
@foreach($group as $a)
    {{inlineAnnouncementStatus($a)}} {{$a->getMessageWithBets()}}<br />
@endforeach
@endmacro
