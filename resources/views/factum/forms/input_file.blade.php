<div class="form-group">
	<div class="col-md-2 control-label text-right">{{ $label }}</div>
	<div class="col-md-10 input-icon input-group right">
		<i class="fa"></i>
		<input type="file" class="{{ @$masks }}" id="{{ @$id }}" name="{{ @$id }}" {!! @$accept !!} {!! @$placeholder !!} {!! @$required !!} data-label="{{$label}}">
	</div>					
</div>