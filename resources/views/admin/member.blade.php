@include('partials.header')

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

    <div style="padding: 15px 15px 0 15px" class="text-right">
      <button class="btn btn-primary" onclick="_new()"> <i class="fa fa-plus fa-fw"></i> Tambah Anggota</button>
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
                  <th>Nama</th>
                  <th>Tmp & Tgl Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Agama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>

                  @foreach ($users as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->user_detail->tmp_lahir.', '.$item->user_detail->tgl_lahir}}</td>
                      <td>{{$item->user_detail->jk}}</td>
                      <td>{{$item->user_detail->agama}}</td>
                      <td>{{$item->user_detail->alamat}}</td>
                      <td>{{$item->user_detail->telp}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->role}}</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-sm btn-secondary" onclick="_edit({{$item}})"> <i class="fa fa-pencil"></i> </button>
                          <button class="btn btn-sm btn-danger" onclick="_delete({{$item->id}})"> <i class="fa fa-trash"></i> </button>
                        </div>
                      </td>
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

      $('#i1').val(data.name)
      $('#i2').val(data.user_detail.tmp_lahir)
      $('#i3').val(data.user_detail.tgl_lahir)
      $('#i4').find('input[value='+data.user_detail.jk+']').prop('checked', true)
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
  </script>
</body>
</html>
