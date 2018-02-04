/*
*
* Datatables
*
*/
$('#products-table').DataTable({
   processing: false,
   serverSide: true,
   responsive: true,
   autoWidth: false,
   order: [0,'desc'],
   ajax: '/product/data',
   columns: [
      { data: 'id', name: 'id', 'visible': false },
      { data: 'image', name: 'image', orderable: false, searchable: false },
      { data: 'title', name: 'name' },
      { data: 'body', name: 'body',orderable: false, searchable: false },            
      { data: 'disposable', name: 'disposable', orderable: false, searchable: false, className: 'text-center' }, 
      { data: 'action', name: 'action',orderable: false, searchable: false }
      ],
   language: {        
      'url': '/assets/dt.indonesian.json'
   }
});


/*
*
* Show Product Detail
*
*/
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
