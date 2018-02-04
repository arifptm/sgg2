@extends('layouts.layout')

@section('content-top')   
    <div class="active_order_msg"></div>
    <h1>Daftar Barang</h1>
@endsection

@section('header-scripts')
  <link rel="stylesheet" href="/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/datatables.net-bs/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">

  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('footer-scripts')
   <script>
      $('#lineitem').load('/block/lineitem');  
   </script>

   <script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
   <script src="/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
   <script src="/vendor/datatables.net/js/dataTables.responsive.min.js"></script>
   <script src="/vendor/datatables.net/js/responsive.bootstrap.min.js"></script>      
   <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script> 
  
   <script src="/js/app/user.product.js"></script>
   <script src="/js/app/user.lineitem.js"></script>

@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-8">
         <div class="box box-success">                   
            <div class="box-body"> 
               <table class="table table-bordered" id="products-table">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama Barang</th> 
                        <th>Keterangan</th>                                               
								        <th class="text-center">Jenis Aset</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>      
      
      <section id="lineitem">     
         <div class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
         </div>
      </section>       
   </div>   
   
   @include('user.product.modal-lineitem')
   @include('user.product.modal-show')
@endsection