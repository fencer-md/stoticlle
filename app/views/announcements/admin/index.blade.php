@extends('layouts.backend.base')

@macro('announcementStatus', $announcement)
@if ($announcement->success == Announcement::FAIL) <i class="fa fa-minus"></i>
@elseif($announcement->success == Announcement::SUCCESS) <i class="fa fa-plus"></i>
@endif
@endmacro

@macro('inlineAnnouncementStatus', $announcement)
@if ($announcement->success == Announcement::FAIL) <span class="text-red"><i class="fa fa-minus"></i></span>
@elseif($announcement->success == Announcement::SUCCESS) <span class="text-green"><i class="fa fa-plus"></i></span>
@endif
@endmacro

@macro('groupMessage', $group)
@foreach($group as $a)
    {{inlineAnnouncementStatus($a)}} {{$a->getMessage()}}<br />
@endforeach
@endmacro

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
                <div class="stream">
                    <div class="name">{{$stream->name}}</div>
                    <div class="buttons">
                        <a class="clock"
                           href="{{ URL::to('admin/announcements/start-countdown', array('id' => $stream->id)) }}"
                                ><i class="fa fa-clock-o"></i></a>{{--
                    --}}<a class="cancel"
                           href="{{ URL::to('admin/announcements/stop-countdown', array('id' => $stream->id)) }}"
                                ><i class="fa fa-times"></i></a>
                    </div>
                    <div class="timer" id="timer-{{$stream->id}}">{{$stream->getCountdownTimestamp()}}</div>
                </div>
                <div class="announcements">
                    @foreach($stream->groupedByDate('d.m.Y') as $day)
                        <div class="pull-left day">
                            <div class="date">{{$day->date}}</div>
                            <div class="results">
                                @foreach($day->announcements as $group){{--
                                --}}<div class="result
                                @if($group[count($group)-1]->success == 1) text-red
                                @elseif($group[count($group)-1]->success == 2) text-green
                                @endif" data-placement="top" data-toggle="popover" title=""
                                         data-content="{{{groupMessage($group)}}}">{{announcementStatus($group[count($group)-1])}}</div>{{--
                            --}}@endforeach
                            </div>
                        </div>
                    @endforeach
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
                                <label><input name="probability" value="99.7" type="radio">99.7%</label>
                                <label><input name="probability" value="64.7" type="radio">64.7%</label>
                                <label><input name="probability" value="33.7" type="radio">33.7%</label>
                                <label><input name="probability" value="16.7" type="radio">16.7%</label>
                                <label><input name="probability" value="7.7" type="radio">7.7%</label>
                            </div>
                            <div class="radio-list col-sm-4">
                                @foreach($streams as $stream)
                                    <label>
                                        <input name="series_id" value="{{$stream->id}}" type="radio">{{$stream->name}}
                                    </label>
                                @endforeach
                            </div>
                            <div class="radio-list col-sm-4">
                                @for ($i = 1; $i <= 3; $i++)
                                    <label><input name="announcement_type" value="{{$i}}" type="radio">N{{$i}}</label>
                                @endfor
                            </div>
                        </div>

                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="announcement-name">Имя</label>
                            <input class="form-control" id="announcement-name" placeholder="Имя" type="text" name="name">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="sr-only" for="announcement-name">Гейм</label>
                            <input class="form-control" id="announcement-name" placeholder="Гейм" type="text" name="game">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="sr-only" for="announcement-name">Коеффициент</label>
                            <input class="form-control" id="announcement-name" placeholder="Коеффициент" type="text" name="coefficient">
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
            setInterval(checkServer, 30000); // Check status each 30sec.

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

            //$('.announcements-packages .package-body').jScrollPane();


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

            //$('.announcements-packages .package-body').hScroll();


            /*
             $('.announcements-packages .package-body').on('mousewheel', function(event) {
             console.log(event.deltaX, event.deltaY, event.deltaFactor);
             });
             */

            $("#start_date,#end_date").datepicker();
            /*
             var aP = $('.announcements-packages').width();
             var pH = $('.announcements-packages .package-header-info').outerWidth();
             $('.announcements-packages .package-body').width(aP-pH);
             */


            $('[data-toggle="popover"]').popover({html: true, trigger: 'hover'});

        });


    </script>
@stop
