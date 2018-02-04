@extends('layouts.layout')

@section('content-top')   
    <h1>Tambah user baru</h1>
@endsection

@section('header-scripts')
  <link rel="stylesheet" href="/vendor/jasny-bootstrap/dist/css/jasny-bootstrap.min.css">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection

@section('footer-scripts')   
   <script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>   
       <script>
      $('#role3').on('ifChecked', function(){      
         $('#unit_wrapper').show()      
      }).on('ifUnchecked', function(){      
         $('#unit_wrapper').hide()      
      });
   </script>

@endsection

@section('content-main')
   <div class="row">       
      <div class="col-md-8">
         <div class="box box-success">                   
            <div class="box-body">
               <form action='/admin/user/store' method='post'>
                  <div class="form-group">
                     <label for='name' class='control-label'>Nama User</label>
                     <input name='name' type='text' class='form-control' id='name'>                      
                        {{ $errors->has('name') ? "<div class='help-block'><strong>".$errors->first('password')."</strong>" : "" }}
                  </div>

                  <div class="form-group">
                     <label for='email' class='control-label'>Email</label>
                     <input name='email' type='text' class='form-control' id='email'>                      
                        {{ $errors->has('name') ? "<div class='help-block'><strong>".$errors->first('password')."</strong>" : "" }}
                  </div>

                  <div class="form-group">
                     <label for='password' class='control-label'>Password</label>
                     <input name='password' type='password' class='form-control' id='password'>                      
                        {{ $errors->has('password') ? "<div class='help-block'><strong>".$errors->first('password')."</strong>" : "" }}
                  </div>

                  <div class="form-group">
                     <label for='password_confirm' class='control-label'>Ulangi Password</label>
                     <input name='password_confirm' type='password' class='form-control' id='password_confirm'>                      
                        {{ $errors->has('password_confirm') ? "<div class='help-block'><strong>".$errors->first('password')."</strong>" : "" }}
                  </div>

                  <div class="form-group">
                     <label>Jabatan</label>
                     <div>
                        @foreach ($roles as $role)
                           <div>
                              <input type="checkbox" name="role[]" value="{{ $role->name }}" class="form-check-input" id="role{{ $loop->iteration}}" 
                              @if (isset($user)) {{ $user->roles->pluck('name')->contains($role->name) ? 'checked' : '' }} @endif>
                              <label for="role{{ $loop->iteration}}">{{ $role->title }}</label>
                           </div>
                        @endforeach
                     </div>

                     @if ($errors->has('role'))
                        <div class="label label-danger">
                             {{ $errors->first('role') }}
                        </div>
                     @endif
                  </div>

                  <div class="form-group" id="department_id" @if (isset($user)) {{ ! $user->roles->pluck('name')->contains('laboran') ? 'style=display:none' : '' }} @else style="display:none" @endif>
                     <label class="control-label" for="department_id">
                     <select name="department_id" class="form-control" >
                        <option value="">--Silakan pilih--</option>
                        @foreach($departments as $department)
                           <option value="{{ $department->id }}" @if (isset($user) AND $user->department != null) {{ ($user->department->id == $department->id) ? 'selected' : '' }} @endif >{{ $department->name }}</option>
                        @endforeach                        
                     </select>
                     
                     @if ($errors->has('department_id'))
                         <div class="label label-danger">
                             {{ $errors->first('department_id') }}
                         </div>
                     @endif
                  </div>

         
                  <div class="form-group" {{ ( ! isset($user)) ? 'style=display:none' : '' }}>  
                      <div class="icheck">
                          <!-- {!! Form::checkbox('verified', 1, null) !!}  -->
                          <input type="checkbox" name="verified" value="1" class="form-check-input" @if(isset($user)) {{ ($user->verified == 1) ? 'checked' : '' }}   @else checked @endif >
                          {!! Form::label('verified', 'Aktif',['class'=>'control-label']) !!}             
                      </div>
                  </div>

         

      </div>
   </div>
</div>

<div class="box-footer">
   <div class="form-group">
      {!! Form::submit('Simpan',  ['class' => 'btn btn-primary']) !!}
   </div>
</div>   











                  <div class="form-group">
                     <button class="btn btn-primary">Simpan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>      
            
   </div>   

@endsection



<!--   <script src="/vendor/icheck/icheck.min.js"></script>
  <script>
    $('input[type="checkbox"], input[type="radio"]').iCheck({
      checkboxClass: 'icheckbox_flat-purple',
      radioClass   : 'iradio_flat-purple'
    })
  </script> -->
