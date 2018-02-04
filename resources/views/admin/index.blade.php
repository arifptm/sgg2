@extends('layouts.layout')

@section('header-scripts')
@endsection

@section('footer-scripts')
@endsection

@section('content-top')
      <h1>Dashboard</h1>
@endsection

@section('content-main')
<div class="box box-primary">
    <div class="box-body">
      <div class="row">
        
        <div class="col-lg-4">
        
          <div class="small-box bg-teal">
            <div class="inner">
              <h3>{{ $products['pending'] }} <small>Usulan baru</small></h3>

              <p><strong><span class="badge">{{ $products['verified'] }}</span></strong> dari <span class="badge">{{ $products['all'] }}</span> barang sudah di-verifikasi </p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="/admin/products" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-4 ">
        
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $orders['pending'] }} <small>Permintaan baru</small> </h3>

              <p><span class="badge">{{ $orders['verified'] }}</span> dari <span class="badge">{{ $orders['all'] }}</span> permintaan telah diproses</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-cart"></i>
            </div>
            <a href="/admin/orders" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="row">
  <div class="col-sm-4">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Usulan</h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover">
          @foreach($products['new'] as $product)
            <tr>
              <td>
                <b><a href="/admin/products/{{ $product->slug }}">{{ $product->name }}</a></b>
                <span class="pull-right">
                  @if ($product->status == 'pending' ) 
                    <span class="badge bg-orange">Pending</span> 
                  @elseif ($product->status == 'approved')
                    <span class="badge bg-green">Approved</span> 
                  @elseif ($product->status == 'rejected')
                    <span class="badge bg-red">Rejected</span> 
                  @endif                
                </span>                
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

    <div class="col-sm-4">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Permintaan</h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover">
          @foreach($orders['new'] as $order)
            <tr>
              <td>
              <b><a href="/admin/orders/show/{{ $order->id }}">{{ $order->user->name }}</a></b> 
              <span class="pull-right">
                @if ($order->status == 'pending')
                    <div class="badge bg-gray">Pending</div>
                @elseif ($order->status == 'accepted')
                    <div class="badge bg-green">Accepted</div>
                @elseif ($order->status == 'rejected')
                    <div class="badge bg-red">Declined</div>                  
                @endif
              </span>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

</div>

@endsection