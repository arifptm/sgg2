@extends('layouts.layout')

@section('content-top')   
    <h1 class="text-center">Export data permintaan</h1>
@endsection

@section('header-scripts')

  <link rel="stylesheet" href="/vendor/iCheck/flat/orange.css">
  <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">

  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('content-main')
   <div class="row">
      <div class="col-md-6 col-md-offset-3"> 
         <div class="box box-primary">                   
            <div class="box-body">
               <form action="/kalab/export/excel" method="POST">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <label>Periode:</label>
                     <div class="input-daterange input-group" id="datepicker" >
                        <input type="text" class="input form-control" name="datestart" required/>
                        <span class="input-group-addon">sampai</span>
                        <input type="text" class="form-control" name="dateend"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Status:</label>
                     <select name="status" id="status" class="form-control">
                        <option value="">Semua</option>
                        <option value="accepted">Diterima</option>
                        <option value="rejected">Ditolak</option>
                     </select>
                  </div> 
                  <div class="form-group">
                     <label>Jenis Aset:</label>
                     <select name="disposable" id="disposable" class="form-control">
                        <option value="">Semua</option>
                        <option value="hp">Habis Pakai</option>
                        <option value="unhp">Tidak Habis Pakai</option>
                     </select>
                  </div>               
                  <div class="form-group">
                     <label>Pelaksana:</label>
                     <select name="user" id="user" class="form-control">
                        @foreach($users as $user)
                           <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group text-center">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-book"></i> Export</button>
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div> 
@endsection


@section('footer-scripts')

   <script src="/vendor/sweetalert2/dist/sweetalert2.min.js"></script>   
   <script src="/vendor/iCheck/icheck.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
   
   <script>
      $.fn.datepicker.dates['id'] = {
          days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
          daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
          daysMin: ["Mg", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
          months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
          monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"],
          today: "Hari ini",
          format: "dd-mm-yyyy",
      };      
      $('.input-daterange').datepicker({
         autoclose: true,
         language: 'id'
      });


   </script>



@endsection
                
                 
