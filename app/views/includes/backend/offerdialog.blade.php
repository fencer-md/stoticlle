<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title">Write an offer</h4>
</div>			    
<div class="modal-body">
	<div class="row dialog">
    {{ Form::open(['action' => 'OfferController@create', 'class' => 'form-horizontal']) }}
    	{{ Form::hidden('uid', Input::get('uid')) }}
        <div class="form-body col-md-8">
            <div class="form-group">
                {{ Form::label('body', 'Offer', ['class' => 'control-label dialog']) }}
                <div class="controls">
                      {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                </div>
                {{ Form::label('rate', 'Rate(%)', ['class' => 'control-label dialog']) }}
                <div class="controls">
                      {{ Form::text('rate', 5, ['class' => 'form-control']) }}
                </div>
                {{ Form::label('end_date', 'Offer ends on', ['class' => 'control-label dialog']) }}
                <div class="controls">
                      {{ Form::text('end_date', null, ['class' => 'form-control']) }}
                </div>
                {{ Form::submit('Submit', ['class' => 'btn blue']) }}
            </div>
        </div>
    {{ Form::close() }}
   </div>
</div>