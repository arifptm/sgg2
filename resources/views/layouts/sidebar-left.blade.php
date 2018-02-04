<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="/imagecache/small-sq/{{ Auth::user()->image ?: 'default.jpg' }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ Auth::user()->name }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

  <ul class="sidebar-menu">

    @if (Auth::user()->hasRole('user'))
      <li class="header">MAIN MENU</li> 

      <li @if(\Request::is('products', '/')) class='active' @endif>
        <a href="/products">
          <i class="fa fa-cubes"></i> 
            Daftar Barang
        </a>
      </li>
      
      <li @if(\Request::is('proposals/*','proposals')) class='active' @endif>
        <a href="/proposals">
          <i class="fa fa-bullhorn"></i> <span>Riwayat Usulan</span>
        </a>
      </li>

      <li @if(\Request::is('orders/*','orders')) class='active' @endif>
        <a href="/orders">
          <i class="fa fa-cart-arrow-down"></i> <span>Riwayat Permintaan</span>
        </a>
      </li>
    @endif




    @if (Auth::user()->hasRole('admin'))
      <li class="header">ADMIN</li>
        <li @if(\Request::is('/')) class='active' @endif>
          <a href="/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li> 

        <li @if(\Request::is('admin/products/*', 'admin/products')) class='active' @endif>
          <a href="/admin/products">
            <i class="fa fa-cubes"></i> <span>Daftar Barang &amp; Usulan</span>
          </a>
        </li> 
       
        <li @if(\Request::is('admin/orders/*', 'admin/orders')) class='active' @endif>
          <a href="/admin/orders">
            <i class="fa fa-cart-arrow-down"></i> <span>Daftar Permintaan</span>
          </a>
        </li>      

        <li @if(\Request::is('admin/users/*', 'admin/users')) class='active' @endif>
          <a href="/admin/users">
            <i class="fa fa-users"></i> <span>Daftar Pengguna</span>
          </a>
        </li> 

        <li @if(\Request::is('admin/departments/*', 'admin/departments')) class='active' @endif>
          <a href="/admin/departments">
            <i class="fa fa-bank"></i> <span>Departemen</span>
          </a>
        </li> 

    @endif
      

    @if (Auth::user()->hasRole('kalab'))
      <li class="header">PERMINTAAN</li>
      <li @if(\Request::is('kalab/orders/pending')) class='active' @endif>
        <a href="/kalab/orders/index/pending">
          <i class="fa fa-hourglass-1"></i> <span>Menunggu persetujuan</span>
        </a>
      </li>
      <li @if(\Request::is('kalab/orders/approved')) class='active' @endif>
        <a href="/kalab/orders/index/accepted">
          <i class="fa fa-check"></i> <span>Disetujui</span>
        </a>
      </li>  

      <li @if(\Request::is('kalab/orders/rejected')) class='active' @endif>
        <a href="/kalab/orders/index/rejected">
          <i class="fa fa-close"></i> <span>Ditolak</span>
        </a>
      </li> 
      <li class="header"></li>
      <li @if(\Request::is('kalab/export')) class='active' @endif>
        <a href="/kalab/export">
          <i class="fa fa-book"></i> <span>Export</span>
        </a>
      </li> 

    @endif  
 

  </ul>
</section>  