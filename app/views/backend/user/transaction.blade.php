@extends('layouts.backend.base')

@section('content')
<h3 class="page-title">все транзакций</h3>
<div class="col-md-12">
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
<br>
</div>
<div class="modal fade" id="info-dialog" tabindex="-1" role="dialog" aria-labelledby="award" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
</div>
</div>
@stop

@section('custom_scripts')
<script>
    $('#info-dialog').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
</script>
@stop