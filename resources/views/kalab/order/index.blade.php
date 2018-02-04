@extends('layouts.layout')

@section('content-top')   
    <h1>Daftar Permintaan 
      <small>
        @if ($state == 'all')
          Semua
        @elseif ($state == 'pending')          
          Menunggu Persetujuan
        @elseif ($state == 'accepted')          
          Diterima
        @elseif ($state == 'rejected')          
          Ditolak
        @endif
      </small>
    <input type="hidden" value="{{ $state }}" id="order_status"></h1>
@endsection

@section('header-scripts')
  <link rel="stylesheet" href="/vendor/jasny-bootstrap/dist/css/jasny-bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/iCheck/flat/orange.css">
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-12">
         <div class="box box-success">                   
            <div class="box-body">
              <section id="list-order">
                <div class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </section>
            </div>
         </div>
      </div>            
   </div> 
   
@endsection


@section('footer-scripts')
   <!-- <script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>    -->
   <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script>   
   <script src="/vendor/iCheck/icheck.min.js"></script>
   
   <script>
      //load content page
      var state = $('#order_status').val()
      $('#list-order').load('/kalab/orders/list/'+ state)
         
      //pagination on ajax page
      $(document).on('click', '.pagination a', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $('#'+$(this).closest('section').attr('id')).load(url)
      });

   </script>



@endsection