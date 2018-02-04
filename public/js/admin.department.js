$('#list-department').load('/admin/departments/list')

$('.modal').on('hidden-bs-modal', function(){
   console.log('asdasd');
})

/* CREATE DEPARTMENT 
=====================*/

$(document).on('click', '#btn-store-department', function(e){
	e.preventDefault()
  	
  	var form = $('#form-create-department')[0]
  	var formData = new FormData(form) 	
 	
 	$.ajax({
        url: '/admin/departments/store',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		data: formData,
		type:"POST",
		contentType: false,
		processData: false
	})
	.done(function(response){
		$('#modal-create-department').modal('hide')
  		$('#list-department').load('/admin/departments/list')
  		$('#form-create-department')[0].reset()
  		$('#ajaxmsg').html('<div class="alert alert-success"><b> ' + response.department.name + ' </b>berhasil ditambahkan..!</div>')
	})	
	.fail(function(response){
  		var msg = response.responseJSON.errors  		
  		$('#err-create-department-name').html(msg.name)
  	})
});




/* EDIT DEPARTMENT 
=====================*/

$(document).on('click', '.btn-edit-department', function(e){
	$('#modal-edit-department').modal('show')
	$('#form-edit-department #name').val($(this).data('name'))	
	$('#form-edit-department #id').val($(this).data('id'))
});

$(document).on('click', '#btn-update-department', function(e){
	e.preventDefault()
  	var form = $('#form-edit-department')[0]
  	var formData = new FormData(form) 	
 	
 	$.ajax({
        url: '/admin/departments/update',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		data: formData,
		type:"POST",
		contentType: false,
		processData: false
	})
	.done(function(response){
		$('#modal-edit-department').modal('hide')
  		$('#list-department').load('/admin/departments/list')
  		//$('#form-edit-department')[0].reset()
  		$('#ajaxmsg').html('<div class="alert alert-success"><b> ' + response.department.name + ' </b>berhasil diperbarui..!</div>')
	})	
	.fail(function(response){
  		var msg = response.responseJSON.errors  		
  		$('#err-create-department-name').html(msg.name)
  	})
});






/* DELETE DEPARTMENT 
=====================*/
$(document).on('click', '.btn-delete-department', function(){
	var department_id = $(this).data('department_id')
	swal({
	    title: 'Apakah anda yakin?',
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    cancelButtonText: 'Batal',
	    confirmButtonText: 'Ya, hapus!',
	}).then((result) => {
    	if (result.value) {
       		var formData = new FormData()
       		formData.append('department_id', $(this).data('department_id'))

	       	$.ajax({
	         	url: '/admin/departments/delete',
	         	headers: {
	          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          	},
	         	data: formData,
	         	type:"POST",
	         	contentType: false,
	         	processData: false
	        })
	       	.done (function(response){
				$('#ajaxmsg').html('<div class="alert alert-success">Data telah dihapus..!</div>')
				$('#list-department').load('/admin/departments/list')
	       	})
	       	.fail (function(response){
				var msg = response.responseJSON.errors
				$('#ajaxmsg').html('<div class="alert alert-danger">Error..!</div>')   
	       	})
    	}
 	})
});
