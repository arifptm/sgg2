@extends('layouts.layout')

@section('content-top')
  <div class="ajaxmsg"></div>
  <h1>Permintaan #<span id="order_id">{{ $id }}</span></h1>
@endsection

@section('content-main')
  <div class="row"> 
    <div class="col-md-12">    
      <div class="box box-primary" id="block-show">
      </div>
    </div>
  </div>
  
  
@endsection


@section('header-scripts')
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
@endsection

@section('footer-scripts')  
  <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script> 
  <script src="/js/app/admin.order.js"></script>
@endsection
