@extends('layouts.layout')

@section('content-top')   
    <h1>Daftar Permintaan</h1>
@endsection

@section('header-scripts')
  <link rel="stylesheet" href="/vendor/jasny-bootstrap/dist/css/jasny-bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/iCheck/flat/orange.css">
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('footer-scripts')
   <!-- <script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>    -->
   <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script>   
   <script src="/vendor/iCheck/icheck.min.js"></script>
   <script src="/js/app/admin.order.js"></script>
@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-12">
         <div class="box box-success">                   
            <div class="box-body">
               <div class="well well-sm bg-green form-inline" id="product_status" >
                  <div class="form-group" style="margin-right: 20px;">
                     <input type="checkbox" name="pending" value="pending" id="pending" checked>
                     <label for="pending" class="no-margin">Permintaan Baru</label>
                  </div>
                  <div class="form-group" style="margin-right: 20px;">
                     <input type="checkbox" name="approved" value="approved" id="approved" checked>
                     <label for="approved" class="no-margin">Diterima</label>
                  </div>
                  <div class="form-group">
                     <input type="checkbox" name="rejected" value="rejected" id="rejected" checked>
                     <label for="rejected" class="no-margin">Ditolak</label>
                  </div>
               </div>
              <section id="list-order">
                <div class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </section>
            </div>
         </div>
      </div>            
   </div>   
   @include('admin.order._modal')
@endsection