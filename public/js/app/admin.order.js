//*** Loading list
$('#list-order').load('/admin/orders/list')

$id = $('#order_id').text()
$('#block-show').load('/admin/orders/'+ $id) 



//*** iCheck
$('input').iCheck({
  checkboxClass: 'icheckbox_flat-orange',
  radioClass: 'iradio_flat-orange'
});



//*** Get parameter for product list (filtering menu product)
$('#product_status input').on('ifChecked ifUnchecked', function(){
  	var selected = [];
  	$('#product_status input:checked').each(function() {
     	selected.push($(this).attr('name'));
  	});  
  	state = selected.join('_')
	$('#list-product').load('/admin/products/list/'+state)  
})
 
/* kosongkan input file setiap modal close */ 
$(document).on('hidden.bs.modal', '#modal-edit-product', function(){
  $('.fileinput').fileinput('clear')
})



/*
**
 Click button item to process proposal
**
*/

$(document).on('click', '#btn-process-proposal', function(){
	$('.modal-shared-product').attr('id', 'modal-edit-proposal')
	$('#modal_title').text('Verifikasi Usulan')
	$('#modal-edit-proposal').modal('show')
	
	$('#product_pending').iCheck('check') //first, always pending

	data = $(this).data('data')
	$('#product_id').val(data.id)
	if (data.image != '' ) {
     	$('#share-fileinput').removeClass('fileinput-new').addClass('fileinput-exists')
     	$('.fileinput-preview').html('<img src="/imagecache/medium/'+data.image+'" alt="">')
   } else {
      $('#share-fileinput').removeClass('fileinput-exists').addClass('fileinput-new') 
   }    

	$('#product_name').val(data.name)
	$('#product_price').val(data.price)
	$('#product_url').val(data.url)	

	$('#product_unit').val(data.unit)	
	$('#product_body').val(data.body)

	$('.btn-share-submit').attr('id', 'btn-update-proposal')

});


//*** Show Form only if proposal -> accepted
$('#product_approved').on('ifChecked', function(){
	$('.show-if-approved').show()
  $('.show-if-processed').show()
}).on('ifUnchecked', function(){
	$('.show-if-approved').hide()
  $('.show-if-processed').show()
})

$('#product_rejected').on('ifChecked', function(){
  $('.show-if-processed').show()
}).on('ifUnchecked', function(){
  $('.show-if-processed').show()
})


//*** SUBMIT button -> process proposal
$(document).on('click', '#btn-update-proposal',  function(e){
	e.preventDefault()
 	var form = $('#form-product')[0]
 	var formData = new FormData(form)
 	
 	$.ajax({
   	url: '/admin/products/update',
   	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
  		data: formData,
  		type:"POST",
  		contentType: false,
  		processData: false,

  		error: function(response){
   		var msg = response.responseJSON.errors;
   		//msg.quantity ? $('#quantity-error').show().text(msg.quantity).parent().addClass('has-error') : $('#quantity-error').hide().parent().removeClass('has-error');
   		$('#ajaxmsg').html('gagal');
 		},

 		success: function(response){
 			$('#modal-edit-proposal').modal('hide')
    		//$('input,textarea').val('')         
    		//$('#modal-edit-proposal').modal('hide');           
    		$('#ajaxmsg').html('<div class="alert alert-success">Permintaan <em>'+ +'</em> berhasil diperbarui.</div>');
    		$('#list-product').load('/admin/products/list')
 		}
		});         
})

/*
**
 Click button edit product
**
*/

$(document).on('click', '.btn-edit-product', function(){
  $('.modal-shared-product').attr('id', 'modal-edit-product')
  $('#modal_title').text('Edit Barang')
  $('#modal-edit-product').modal('show')

  data = $(this).data('data')
  $('#form-product').find('input#product_'+data.status).iCheck('check')

  $('#product_id').val(data.id)
  if (data.image != '' ) {
      $('#share-fileinput').removeClass('fileinput-new').addClass('fileinput-exists')
      $('.fileinput-preview').html('<img src="/imagecache/medium/'+data.image+'" alt="">')
   } else {
      $('#share-fileinput').removeClass('fileinput-exists').addClass('fileinput-new') 
   } 

  $('#product_name').val(data.name)
  $('#product_price').val(data.price)
  $('#product_url').val(data.url) 
  if(data.disposable == 'hp'){
    $('#disposable').iCheck('check')
  } else if(data.disposable == 'unhp'){
    $('#disposable').iCheck('uncheck')
  }

  $('#product_unit').val(data.unit) 
  $('#product_body').val(data.body)

  $('.btn-share-submit').attr('id', 'btn-update-product')

});

//*** SUBMIT button -> edit product
$(document).on('click', '#btn-update-product',  function(e){
  e.preventDefault()
  var form = $('#form-product')[0]
  var formData = new FormData(form)
  
  $.ajax({
    url: '/admin/products/update',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: formData,
      type:"POST",
      contentType: false,
      processData: false,

      error: function(response){
      var msg = response.responseJSON.errors;
      //msg.quantity ? $('#quantity-error').show().text(msg.quantity).parent().addClass('has-error') : $('#quantity-error').hide().parent().removeClass('has-error');
      $('#ajaxmsg').html('<div class="alert alert-danger">Error..mohon kontak admin arifptm@gmail.com</div>');
      $('#modal-edit-product').modal('hide')
    },

    success: function(response){
      $('#modal-edit-product').modal('hide')
        //$('input,textarea').val('')         
        //$('#modal-edit-proposal').modal('hide');           
        $('#ajaxmsg').html('<div class="alert alert-success">Permintaan <em><b>'+ response.product +'</b></em> berhasil diperbarui.</div>');
        $('#list-product').load('/admin/products/list')
    }
  });         
})
  

/*
**
 Click button delete product
**
*/    

$('body').on('click', '.btn-delete-product', function(){
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
          formData.append('id', $(this).data('product_id'))

          $.ajax({
            url: '/admin/products/delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            data: formData,
            type:"POST",
            contentType: false,
            processData: false,
          })
          .done(function(){
            $('#list-product').load('/admin/products/list');  
          })
      }
  })
});
