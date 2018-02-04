$('#block-content').load('/order/block/index')

$id = $('#product_id').text()
$('#block-show').load('/orders/'+ $id) 


$(document).on('hidden.bs.modal','#modal-edit-lineitem' ,function(){
   $('#form-lineitem')[0].reset()
}); 


$(document).on('click', 'a.product-name', function(){
   $.get("/product/"+$(this).data('slug'), function(data){
      let product = data.product
      $('#show-image').html('<img src="/imagecache/large/'+ product.image +'" alt="" class="img-responsive">')
      $('#show-title').text(product.name)
      $('#show-unit').text(product.unit)
      $('#show-price').text(product.price)
      $('#show-url').html('<a href="'+product.url+'">'+product.url+'</a>')            
      $('#show-notes').text(product.body || '---' )
      $('#show-created_at').text(product.created_at)      
   });
   
   $('.modal-show').modal('show')
})


      $(document).on('hidden.bs.modal','.modal-lineitem' ,function(){
         $('#notes').val('')
         $('#quantity').val('')
      });
        
      /*
      *
      * Edit Lineitem on SHOW page
      *
      */      
      $(document).on('click', '.btn-edit-lineitem', function(){
         $('.modal-lineitem').attr('id', 'modal-edit-lineitem')
         $('.modal-title').text('Edit permintaan')
         $('#lineitem_id').val($(this).data('lineitem_id'))
         $('#quantity').val($(this).data('lineitem_quantity'))
         $('#notes').val($(this).data('lineitem_notes'))
         $('#datatitle').html($(this).data('product_title'))
         $('#dataimage').html('<img alt="" src="/imagecache/medium/'+$(this).data('product_image')+'">')
         $('#dataunit').html($(this).data('product_unit'))
         $('.modal-footer').html(`
            <button id="btn-submit-edit-lineitem" class='btn btn-primary pull-left'>Edit permintaan</button>
            <button class='btn btn-default pull-left' data-dismiss='modal'>Batal</button>
            `)
         $('#modal-edit-lineitem').modal('show')  
      });

      $(document).on('click', '#btn-submit-edit-lineitem',  function(){
         var form = $('#form-lineitem')[0]
         var formData = new FormData(form)

         $.ajax({
           url: '/lineitem/ajax/update',
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           data: formData,
           type:"POST",
           contentType: false,
           processData: false,

           error: function(response){
             var msg = response.responseJSON.errors;
             
           },

           success: function(response){
             $('#block-show').load('/orders/'+$id)
             $('#quantity-error' ).hide().parent().removeClass('has-error');      
             $('#quantity').val('');
             $('#modal-edit-lineitem').modal('hide');           
             //$('#ajaxmsg').html('<div class="alert alert-success">Permintaan <em>'+response.item.product.name+'</em> berhasil diperbarui.</div>');     
           }
         });         
      });


      /*
      *
      * Delete Lineitem on ORDER page
      *
      */      
      $(document).on('click', '.btn-delete-lineitem', function(){
         var order_id = $(this).data('order_id')
         var product_id = $(this).data('product_id')
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
               ajaxDeleteLineitem(order_id,product_id)
            }
         })
      })

      function ajaxDeleteLineitem(order_id,product_id){

         var formData = new FormData()
         formData.append('order_id', order_id)
         formData.append('product_id', product_id)
         $.ajax({
            url: '/lineitem/ajax/delete',
            type:"POST",
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false,

            error: function(response){
               var msg = response.responseJSON.errors;
               console.log('error');
            },

            success: function(response){

              if (response.rest == 0 ){
                window.location.replace('/')  
              } else {
               $('#block-show').load('/orders/'+$id)
              }
              
              $('#ajaxmsg').html('<div class="alert alert-success"><b><em>'+response.msg+'</em></b> telah dihapus dari daftar permintaan.</div>');            
              checkCart()
            }
         });
      }


$(document).on('click', '#btn-checkout', function(){
  var formData = new FormData()
  formData.append('order_id', $(this).data('order_id'))
  $.ajax({
    url: '/orders/checkout',
    type:"POST",
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: formData,
    contentType: false,
    processData: false,
  })
  .done(function(){
    $id = $('#product_id').text()
    $('#block-show').load('/orders/'+ $id) 
    $('#ajaxmsg').html('<div class="alert alert-success">Permintaan berhasil dikirimkan..!</div>');            
  })
});



      /*
      *
      * Delete ORDER on order show page
      *
      */      
      $(document).on('click', '.btn-delete-order', function(){
         var order_id = $(this).data('order_id')
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
               ajaxDeleteOrder(order_id)
            }
         })
      })

      function ajaxDeleteOrder(order_id){
         var formData = new FormData()
         formData.set('order_id', order_id)
         $.ajax({
            url: '/orders/destroy',
            type:"POST",
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false
         }) 
         .fail(function(response){
               var msg = response.responseJSON.errors;
               console.log('error');
         })
         .done(function(response){
            $('#block-content').load('/order/block/index')
            $('#ajaxmsg').html('<div class="alert alert-success">Permintaan berhasil dihapus..!</div>');            
         });
      }