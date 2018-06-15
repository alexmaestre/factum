<div class="input-icon input-group right mb-2">
<label for="{{ @$id }}" class="sr-only">{{ $label }}</label>
@if($edit)<span class="input-group-btn"><button class="btn " type="button"><i class="fa fa-save"></i></button></span>@endif<input type="password" {!! @$objectData !!} class="form-control {{ @$masks }}" id="{{ @$id }}" name="{{ @$id }}" value="{{ @$value }}" placeholder="{{ @$placeholder }}" {!! @$email !!} {!! @$required !!} {!! @$maxLength !!} {!! @$minLength !!} data-label="{{$label}}">
</div>