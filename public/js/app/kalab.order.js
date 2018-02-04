//*** Loading order list
$('#list-order').load('/kalab/orders/list')

//*** Loading order detail
$id = $('#order_id').text()
$('#block-show').load('/kalab/orders/'+ $id) 
 
/* kosongkan input file setiap modal close */ 
$(document).on('hidden.bs.modal', '#modal-edit-product', function(){
  $('.fileinput').fileinput('clear')
})


/* ACCEPT Order */
$(document).on('click', '#btn-accepted', function(){
    var order_id = $('#order_id').text()
    var formData = new FormData()  
    formData.set('order_id', order_id)
    $.ajax({
    url: '/kalab/orders/accept',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: formData,
      type:"POST",
      contentType: false,
      processData: false,
    })
    .done(function(res){
      $('#ajaxmsg').html('<div class="alert alert-success">'+res.msg+'</div>')
      $('#block-show').load('/kalab/orders/'+ $id) 
    })
})


/* REJECT Order */
$(document).on('click', '#btn-rejected', function(){
    var order_id = $('#order_id').text()
    var formData = new FormData()  
    formData.set('order_id', order_id)
    $.ajax({
    url: '/kalab/orders/reject',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: formData,
      type:"POST",
      contentType: false,
      processData: false,
    })
    .done(function(res){
      $('#ajaxmsg').html('<div class="alert alert-success">'+res.msg+'</div>')
      $('#block-show').load('/kalab/orders/'+ $id) 
    })
})

/* Add or Update Order Notes */
$(document).on('click', '#btn-create-notes', function(){
  $('.modal-shared-notes').attr('id', 'modal-create-notes')  
  $('#modal-create-notes').modal('show')
  $('#modal-title').text('Tambah Catatan')
  $('.btn-notes').attr('id', 'btn-store-notes').text('Simpan')
})

$(document).on('click', '#btn-edit-notes', function(){
  $('.modal-shared-notes').attr('id', 'modal-edit-notes')  
  $('#modal-edit-notes').modal('show')
  $('#notes').text($(this).data('notes'))
  $('#modal-title').text('Edit Catatan')
  $('.btn-notes').attr('id', 'btn-update-notes').text('Update')
})

$(document).on('click', '#btn-store-notes', function(e){
  e.preventDefault()
  var order_id = $('#order_id').text()
  var form = $('#form-notes')[0]
  var formData = new FormData(form)  
  formData.set('order_id', order_id)
  $.ajax({
    url: '/kalab/orders/add-notes',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: formData,
    type:"POST",
    contentType: false,
    processData: false,
  })
  .done(function(res){
    $('#modal-create-notes').modal('hide')
    $('#ajaxmsg').html('<div class="alert alert-success">'+res.msg+'</div>')
    $('#block-show').load('/kalab/orders/'+ $id) 
  })
})

$(document).on('click', '#btn-update-notes', function(e){
  e.preventDefault()
  var order_id = $('#order_id').text()
  var form = $('#form-notes')[0]
  var formData = new FormData(form)  
  formData.set('order_id', order_id)
  $.ajax({
    url: '/kalab/orders/update-notes',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: formData,
    type:"POST",
    contentType: false,
    processData: false,
  })
  .done(function(res){
    $('#modal-edit-notes').modal('hide')
    $('#ajaxmsg').html('<div class="alert alert-success">'+res.msg+'</div>')
    $('#block-show').load('/kalab/orders/'+ $id) 
  })
})