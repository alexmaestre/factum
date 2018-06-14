<div class="form-group">
	<div class="col-md-2 control-label text-right">{{ $label }}</div>
	<div class="col-md-10 input-icon input-group right">	
		@if($edit)<span class="input-group-btn"><button class="btn " type="button"><i class="fa fa-save"></i></button></span>@endif
		<select class="form-control select2" {!! @$objectData !!} {!! @$loadApi !!} id="{{ @$id }}" name="{{ @$id }}" style="width:100%;" data-label="{{$label}}">
			{!! @$option !!}
		</select>
	</div>
</div>	