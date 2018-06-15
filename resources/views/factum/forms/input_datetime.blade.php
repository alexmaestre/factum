<div class="input-icon input-group right mb-2">	
	<label for="{{ @$id }}" class="sr-only">{{ $label }}</label>
	@if($edit) <span class="input-group-btn"><button class="btn " type="button"><i class="fa fa-save"></i></button></span> @endif
	<input type="text" {!! @$objectData !!} {{ @$maxLength }} {{ @$minLength }} value="{{ @$value }}" id="{{ @$id }}" name="{{ @$id }}" class="form-control form-control-inline input-medium datetime-picker" {!! @$required !!} placeholder="{{$placeholder}}" data-label="{{$label}}">
</div>