@extends('layouts.layout')

@section('content-top')   
    <h1>Edit department</h1>
@endsection

@section('header-scripts')
@endsection

@section('footer-scripts')  
@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-6">
         <div class="box box-success">                   
            <div class="box-body">
               <form action='/admin/departments/{{ $department->id }}' method='post'>
                  {{ method_field('put') }}
                  {{ csrf_field() }}
                  <div class="form-group">
                     <label for="name" class="control-label" >Nama Bagian</label>
                     <input type="text" name="name" id="name" class="form-control" value="{{ $department->name }}">
                     @if ($errors->has('name'))<div class="label label-danger"> {{ $errors->first('name') }} </div> @endif
                  </div>        
                  
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection