<!-- Left side column. contains the logo and sidebar -->

<style>
  .notif{
    padding: 0 10px;
    background: red;
    border-radius: 20px;
    text-align: center
  }
</style>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{$me->user_detail->foto == null ? asset('public/assets/images/profile.png') : asset('public/profile/'.$me->user_detail->foto)}}" alt="" class="img-circle" style="height: 45px; object-fit: cover">
        </div>
        <div class="pull-left info">
          <p>{{$me->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li id="li1"><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li id="li2"><a href="{{url('member')}}"><i class="fa fa-users"></i> <span>Data Anggota</span></a></li>
        <li id="li3"><a href="{{url('gallery')}}"><i class="fa fa-image"></i> <span>Galeri</span></a></li>
        <li id="li4"><a href="{{url('materi')}}"><i class="fa fa-book"></i> <span>Materi</span></a></li>
        <li id="li5"><a href="{{url('pengumuman')}}"><i class="fa fa-bell"></i> <span>Pengumuman</span> <span style="display: {{$notifPengumuman == 0 ? 'none': ''}}" class="notif pull-right">{{$notifPengumuman}}</span> </a></li>
        <li id="li6"><a href="{{url('activity')}}"><i class="fa fa-calendar"></i> <span>Kegiatan</span> <span style="display: {{$notifKegiatan == 0 ? 'none': ''}}" class="notif pull-right">{{$notifKegiatan}}</span></a></li>

        @if ($me->role == 'admin')
        <li class="treeview" id="li7">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Konten</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('content/sejarah')}}"><i class="fa fa-circle-o"></i>Sejarah</a></li>
            <li><a href="{{url('content/visi')}}"><i class="fa fa-circle-o"></i> Visi & Misi</a></li>
            <li><a href="{{url('content/struktur')}}"><i class="fa fa-circle-o"></i> Struktur Organisasi</a></li>
          </ul>
        </li> @endif
       
        {{-- <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li> --}}
        <li class="header">LAINNYA</li>
        <li id="li8"><a href="{{url('profile')}}"><i class="fa fa-lock"></i> <span>Pengaturan Akun</span></a></li>
        <li onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><a href="#"><i class="fa fa-sign-out text-red"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
