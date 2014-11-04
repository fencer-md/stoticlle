<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title">Add funds approval</h4>
</div>			    
<div class="modal-body">
	<div class="row dialog">
    {{ Form::open(['action' => 'TransactionsController@addMoneyRequestStatus', 'class' => 'form-horizontal']) }}
    	{{ Form::hidden('tid', Input::get('tid')) }}
      {{ Form::hidden('uid', Input::get('uid')) }}
      {{ Form::hidden('status', Input::get('status')) }}
        <div class="form-body col-md-8">
            <div class="form-group">
                @if ( Input::get('status') != 'deny' )
                  {{ Form::label('credentials', 'Credentials', ['class' => 'control-label dialog']) }}
                  <div class="controls">
                      <div class="col-md-9">
                        {{ Form::text('credentials', null, ['class' => 'form-control']) }}
                      </div>
                  </div>
                @endif
                {{ Form::label('body', 'Comments', ['class' => 'control-label dialog']) }}
                <div class="controls">
                    <div class="col-md-9">
                      {{ Form::textarea('text', null, ['class' => 'form-control']) }}
                      </div>
                </div>
                {{ Form::submit('Submit', ['class' => 'btn blue']) }}
            </div>
        </div>
    {{ Form::close() }}
   </div>
</div>