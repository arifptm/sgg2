      $(document).on('hidden.bs.modal','.modal-lineitem' ,function(){
         $('#notes').val('')
         $('#quantity').val('')
      });

      $('#form-lineitem').on('click', 'input, textarea', function(){
        $('.err').hide()
      })


      /*
      *
      * Create Line Item
      *
      */
      $(document).on('click','.btn-create-lineitem', function(){
         $('.modal-lineitem').attr('id', 'modal-create-lineitem')
         $('.modal-title').text('Permintaan baru')
         $('#product_id').val($(this).data('product_id'))
         $('#datatitle').html($(this).data('title'))
         $('#dataimage').html('<img src="/imagecache/medium/'+$(this).data('image')+'">')
         $('#dataunit').html("(<em>satuan</em> = <b>"+$(this).data('unit')+"</b>)")
         $('.modal-footer').html(`
            <button id="btn-submit-create-lineitem" class='btn btn-primary pull-left'>Tambah permintaan</button>
            <button class='btn btn-default pull-left' data-dismiss='modal'>Batal</button>
            `)

         $('#modal-create-lineitem').modal('show')
      });
    

      $(document).on('click', '#btn-submit-create-lineitem',  function(){
         var form = $('#form-lineitem')[0]
         var formData = new FormData(form)

         $.ajax({
            url: '/lineitem/ajax/create',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            type:"POST",
            contentType: false,
            processData: false,

            error: function(response){
            var msg = response.responseJSON.errors
            $('#err-quantity').show().text(msg.quantity)
           },

           success: function(response){
            $('#lineitem').load('/block/lineitem'); 
            $('#modal-create-lineitem').modal('hide');
            $('#ajaxmsg').html('<div class="alert alert-success">'+response.msg+'</div>')
            checkCart()           
           }

         });         
      });




/*
      *
      * Edit Lineitem
      *
      */      
      $(document).on('click', '.btn-edit-lineitem', function(){
         $('.modal-lineitem').attr('id', 'modal-edit-lineitem')
         $('.modal-title').text('Edit permintaan')
         $('#lineitem_id').val($(this).data('lineitem_id'))
         $('#quantity').val($(this).data('lineitem_quantity'))
         $('#datatitle').html($(this).data('product_title'))
         $('#dataimage').html('<img alt="" src="/imagecache/medium/'+$(this).data('product_image')+'">')
         $('#dataunit').html($(this).data('product_unit'))
         $('#notes').val($(this).data('product_notes'))
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
             $('#err-quantity').show().text(msg.quantity)
           },

           success: function(response){
             $('#lineitem').load('/block/lineitem'); 
             $('#quantity-error' ).hide().parent().removeClass('has-error');      
             $('#quantity').val('');
             $('#modal-edit-lineitem').modal('hide');           
             $('#ajaxmsg').html('<div class="alert alert-success">'+response.msg+'</div>')
             checkCart()        
           }
         });         
      });





      /*
      *
      * Delete Lineitem
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
               $('#lineitem').load('/block/lineitem');                
               $('#ajaxmsg').html('<div class="alert alert-success"><b><em>'+response.msg+'</em></b> telah dihapus dari daftar permintaan.</div>');            
               checkCart()
            }
         });
      }
