<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title">Reward money</h4>
</div>			    
<div class="modal-body">
	<div class="row dialog">
    {{ Form::open(['action' => 'OfferController@create', 'class' => 'form-horizontal']) }}
    	{{ Form::hidden('uid', Input::get('uid')) }}
        <div class="form-body col-md-8">
            <div class="form-group">
                {{ Form::label('body', 'Offer', ['class' => 'control-label dialog']) }}
                <div class="controls">
                    <div class="col-md-9">
                      {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                      {{ Form::submit('Submit', ['class' => 'btn blue']) }}
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
   </div>
</div>