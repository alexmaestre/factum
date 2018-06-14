<label for="{{ @$id }}" class="sr-only">{{ $label }}</label>
@if($edit)<span class="input-group-btn"><button class="btn " type="button"><i class="fa fa-save"></i></button></span>@endif									
<select class="form-control" {!! @$objectData !!} {!! @$loadApi !!} id="{{ @$id }}" name="{{ @$id }}" @if(!empty($value)) data-selected="{{$value}}" @endif data-label="{{$label}}">
	{!! @$options !!}
</select>