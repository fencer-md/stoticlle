@extends('layouts.frontend.base')

{{-- Required to show announcements --}}
@include('announcements.common.stream-helpers')
@macro('groupMessage', $group)
@foreach($group as $a)
    {{inlineAnnouncementStatus($a)}} {{$a->getMessageWithBets()}}<br/>
@endforeach
@endmacro

@section('content')
    @if(Session::has('msg'))
        <div class="col-md-12" id="successModal">
            <h3>Статус регестраций</h3>

            <div class="col-md-12 container">
                {{ Session::get('msg') }}
            </div>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="col-md-12" id="errorModal">
            <span class="error-icon"><i class="fa fa-thumbs-o-down"></i></span>
            <span class="error-title">{{ Session::get('errorTitle') }}</span>

            {{ Session::get('error') }}
        </div>
    @endif
    <section class="map-region hidden-xs">
        <div class="container-fluid">
            <div class="map col-md-12 col-xs-12" id="world_map"></div>

            <div class="announce col-xs-12 pull-left">@include('announcements.ticker')</div>
        </div>

    </section>

    <section class="content-region">
        <section class="site-information col-xs-push-12">
            <div class="site-information-header">
                Lorem ipsum и всё такое
            </div>

            <div class="site-information-text">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-1">
                            <div class="col">
                                <img src="{{ URL::asset('images/people.png') }}" alt="people">

                                <div class="text">
                                    <div class="number">35</div>
                                    <div class="info">Пользователей</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-middle">
                            <div class="col">
                                <img src="{{ URL::asset('images/persent.png') }}" alt="people">

                                <div class="text">
                                    <div class="number">$188237</div>
                                    <div class="info">Всего в системе</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-3">
                            <div class="col">
                                <img src="{{ URL::asset('images/airplane.png') }}" alt="people">

                                <div class="text">
                                    <div class="number">823237</div>
                                    <div class="info">Анонсов в системе</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="announcements-section">
            <div class="container">
                <div class="stream-wrapper" style="margin: 0">
                    <div class="announcements-wrapper">
                        {{--
                        <div class="scroll-button-right"><i class="fa fa-chevron-right"></i></div>
                        <div class="scroll-button-left"><i class="fa fa-chevron-left"></i></div>
                        --}}
                        <div class="announcements">
                            @include('announcements.common.stream', ['grouped' => $stream])
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="site-moto">
            <div class="container">
                <div class="row">
                    <span class="moto-head">Спортивный беттинг. Всё по-новому.</span>
                    Шаг за шагом, компьютерные технологии затрагивали области нашей жизни и полностью меняли её.<br/>
                    На этот раз пришла пора изменить индустрию спортивных ставок.<br/>
                    Знакомьтесь - это Jarvis.
                </div>
            </div>
        </div>

        <section class="columns">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="info-button info-button-active" data-target=".info-text-1">
                            <i class="flaticon-dollar116"></i> Что такое Jarvis?
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="info-button" data-target=".info-text-2">
                            <i class="flaticon-dart13"></i> На сколько точно это?
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="info-button" data-target=".info-text-3">
                            <i class="flaticon-paper-bill"></i> Как я могу заработать?
                        </div>
                    </div>
                </div>

                <div class="row info-text info-text-active info-text-1">
                    <div class="col-xs-12 col-sm-6 col-md-6 image">
                        <i class="flaticon-dollar116"></i>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h3>Что такое Jarvis?</h3>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non augue in nunc
                            sollicitudin gravida eu id mauris. Mauris sagittis elit quam, in aliquam elit venenatis ac.
                            Proin efficitur venenatis nunc, eu finibus velit sollicitudin vitae.
                        </p>

                        <p>
                            Integer posuere ac ex pulvinar iaculis. Mauris pretium ipsum in egestas accumsan. Morbi ac
                            luctus quam. Mauris fermentum lorem vel elit sagittis porta quis vel risus.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>

                <div class="row info-text info-text-2">
                    <div class="col-xs-12 col-sm-6 col-md-6 image">
                        <i class="flaticon-dart13"></i>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h3>На сколько точно это?</h3>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non augue in nunc
                            sollicitudin gravida eu id mauris. Mauris sagittis elit quam, in aliquam elit venenatis ac.
                            Proin efficitur venenatis nunc, eu finibus velit sollicitudin vitae.
                        </p>

                        <p>
                            Integer posuere ac ex pulvinar iaculis. Mauris pretium ipsum in egestas accumsan. Morbi ac
                            luctus quam. Mauris fermentum lorem vel elit sagittis porta quis vel risus.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>

                <div class="row info-text info-text-3">
                    <div class="col-xs-12 col-sm-6 col-md-6 image">
                        <i class="flaticon-paper-bill"></i>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h3>Как я могу заработать?</h3>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non augue in nunc
                            sollicitudin gravida eu id mauris. Mauris sagittis elit quam, in aliquam elit venenatis ac.
                            Proin efficitur venenatis nunc, eu finibus velit sollicitudin vitae.
                        </p>

                        <p>
                            Integer posuere ac ex pulvinar iaculis. Mauris pretium ipsum in egestas accumsan. Morbi ac
                            luctus quam. Mauris fermentum lorem vel elit sagittis porta quis vel risus.
                        </p>
                        <a href="#">Read more</a>
                    </div>
                </div>

            </div>
        </section>

        <div class="how-it-works">
            <h2>Как это работает?</h2>

            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 no-side-padding">
                        <div class="img-circle circle-blue">
                            <i class="flaticon-send4"></i>
                        </div>
                        <h3>Get a free trial</h3>

                        <div class="text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non augue in
                            nunc sollicitudin gravida eu id mauris.
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-4 no-side-padding">
                        <div class="img-circle circle-white">
                            <i class="flaticon-dart13"></i>
                        </div>
                        <h3>Get Jarvis forecast</h3>

                        <div class="text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non augue in
                            nunc sollicitudin gravida eu id mauris.
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-4 no-side-padding">
                        <div class="img-circle circle-white">
                            <i class="flaticon-paper-bill"></i>
                        </div>
                        <h3>Earn money</h3>

                        <div class="text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non augue in
                            nunc sollicitudin gravida eu id mauris.
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="trial">
            <h2>Пользуйтесь 1 неделю совершенно бесплатно</h2>

            <div>
                <a class="trial-registration" id="trial-registration" href="#">Зарегистрироваться</a>
            </div>
        </div>
    </section>
@stop

@section('custom_scripts')
    <link href="{{ asset('css/announcements.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pictonic.css') }}" rel="stylesheet">
    <link href="{{ asset('font/flaticon/flaticon.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('/maps/ammap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/maps/worldLow.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/maps/continentsLow.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/map.js') }}" type="text/javascript"></script>

    <script>
        var mapData = {{ $mapData }};
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover({html: true, trigger: 'hover'});

            $('.info-button').click(function (e) {
                e.preventDefault();
                var $this = $(this);
                $('.info-button').removeClass('info-button-active');
                $('.info-text').removeClass('info-text-active');

                $this.addClass('info-button-active');
                $($this.data('target')).addClass('info-text-active');
            });

            $('#trial-registration').click(function(e){
                e.stopPropagation();
                e.preventDefault();

                // Scroll to top.
                window.scrollTo(0, 0);
                // Show registration form.
                $('#join').click();
            });
        });
    </script>
@stop
