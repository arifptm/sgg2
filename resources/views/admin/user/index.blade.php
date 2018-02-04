@extends('layouts.layout')

@section('content-top')   
    <h1>Daftar Pengguna 
      <button id="btn-create-user" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Pengguna</button></h1>
@endsection

@section('header-scripts')
  <!-- <link rel="stylesheet" href="/vendor/jasny-bootstrap/dist/css/jasny-bootstrap.min.css"> -->
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('footer-scripts')
   <!-- <script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>    -->
   <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script>   
   <script src="/js/admin.user.js"></script>

@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-12">
         <div class="box box-success">                   
            <div class="box-body">
              <section id="list-user">
                <div class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </section>
            </div>
         </div>
      </div>            
   </div>   
   @include('admin.user._modal')
@endsection