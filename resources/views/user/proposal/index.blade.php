@extends('layouts.layout')

@section('content-top')  
<div class="active_order_msg"></div> 
    <h1>Riwayat Usulan <button class="btn btn-primary" id="btn-create-proposal"><i class="fa fa-plus-circle"></i> Tambah Usulan</button></h1>
@endsection

@section('header-scripts')
  <link rel="stylesheet" href="/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/datatables.net-bs/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/jasny-bootstrap/dist/css/jasny-bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('footer-scripts')

   <script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
   <script src="/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
   <script src="/vendor/datatables.net/js/dataTables.responsive.min.js"></script>
   <script src="/vendor/datatables.net/js/responsive.bootstrap.min.js"></script>   
   <script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>   
   <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

   <script src="/js/app/user.proposal.js"></script>
   <script src="/js/app/user.product.js"></script>


@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-12">
         <div class="box box-success">                   
            <div class="box-body">
               <table class="table table-bordered" id="proposal-table">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th style="width:50px;">Gambar</th>
                        <th>Nama Barang</th> 
                        <th class="text-right">~Harga</th>
                        <th>Keterangan</th>                                               
                        <th>Status</th>
								        <th>Jenis Aset</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>            
   </div>   
   @include('user.proposal.modal-proposal')
   @include('user.product.modal-show')
@endsection