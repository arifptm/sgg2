      checkCart()
      
      function checkCart(){
        $.get('/active_order', function(data){
          if(data != ''){
            $('.active_order_msg').html('<div class="alert alert-danger"><b>Perhatian!</b> Anda mempunyai permintaan yang belum dikirim kepada admin, <a class="text-warning" href="/orders/show/'+data+'"> lihat di sini</a></div>')
          } else {
            $('.active_order_msg').html('')
          }   
        }); 
      }