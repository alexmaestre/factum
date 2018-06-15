<div class="input-icon input-group right mb-2">
<label for="{{ @$id }}" class="sr-only">{{ $label }}</label>
@if($edit)<span class="input-group-btn"><button class="btn " type="button"><i class="fa fa-save"></i></button></span>@endif <select class="form-control select2" {!! @$objectData !!} {!! @$loadApi !!} id="{{ @$id }}" name="{{ @$id }}" data-label="{{$label}}" data-placeholder="{{$placeholder}}">
	{!! @$option !!}
</select>
</div>