<div class="form-group">
	<div class="col-md-2 control-label text-right">{{ $label }}</div>
	<div class="col-md-10 input-icon input-group right">											
		<i class="fa"></i>
		<textarea {!! @$objectData !!} {{ @$maxLength }} {{ @$minLength }} class="form-control {{ @$masks }}" id="{{ @$id }}" name="{{ @$id }}" data-label="{{$label}}"><?php echo @$value; ?></textarea>
		@if($edit)<button class="btn btn-block" type="button" style="height:100%;"><i class="fa fa-save"></i></button>@endif
	</div>					
</div>