@include('partials.header')

<style>
 .wysihtml5-editor p { margin: 0 !important; }
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('partials.navbar')
  @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profil
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Profil</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-6 text-center">
          <div class="box" style="padding: 15px;">
            <img src="{{$user->user_detail->foto == null ? asset('public/assets/images/profile.png') : asset('public/profile/'.$user->user_detail->foto)}}" alt="" style="height: 150px; width: 150px; margin: 25px 0; object-fit: cover; border-radius:50%">
            <h2 style="margin: 0"> <b> {{$user->name}} </b> </h2>
            {{$user->role}} <br>
            <button class="btn btn-primary" onclick="_changeFoto()" style="margin-top: 15px; margin-bottom: 25px"> <i class="fa fa-image fa-fw"></i> Ganti Foto </button>
          </div>
        </div>

        <div class="col-xs-6 text-left">
          <div class="box" style="padding: 15px;">
            <ul class="list-group">
              <li class="list-group-item"> <b>Nama Lengkap</b> <br/> {{$user->name}} </li>
              <li class="list-group-item"> <b>Tempat, Tgl Lahir</b> <br/>  {{$user->user_detail->tmp_lahir.', '.$user->user_detail->tgl_lahir}} </li>
              <li class="list-group-item"> <b>Jenis Kelamin</b> <br/>  {{$user->user_detail->jk}} </li>
              <li class="list-group-item"> <b>Agama</b> <br/>  {{$user->user_detail->agama}} </li>
              <li class="list-group-item"> <b>No. Telepon</b> <br/>  {{$user->user_detail->telp}} </li>
              <li class="list-group-item"> <b>Alamat</b> <br/>  {{$user->user_detail->alamat}} </li>
              <li class="list-group-item"> <b>Email</b> <br/>  {{$user->email}} </li>
            </ul>

            <button class="btn btn-primary" onclick="_editBio({{$user}})" style="margin-top: 5px;"> <i class="fa fa-user-circle fa-fw"></i> Edit Biodata </button>

          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('partials.footer')

</div>
<!-- ./wrapper -->

@include('admin.modals.form-foto')
@include('admin.modals.form-member')
@include('partials.script')

  <script>
    $('#li8').addClass('active')

    let isChangeFoto = false, uid;

    // tampilkan modals tambahk anggota
    let mod = $('#form-foto');

    function _changeFoto(){
      isChangeFoto = true;
      mod.modal('show')
    }

    function _submit(f){
      // tampilkan animasi spiner pada tombol
      let btn = $(f).find('button:submit'), def = btn.html();
      btn.html(spiner).prop('disabled', true);

      let formData = new FormData($(f)[0]);
      formData.append('_method', 'PUT');
      formData.append('change_pass', 'true');

      // menghubungkan ke controller, mengirim data
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: isChangeFoto ? url('profile/change-foto') :url('member/'+uid),
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
          toast('Profil berhasil diperbarui');
          goTo('reload')
        }, error: function(err){
          toast('Terjadi kesalahan')
        }
      })

      btn.html(def).prop('disabled', false);

      return false;

    }

    function _editBio(data){
      $('#form-member').find('.modal-title').html('Edit Anggota')
      isNew = false; uid = data.id;

      $('#i1').val(data.name)
      $('#i2').val(data.user_detail.tmp_lahir)
      $('#i3').val(data.user_detail.tgl_lahir)
      $('#i4').find('input[value='+data.user_detail.jk+']').prop('checked', true)
      $('#i5').val(data.user_detail.agama)
      $('#i6').val(data.user_detail.telp)
      $('#i7').val(data.user_detail.alamat)
      $('#i8').val(data.email)
      $('#i9').val('')

      $('#form-member').modal('show')
    }

  </script>
</body>
</html>
