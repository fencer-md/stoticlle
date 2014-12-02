<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title">Reward money</h4>
</div>			    
<div class="modal-body">
	<div class="row dialog">
    {{ Form::open(['action' => 'TransactionsController@moneyEarned', 'class' => 'form-horizontal']) }}
    	{{ Form::hidden('uid', Input::get('uid')) }}
    	{{ Form::hidden('tid', Input::get('tid')) }}
        <div class="form-body col-md-8">
            <div class="form-group">
                {{ Form::label('return_money', 'Ammount of money won', ['class' => 'control-label dialog']) }}
                <div class="controls">
                    <div class="col-md-9">
                      {{ Form::text('return_money', null, ['class' => 'form-control']) }}
                    </div>
                  {{ Form::submit('Reward', ['class' => 'btn blue']) }}
                </div>
            </div>
        </div>
    {{ Form::close() }}
   </div>
</div>