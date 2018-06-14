<div class="form-group">
	<div class="col-md-2 control-label text-right"><?php echo $label; ?></div>
	<div class="col-md-10 input-icon input-group right">	
		@if($edit) <span class="input-group-btn"><button class="btn " type="button"><i class="fa fa-save"></i></button></span> @endif
		<input type="text" {!! @$objectData !!} {{ @$maxLength }} {{ @$minLength }} value="{{ @$value }}" id="{{ @$id }}" name="{{ @$id }}" class="form-control form-control-inline input-medium datetime-picker" {!! @$required !!}  data-label="{{$label}}">
	</div>
</div>