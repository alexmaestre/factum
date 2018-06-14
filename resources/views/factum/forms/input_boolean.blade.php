<div class="form-group">
	<div class="col-md-2 control-label text-right"> {{ $label }}</div>
	<div class="col-md-10 input-icon input-group right">	
	<label class="mt-checkbox mt-checkbox-outline"> {{ $placeholder }}
		<input type="checkbox" {!! @$objectData !!} id="{{ @$id }}" name="{{ @$id }}" {{ @$checked }} data-label="{{$label}}">
		<span></span>
	</label>
	</div>	
</div>