@extends('layouts.layout')

@section('content-top')
  <div class="ajaxmsg"></div>
  <h1>Permintaan #<span id="product_id">{{ $id }}</span></h1>
@endsection

@section('content-main')
  <div class="row"> 
    <div class="col-md-12">    
      <div class="box box-primary" id="block-show">
      </div>
    </div>
  </div>
  @include('user.order.modal-show-product')
  @include('user.product.modal-lineitem')
@endsection


@section('header-scripts')
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
@endsection

@section('footer-scripts')  
  <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script> 
  <script src="/js/app/user.order.js"></script>
@endsection
