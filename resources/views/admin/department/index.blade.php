@extends('layouts.layout')

@section('content-top')   
    <h1>Daftar Department 
      <button class="btn btn-primary" id="btn-create-department" data-target="#modal-create-department" data-toggle="modal"><i class="fa fa-plus-circle"></i> Tambah Departemen</button></h1>
@endsection

@section('header-scripts')
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('footer-scripts')
 	<script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script>   
   <script src="/js/admin.department.js"></script> 
@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-12">
         <div class="box box-success">                   
            <div class="box-body">
              <section id="list-department">
                <div class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
              </section>
              
            </div>
         </div>
      </div>            
   </div> 	
   @include('admin.department._modal')
@endsection