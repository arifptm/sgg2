@extends('layouts.layout')

@section('content-top')   
    <h1>Daftar Product</h1>
@endsection

@section('header-scripts')
  <!-- <link rel="stylesheet" href="/vendor/jasny-bootstrap/dist/css/jasny-bootstrap.min.css"> -->
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('footer-scripts')
   <!-- <script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>    -->
   <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script>   
   <script src="/js/admin.product.js"></script>

@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-8">
         <div class="box box-success">                   
            <div class="box-body">
              <section id="list-product">
                <div class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </section>
            </div>
         </div>
      </div>            
   </div>   
   @include('admin.product._modal')
@endsection