@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Announcements</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{{ URL::to('admin/announcements/series-start') }}" class="btn btn-default">Начать серию</a>
                <a href="{{ URL::to('admin/announcements/countdown') }}" class="btn btn-default">Начать отчет</a>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".send-announcement">Отправить анонс</button><!-- href="{{ URL::to('admin/announcements/create') }}" -->
                <a href="{{ URL::to('admin/announcements/series-end') }}" class="btn btn-default">Закончить серию</a>
            </div>
            <div class="modal fade send-announcement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            	<div class="modal-dialog modal-lg">
            		<div class="modal-content">
            			<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title text-center" id="send_announcement">Отправить анонс</h4>
									</div>
									<div class="modal-body clearfix">
										
											<div class="radio-buttons-group col-sm-3">
												<form>
													<div class="radio-list col-sm-4">
														<label>
														<input name="optionsRadios" id="99.7" value="99.7" checked="" type="radio">99.7% </label>
														<label>
														<input name="optionsRadios" id="64.7" value="64.7" checked="" type="radio">64.7% </label>
														<label>
														<input name="optionsRadios" id="33.7" value="33.7" checked="" type="radio">33.7% </label>
														<label>
														<input name="optionsRadios" id="16.7" value="16.7" checked="" type="radio">16.7% </label>
														<label>
														<input name="optionsRadios" id="7.7" value="7.7" checked="" type="radio">7.7% </label>
														</div>
												</form>
												<form>
													<div class="radio-list col-sm-4">
														<label>
														<input name="optionsRadios" id="xx1" value="xx1" checked="" type="radio">xx1 </label>
														<label>
														<input name="optionsRadios" id="xx2" value="xx2" checked="" type="radio">xx2 </label>
														<label>
														<input name="optionsRadios" id="xx3" value="xx3" checked="" type="radio">xx3 </label>
													</div>
												</form>
												<form>
													<div class="radio-list col-sm-4">
														<label>
														<input name="optionsRadios" id="N1" value="N1" checked="" type="radio">N1 </label>
														<label>
														<input name="optionsRadios" id="N2" value="N2" checked="" type="radio">N2 </label>
														<label>
														<input name="optionsRadios" id="N3" value="N3" checked="" type="radio">N3 </label>
													</div>
												</form>
											</div>
											<form class="form-inline col-sm-9" role="form">
												<div class="form-group col-sm-4">
													<label class="sr-only" for="announcement-name">Имя</label>
													<input class="form-control" id="announcement-name" placeholder="Имя" type="text">
												</div>
												<div class="form-group col-sm-3">
													<label class="sr-only" for="announcement-name">Гейм</label>
													<input class="form-control" id="announcement-name" placeholder="Гейм" type="text">
												</div>
												<div class="form-group col-sm-3">
													<label class="sr-only" for="announcement-name">Коеффициент</label>
													<input class="form-control" id="announcement-name" placeholder="Коеффициент" type="text">
												</div>
												<button type="submit" class="btn blue">Отправить</button>
											</form>
										 
									</div>
            		</div>
            	</div>
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

<!--
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
-->
	<div class="announcements-packages clearfix">
		<div class="pull-left package-header-info">
			<div class="package-header">XX2</div>
			<div class="package-content"><img src="../../../../../public/images/clock.png" alt="clock"><img src="../../../../../public/images/close.png" alt="close"></div>
			<div class="package-footer">8:45</div>
		</div>
		<div class="package-body">
			<div class="item ">
				<div class="package-header">13.02.2015</div>
				<table class="table result-announcements">
		  		<tbody>
		  			<tr>
		  				<td><span class="add" data-toggle="tooltip" data-placement="right" title="2 MariaSharapova game 30k-2.37 pdt 17 человек">+</span><span class="dismiss" data-toggle="tooltip" data-placement="right" title="2 MariaSharapova game 30k-2.37 pdt 17 человек">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="item ">
				<div class="package-header">12.02.2015</div>
				<table class="table result-announcements">
		  		<tbody>
		  			<tr>
		  				<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="item ">
				<div class="package-header">11.02.2015</div>
				<table class="table result-announcements">
		  		<tbody>
		  			<tr>
		  				<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="item ">
				<div class="package-header">10.02.2015</div>
				<table class="table result-announcements">
		  		<tbody>
		  			<tr>
		  				<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="item ">
				<div class="package-header">09.02.2015</div>
				<table class="table result-announcements">
		  		<tbody>
		  			<tr>
		  				<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
							<td><span class="add">+</span><span class="dismiss">-</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<table class="table table-hover result-announcements">
		<thead>
			<tr class="blue">
				<th>Результат</th>
				<th>Номер</th>
				<th>Имя</th>
				<th>Гейм</th>
			  <th>Коеффициент</th>
			  <th>Время</th>
			  <th>Паток</th>
			</tr>
		</thead>
		<tbody>
		  <tr>
		    <td><span class="add">+</span><span class="dismiss">-</span></td>
		    <td>2</td>
		    <td>Sharapova Maria</td>
		    <td>30</td>
		    <td>2.32</td>
		    <td>17:12 / 25.02.2015</td>
		    <td>XX1</td>    
		  </tr>
		  <tr>
		    <td><span class="add">+</span><span class="dismiss">-</span></td>    
		    <td>2</td>
		    <td>Sharapova Maria</td>
		    <td>30</td>
		    <td>2.32</td>
		    <td>17:12 / 25.02.2015</td>
		    <td>XX2</td>    
		  </tr>
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
      $(function() {
				$('.announcements-packages .package-body').jScrollPane();
			});  

      $.fn.hScroll = function( options )  {
				function scroll( obj, e )  {
					var evt = e.originalEvent;
					var direction = evt.detail ? evt.detail * (-120) : evt.wheelDelta;
					if( direction > 0)  {
						direction =  $(obj).scrollLeft() - 120;
					}	else  {
						direction = $(obj).scrollLeft() + 120;
					}
					$(obj).scrollLeft( direction );
					e.preventDefault();
				}
				$(this).width( $(this).find('div').width() );
				$(this).bind('DOMMouseScroll mousewheel', function( e )  {
					scroll( this, e );
				});
			}
			$('.announcements-packages .package-body').hScroll(); 


/*
			$('.announcements-packages .package-body').on('mousewheel', function(event) {
				console.log(event.deltaX, event.deltaY, event.deltaFactor);
			});
*/

			$("#start_date,#end_date").datepicker();
			var aP = $('.announcements-packages').width();
			var pH = $('.announcements-packages .package-header-info').outerWidth();
			$('.announcements-packages .package-body').width(aP-pH);
			
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
			
		});
        
        
    </script>
@stop
