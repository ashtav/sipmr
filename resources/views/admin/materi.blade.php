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
        Materi
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Materi</li>
      </ol>
    </section>
    @if ($me->role == 'admin')
    <div style="padding: 15px 15px 0 15px" class="text-right">
      <button class="btn btn-primary" onclick="_new()"> <i class="fa fa-upload fa-fw"></i> Upload Materi</button>
    </div> @endif

    
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
                  <th>File</th>
                  <th>Keterangan</th>
                  <th>Tanggal</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>

                  @foreach ($materi as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->filename}}</td>
                      <td>{{$item->info}}</td>
                      <td>{{$item->created_at}}</td>
                      <td>
                        <div class="btn-group">
                          <a href="{{asset('public/files/'.$item->filename)}}" target="_blank" class="btn btn-sm btn-secondary"> <i class="fa fa-download"></i> </a>
                          @if ($me->role == 'admin')
                          <button class="btn btn-sm btn-secondary" onclick="_edit({{$item}})"> <i class="fa fa-pencil"></i> </button>
                          <button class="btn btn-sm btn-danger" onclick="_delete({{$item->id}})"> <i class="fa fa-trash"></i> </button>
                          @endif
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

@include('admin.modals.form-materi')
@include('partials.script')

  <script>
    $('#li4').addClass('active')

    let isNew = true, uid;

    // tampilkan modals tambahk anggota
    let mod = $('#form-materi');
    let _new = () => {
      mod.find('.modal-title').html('Upload Materi')
      mod.modal('show'); mod.find('.alert').html('Klik icon diatas untuk memilih file')
      isNew = true;
    }

    function getFileInfo(input){
      let file = input.files[0];
      mod.find('.alert').html(file.name+', '+formatBytes(file.size))
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
        url: isNew ? url('materi') : url('materi/'+uid),
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
          toast(isNew? 'Materi berhasil ditambahkan' : 'Materi berhasil diperbarui');
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
      mod.find('.modal-title').html('Edit Materi')
      isNew = false; uid = data.id;
      mod.find('.alert').html(data.filename)
      mod.find('textarea').val(data.info)

      mod.modal('show')
    }

    function _delete(id){
      let ask = confirm('Apakah Anda yakin ingin menghapus file ini?')
      if(ask){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'delete',
          url: url('materi/'+id),
          success: function(){
            toast('Materi berhasil dihapus');
            goTo('reload')
          }, error: function(err){
            toast('Terjadi kesalahan')
          }
        })
      }
    }

    $(function () {
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
