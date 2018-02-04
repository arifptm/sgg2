/*
*
* Proposal Datatables
*
*/
DTable = $('#proposal-table').DataTable({
   processing: false,
   serverSide: true,
   responsive: true,
   autoWidth: false,
   order: [0,'desc'],
   ajax: '/proposal/data',
   columns: [
      { data: 'id', name: 'id', 'visible': false },
      { data: 'image', name: 'image', orderable: false, searchable: false },
      { data: 'title', name: 'name' },
      { data: 'price', name: 'price', orderable: false, searchable: false, className: 'text-right' },
      { data: 'body', name: 'body',orderable: false, searchable: false },            
      { data: 'status', name: 'status',orderable: false, searchable: false },            
      { data: 'disposable', name: 'disposable', orderable: false, searchable: false }, 
      { data: 'action', name: 'action',orderable: false, searchable: false }
      ],
   language: {        
      'url': '/assets/dt.indonesian.json'
   }
});


/*
*
* Create Proposal
*
*/

$(document).on('click', '#btn-create-proposal', function(){
  $('.modal-proposal').attr('id', 'modal-create-proposal')
  $('.modal-title').text('Usulan Baru')  
  $('#share-fileinput').addClass('fileinput-new').removeClass('fileinput-exists')
  $('.modal-footer').html(`<button id="btn-submit-create-proposal" class="btn btn-primary pull-left">Tambah usulan</button>
    <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>`)
  $('#modal-create-proposal').modal('show')
});


$(document).on('click', '#btn-submit-create-proposal', function(){
  var form = $('#form-proposal')[0]
  var formData = new FormData(form)

  $.ajax({
    url: '/proposal/ajax/store',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: formData,
    type:"POST",
    contentType: false,
    processData: false,

    error: function(response){
      var msg = response.responseJSON.errors;
      var field = ['name', 'unit', 'price', 'url']

      for( i=0; i< field.length; i++){
        m = eval('msg.'+field[i])
        n = '#err-'+field[i]
        m ? $(n).show().text(m).parent().addClass('has-error') : $(n).hide().parent().removeClass('has-error');
      }  
    },

    success: function(response){
      DTable.ajax.reload(); 
      $('.err').text('').parent().removeClass('has-error');      
      $('input, textarea').val('')
      $('.fileinput').fileinput('clear')
      $('#modal-create-proposal').modal('hide');
      $('#ajaxmsg').html('<div class="alert alert-success">Usulan <em>'+response.proposal.name+'</em> berhasil ditambahkan.</div>')        
    }
  }); 		
});



    /*
      *
      * Edit Proposal
      *
      */      
      $(document).on('click', '.btn-edit-proposal', function(){
       $('.modal-proposal').attr('id', 'modal-edit-proposal')
       $('.modal-title').text('Edit usulan')

       $('#product_id').val($(this).data('product_id'))
       $('#name').val($(this).data('name'))
       
       if ($(this).data('image') != '' ) {
        $('#share-fileinput').removeClass('fileinput-new').addClass('fileinput-exists')
        $('.fileinput-preview').html('<img src="/imagecache/medium/'+$(this).data('image')+'" alt="">')
       } else {
         $('#share-fileinput').removeClass('fileinput-exists').addClass('fileinput-new') 
       }       

       $('#unit').val($(this).data('unit'))
       $('#price').val($(this).data('price'))
       $('#url').val($(this).data('url'))
       $('#body').val($(this).data('body'))

       $('.modal-footer').html(`
        <button id="btn-submit-edit-proposal" class='btn btn-primary pull-left'>Simpan</button>
        <button class='btn btn-default pull-left' data-dismiss='modal'>Batal</button>
        `)
       $('#modal-edit-proposal').modal('show')        
     });

      $(document).on('click', '#btn-submit-edit-proposal',  function(){
       var form = $('#form-proposal')[0]
       var formData = new FormData(form)

       $.ajax({
         url: 'proposal/ajax/update',
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
       },

       success: function(response){
          DTable.ajax.reload(); 
          $('input,textarea').val('')         
          $('#modal-edit-proposal').modal('hide');           
          $('#ajaxmsg').html('<div class="alert alert-success">Permintaan <em>'+response.proposal.name+'</em> berhasil diperbarui.</div>');     
          checkCart()        
       }
     });         
     });

      $(document).on('hidden.bs.modal','#modal-edit-proposal' ,function(){
       $('input,textarea').val('')
       $('.fileinput').fileinput('clear')
     });


/*
*
* Delete proposal
*
*/
$(document).on('click', '.btn-delete-proposal', function(){
    // $('#id-delete').val($(this).data('id'))
    // $('#modal-delete-proposal').modal('show')

         var id = $(this).data('id')

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
               ajaxDeleteProposal(id)
            }
         })    
});

    function ajaxDeleteProposal(id){

         var formData = new FormData()
         formData.append('id', id)

         $.ajax({
            url: '/proposal/ajax/destroy',
            type:"POST",
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false,

            error: function(response){
               var msg = response.responseJSON.errors;
               $('#ajaxmsg').html('<div class="alert alert-warning">Produk tidak bisa dihapus. Silakan kontak admin..!</div>');
            },

            success: function(response){
              checkCart()
               DTable.ajax.reload();             
               $('#ajaxmsg').html('<div class="alert alert-success">Data berhasil dihapus.</div>');           
            }

         });
       
};

