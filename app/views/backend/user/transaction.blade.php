@extends('layouts.backend.base')

@section('content')
<!-- div class="center-big-width clearfix"> -->
<h3 class="page-title">User Chat</h3>
<div class="col-md-12">
	<div class="clearfix">	
		<form class="pull-left form-inline clearfix">
			<div class="form-group user-chart-form">
				<label for="account-sum">Сумма на счету</label>
				<input type="text" disabled class="form-control disabled-input" id="account-sum" 	placeholder="1000">
			</div>
		</form>
	</div>
	<div class="user-anouncements">
	<div class="announcements-packages clearfix">
		<div class="pull-right package-footer">
			<div class="package-footer-header">Всего ставок:</div>
			<div class="package-footer-body">334</div>
			<div class="package-footer-footer"><img src="../../../../public/images/calendar.png" alt="calendar"></div>
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
							<td class="coefficient" data-placement="top" data-toggle="popover" data-content="2 Sharapova Mariagame 30 k-2.37 pdt">17.2</td>
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
	</div>
  <!--
<table id="transactions" class="table table-hover">
     <thead>
     <td>ID</td>
        <td>Число</td>
        <td>Тип транзакции</td>
        <td>Направление</td>
        <td>Реквезиты</td>
        <td>Сума ($)</td>
    </thead>
    <tbody>
      @foreach ( $data['transactions'] as $transaction )
      <tr>
        <td>{{ $transaction->id }}</td>
        <td>{{ $transaction->date }}</td>
        <td>@if ( $transaction->payment_system == NULL )
            System
            @else
            {{ $transaction->payment_system }}
            @endif
        </td>
        <td>
            @if ( $transaction->transaction_direction == 'added(denied)' || $transaction->transaction_direction == 'withdraw(denied)' )
            <a data-toggle="modal" data-target="#info-dialog" href="{{ URL::to('user/admin/transaction/commentary?tid='.$transaction->id) }}">{{ $transaction->transaction_direction }}</a>
            @else
            {{ $transaction->transaction_direction }}
            @endif
        </td>
        @if ( $transaction->transactionFrom != null )
        <td>{{ $transaction->transactionFrom->account_id }}</td>
        @else
        <td>-</td>
        @endif
        <td>{{ $transaction->ammount }}</td>
    </tr>
    @endforeach
</tbody>
</table>
-->
<br>
</div>
</div>
<div class="modal fade" id="info-dialog" tabindex="-1" role="dialog" aria-labelledby="award" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
</div>
<!-- </div> --> 
@stop

@section('custom_scripts')
<script>
    $('#info-dialog').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
    $(document).ready(function() {
    	$(function () {
				$('[data-toggle="tooltip"]').tooltip()
				});
			$(function() {
				$('.user-anouncements .package-body').jScrollPane();
			});
			$(function () {
				$('[data-toggle="popover"]').popover()
			});
			
			$('.coefficient').popover('show');
			$('.popover-content').append("<div>'this added to popover from js on page'</div>")
			
			var aP = $('.user-anouncements').outerWidth();
			var pH = $('.user-anouncements .package-footer').outerWidth();
			x = Math.round(pH);
			$('.user-anouncements .package-footer').outerWidth(x+1);
			$('.user-anouncements .package-body').width(aP-pH-1);
		});
</script>
@stop