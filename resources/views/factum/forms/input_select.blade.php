<div class="form-group">
	<div class="col-md-2 control-label text-right">{{ $label }}</div>
	<div class="col-md-10 input-icon input-group right">		
		@if($edit)<span class="input-group-btn"><button class="btn " type="button"><i class="fa fa-save"></i></button></span>@endif									
		<select class="form-control" {!! @$objectData !!} {!! @$loadApi !!} id="{{ @$id }}" name="{{ @$id }}" @if(!empty($value)) data-selected="{{$value}}" @endif data-label="{{$label}}">
			{!! @$options !!}
		</select>
	</div>
</div>	