@extends('layouts.layout')


@section('content-top')
  <div class="active_order_msg"></div>
  <h1>Riwayat Permintaan <a class="btn btn-primary" href="/products"><i class="fa fa-plus-circle"></i> Tambah Permintaan</a></h1>
@endsection

@section('content-main')
  <div class="row"> 
    <div class="col-md-12">    
      <div class="box box-primary">
      <div class="box-body">
        <div id="block-content">     
          <div class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
          </div>
        </div>        
      </div>
    </div>
  </div>
  @include('user.product.modal-show')
@endsection


@section('header-scripts')
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('footer-scripts')
   <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script> 
   <script src='/js/app/user.order.js'></script>
@endsection