@include('partials.header')

<style>
  
  #imgPreview{
    background: rgba(0,0,0,0.5);
    position: fixed;
    left: 0; top: 0;
    height: 100%; width: 100%;
    z-index: 9999;
  }

  #imgPreview img{
    position: absolute;
    left: 50%; top: 50%;
    transform: translate(-50%, -50%);
    max-width: 500px; max-height: 500px;
    object-fit: cover
  }

  #imgPreview #info{
    color: #fff;
    position: absolute;
    left: 50%; bottom: 20px;
    transform: translate(-50%, 0%);

  }
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
        Anggota
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Anggota</li>
      </ol>
    </section>

    @if ($me->role == 'admin')
    <div style="padding: 15px 15px 0 15px" class="text-right">
      <button class="btn btn-primary" onclick="_new()"> <i class="fa fa-plus fa-fw"></i> Tambah Anggota</button>
    </div>
    @endif
    
    <div id="imgPreview" onclick="$('#imgPreview').fadeOut(300)" style="display: none">
      <img src="{{asset('public/images/1580488358.jpg')}}" alt="">
    </div>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="30">No</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Tmp & Tgl Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Golongan Darah</th>
                  <th>Agama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Status</th>
                  @if ($me->role == 'admin') <th width="80"></th> @endif
                </tr>
                </thead>
                <tbody>

                  @foreach ($users as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>
                        <img src="{{ $item->user_detail->foto == '' ? asset('public/assets/images/profile.png') : asset('public/profile/'.$item->user_detail->foto)}}" onclick="_view({{$item}})" style="object-fit: cover; height: 40px; width: 40px; border-radius: 50%; padding: 3px; background: #fff">
                      </td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->user_detail->tmp_lahir.', '.$item->user_detail->tgl_lahir}}</td>
                      <td>{{$item->user_detail->jk}}</td>
                      <td>{{$item->user_detail->gol_darah}}</td>
                      <td>{{$item->user_detail->agama}}</td>
                      <td>{{$item->user_detail->alamat}}</td>
                      <td>{{$item->user_detail->telp}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->role == 'member' ? 'anggota' : 'admin'}}</td>
                      <td>{{$item->status}}</td>
                      @if ($me->role == 'admin')
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-sm btn-secondary" onclick="_edit({{$item}})"> <i class="fa fa-pencil"></i> </button>
                          <button class="btn btn-sm {{ $item->status == 'aktif' ? 'btn-danger' : 'btn-success' }} " onclick="changeStatus({{$item->id}}, '{{$item->status}}')"> @if ($item->status == 'aktif')
                            <i class="fa fa-close"></i> 
                          @else
                          <i class="fa fa-check"></i> 
                          @endif 
                        </button>
                        </div>
                      </td> @endif
                    </tr>
                  @endforeach
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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

@include('admin.modals.form-member')
@include('partials.script')

  <script>
    $('#li2').addClass('active')

    let isNew = true, uid;

    // tampilkan modals tambahk anggota
    let mod = $('#form-member');
    let _new = () => {
      mod.find('.modal-title').html('Tambah Anggota')
      mod.modal('show')
      isNew = true;

      $('#pass').find('input').attr('required','required');
      $('#pass').show();
    }

    function changeStatus(id, status){
      let ask;
      if(status == 'aktif'){
        ask = confirm('Non aktifkan anggota ini?');
      }else{
        ask = confirm('Aktifkan anggota ini?');
      }


      if(ask){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'post',
          url: url('member/activation/'+id),
          success: function(res){ console.log(res)
            toast(status == 'aktif' ? 'Anggota berhasil dinonaktifkan' : 'Anggota berhasil diaktifkan');
            goTo('reload')
          }, error: function(err){
              toast('Terjadi kesalahan')
          }
        })
      }
    }

    function _submit(f){
      // tampilkan animasi spiner pada tombol
      let btn = $(f).find('button:submit'), def = btn.html();
      btn.html(spiner).prop('disabled', true);

      let formData = new FormData($(f)[0]);

      if(!isNew){
        formData.append('_method', 'PUT');
      }

      // menghubungkan ke controller, mengirim data
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: isNew ? url('member') : url('member/'+uid),
        data: formData,
        contentType: false,
        processData: false,
          success: function(res){ console.log(res)
            toast(isNew? 'Anggota berhasil ditambahkan' : 'Anggota berhasil diperbarui');
            goTo('reload')
          }, error: function(err){
            if(err.status){
              toast('Email ini sudah terpakai')
            }
          }
      })

      btn.html(def).prop('disabled', false);

      return false;

    }

    function _edit(data){
      mod.find('.modal-title').html('Edit Anggota')
      isNew = false; uid = data.id;

      $('#pass').find('input').removeAttr('required');
      $('#pass').hide();

      $('#i1').val(data.name)
      $('#i2').val(data.user_detail.tmp_lahir)
      $('#i3').val(data.user_detail.tgl_lahir)
      $('#i4').find('input[value='+data.user_detail.jk+']').prop('checked', true)

      $('#igd input').each(function(){
        $(this).prop('checked', false);
        if($(this).attr('value') == data.user_detail.gol_darah){
          $(this).prop('checked', true);
        }
      })

      $('#i5').val(data.user_detail.agama)
      $('#i6').val(data.user_detail.telp)
      $('#i7').val(data.user_detail.alamat)
      $('#i8').val(data.email)
      $('#i9').val('')

      mod.modal('show')
    }

    function _delete(id){
      let ask = confirm('Apakah Anda yakin ingin menghapus data anggota ini?')
      if(ask){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'delete',
          url: url('member/'+id),
          success: function(){
            toast('Anggota berhasil dihapus');
            goTo('reload')
          }, error: function(err){
            toast('Terjadi kesalahan')
          }
        })
      }
    }

    $(function () {
      $('#example2').DataTable()
      $('#example1').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
      })
    })

    function _view(data){
      $('#imgPreview').fadeIn(300);
      $('#imgPreview img').attr('src', data.user_detail.foto == null ? url('public/assets/images/profile.png') : url('public/profile/'+data.user_detail.foto))
    }
  </script>
</body>
</html>
