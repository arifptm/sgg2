$('#list-user').load('/admin/users/list');  

function clearForm(){	
	$('input,textarea,select').not('[type="checkbox"]').val('')
	$('input[type="checkbox"]').iCheck('uncheck')
	$('.err').text('')
}

$('.btn-clear').on('click', function(){
	clearForm()
})

$('input[type="checkbox"], input[type="radio"]').iCheck({
  checkboxClass: 'icheckbox_flat-orange',
  radioClass   : 'iradio_flat-orange'
})

$('#role2').on('ifChecked', function(){
	$('#department_id').show()	
}).on('ifUnchecked', function(){
	$('#department_id').hide()
	$('select[name="department_id"]').val('')
})

$('#verified').iCheck('check')

$('#form-user input').on('click', function(){
	$('.err').html('')
})

/* SHOW USER 
==================*/
// $(document).on('click', '.btn-show-user', function(){
// 	var data=$(this).parents('td').siblings().find('button.btn-edit-user').data('data')	
// 	$('.modal-show-user').modal('show')
// 	$('#show-title').text(data.name)
// })



/* CREATE USER 
==================*/
$('#btn-create-user').on('click', function(){	
	$('.modal-shared-user').attr('id', 'modal-create-user');
	$('#modal-create-user').modal('show')
	$('#modal_title').text('Tambah Pengguna')
	$('.btn-share-submit').attr('id', 'btn-store-user')
})

$('body').on('click', '#btn-store-user', function(e){
	e.preventDefault()
  	var form = $('#form-user')[0]
  	var formData = new FormData(form) 	
 	
 	$.ajax({
        url: '/admin/users/store',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		data: formData,
		type:"POST",
		contentType: false,
		processData: false
	})
	.done(function(response){
		$('#modal-create-user').modal('hide')
  		$('#list-user').load('/admin/users/list');  
  		$('#form-user')[0].reset()
  		$('#ajaxmsg').html('<div class="alert alert-success"><b> ' + response.user.name + ' </b>berhasil ditambahkan..!</div>')
	})	
	.fail(function(response){
  		var msg = response.responseJSON.errors  		
  		$('#err-create-user-name').html(msg.name)
  		$('#err-create-user-email').html(msg.email)
  		$('#err-create-user-password').html(msg.password)
  		$('#err-create-user-password_confirm').html(msg.password_confirm)
  		$('#err-create-user-role').html(msg.role)
  	})
  	.always(function(){
  		clearForm()
  	})
})



/* EDIT USER 
==================*/
$('body').on('click', '.btn-edit-user', function(){	
	clearForm()
	$('#verified_wrapper').show()

	$('.modal-shared-user').attr('id', 'modal-edit-user')
	$('#modal-edit-user').modal('show')
	$('#modal_title').text('Edit Pengguna')
	$('.btn-share-submit').attr('id', 'btn-update-user')

	var data = $(this)
	$('#user_id').val(data.data('user_id'))
	$('#name').val(data.data('user_name'))
	$('#email').val(data.data('user_email'))

	var roles = data.data('user_roles')
	i=0
	for(i;i<roles.length;i++){
		$('#role'+roles[i]).iCheck('check')
	}
	
	$('select[name="department_id"]').val(data.data('user_department_id'))
	
	if(data.data('user_verified') == 1){
		$('#verified').iCheck('check')
	}
})


$('body').on('click', '#btn-update-user', function(e){
	e.preventDefault()
  	var form = $('#form-user')[0]
  	var formData = new FormData(form)  	
 	
 	$.ajax({
        url: '/admin/users/update',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		data: formData,
		type:"POST",
		contentType: false,
		processData: false 
	})
	.done(function(response){
		clearForm()
		$('#modal-edit-user').modal('hide')
  		$('#list-user').load('/admin/users/list');  
  		$('#ajaxmsg').html('<div class="alert alert-success"><b> ' + response.user.name + ' </b>berhasil diperbarui..!</div>')
	})	
	.fail(function(response){ 
  		var msg = response.responseJSON.errors  	
  		$('#err-create-user-name').text(msg.name)
  		$('#err-create-user-email').html(msg.email)
  		$('#err-create-user-password').text(msg.password)
  		$('#err-create-user-password_confirm').text(msg.password_confirm)
  		$('#err-create-user-role').html(msg.roles)
  	})
});





/* DELETE USER 
==================*/
$('body').on('click', '.btn-delete-user', function(){
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
	       	formData.append('id', $(this).data('id'))

	       	$.ajax({
	         	url: '/admin/users/delete',
	         	headers: {
	          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          	},
	         	data: formData,
	         	type:"POST",
	         	contentType: false,
	         	processData: false,
	      	})
	      	.done(function(){
	      		$('#list-user').load('/admin/users/list');  
	      	})
	    }
 	})
});

