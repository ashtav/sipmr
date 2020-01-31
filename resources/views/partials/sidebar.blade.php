<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="{{asset('public/assets/images/profile.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li id="li1"><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li id="li2"><a href="{{url('member')}}"><i class="fa fa-users"></i> <span>Data Anggota</span></a></li>
        <li id="li3"><a href="{{url('gallery')}}"><i class="fa fa-image"></i> <span>Galeri</span></a></li>
        <li id="li4"><a href="#"><i class="fa fa-book"></i> <span>Materi</span></a></li>
        <li id="li5"><a href="#"><i class="fa fa-bell"></i> <span>Pengumuman</span></a></li>
        <li id="li6"><a href="#"><i class="fa fa-calendar"></i> <span>Kegiatan</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Konten</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i>Sejarah</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Visi & Misi</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Struktur Organisasi</a></li>
          </ul>
        </li>
       
        {{-- <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li> --}}
        <li class="header">LAINNYA</li>
        <li><a href="#"><i class="fa fa-lock"></i> <span>Pengaturan Akun</span></a></li>
        <li><a href="#"><i class="fa fa-sign-out text-red"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
