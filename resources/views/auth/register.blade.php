@extends('auth.template')

@section('page-title')
  Logistik TEDi
@endsection

@section('content')
<div class="register-box">
  <div class="register-logo">
   <a href="/">Logistik <b>TEDi</b></a>
  </div>

  <div class="register-box-body">
    <p class="lead login-box-msg">Pendaftaran Akun</p>

    <form  method="POST" action="{{ route('register') }}">
      <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
        <input id="name" type="text" class="form-control" placeholder="Nama lengkap" name="name" value="{{ old('name') }}" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
        <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif       
      </div>
      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" name="email" value="{{ old('email') }}" type="text" class="form-control" placeholder="Alamat email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif        
      </div>
		
      <div class="form-group has-feedback {{ $errors->has('department') ? ' has-error' : '' }}">
        <select  id="department" name="department" value="{{ old('department') }}" class="form-control">
				<option value="">--Bagian (silakan pilih)--</option>
				<option value="akademik">Akademik</option>
				<option value="keuangan">Keuangan</option>
				<option value="laboratorium">Laboratorium</option>
				<option value="tata_usaha">Tata Usaha</option>
				<option value="kepegawaian">Kepegawaian</option>
				<option value="sarana_prasarana">Sarana Prasarana</option>
		  </select>
        
        @if ($errors->has('department'))
        <span class="help-block">
          <strong>{{ $errors->first('department') }}</strong>
        </span>
        @endif        
      </div>
		
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" name="password"  type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif        
      </div>
      <div class="form-group has-feedback">
        <input id="password-confirm" name="password_confirmation"  type="password" class="form-control" placeholder="Ulangi password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="tos" required> Saya setuju dengan <a href="#">Syarat &amp; Ketentuan</a>
            </label>
          </div>
      </div>
      <div class="form-group">                
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>        
      </div>
    </form>
    
  </div>
</div>
@endsection

