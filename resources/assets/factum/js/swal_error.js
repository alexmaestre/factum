function swal_error(text){
	swal({
	  title: 'Error',
	  text: text ,
	  type: "error",
	  allowOutsideClick: true,
	  showConfirmButton: false,
	  showCancelButton: true,
	  cancelButtonClass: "btn-danger",
	  cancelButtonText: "OK",
	  closeOnCancel: true
	});
}