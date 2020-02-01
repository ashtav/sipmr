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
        Pengumuman
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Pengumuman</li>
      </ol>
    </section>

    <div style="padding: 15px 15px 0 15px" class="text-right">
      <button class="btn btn-primary" onclick="_new()"> <i class="fa fa-edit fa-fw"></i> Buat Pengumuman</button>
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
                  <th>Tanggal</th>
                  <th>Judul</th>
                  <th>Pengumuman</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>

                  @foreach ($pengumuman as $item)

                  @php
                      $p = str_replace('&nbsp;',' ',strip_tags($item->pengumuman));
                  @endphp
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->created_at}}</td>
                      <td>{{$item->judul}}</td>
                      <td>{{strlen($p) >= 100 ? substr($p, 0, 100).'...' : $p}}</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-sm btn-secondary" onclick="_view({{$item}})"> <i class="fa fa-eye"></i> </button>
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

@include('admin.modals.form-pengumuman')
@include('admin.modals.view-pengumuman')
@include('partials.script')

  <script>
    $('#li5').addClass('active')

    $().ready(function() {
      $('#editor').wysihtml5({useLineBreaks: true,
        toolbar: {
          "font-styles": true, // Font styling, e.g. h1, h2, etc.
          "emphasis": true, // Italics, bold, etc.
          "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
          "html": false, // Button which allows you to edit the generated HTML.
          "link": true, // Button to insert a link.
          "image": false, // Button to insert an image.
          "color": false, // Button to change color of font
          "blockquote": false, // Blockquote
        }
      });
    });

    function _view(data){
      let vp = $('#view-pengumuman'); vp.modal('show')
      vp.find('.modal-title').html(data.judul);
      vp.find('.modal-body').html(data.pengumuman);
    }
   

    let isNew = true, uid;

    // tampilkan modals tambahk anggota
    let mod = $('#form-pengumuman');
    let _new = () => {
      mod.find('.modal-title').html('Buat Pengumuman')
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
        url: isNew ? url('pengumuman') : url('pengumuman/'+uid),
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
          toast(isNew? 'Pengumuman berhasil ditambahkan' : 'Pengumuman berhasil diperbarui');
          goTo('reload')
        }, error: function(err){
          toast('Terjadi kesalahan')
        }
      })

      btn.html(def).prop('disabled', false);

      return false;

    }

    function _edit(data){
      mod.find('.modal-title').html('Edit Materi')
      isNew = false; uid = data.id;
      mod.find('input').val(data.judul)
      $('iframe').contents().find('.wysihtml5-editor').html(data.pengumuman);

      mod.modal('show')
    }

    function _delete(id){
      let ask = confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')
      if(ask){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'delete',
          url: url('pengumuman/'+id),
          success: function(){
            toast('Pengumuman berhasil dihapus');
            goTo('reload')
          }, error: function(err){
            toast('Terjadi kesalahan')
          }
        })
      }
    }

  </script>
</body>
</html>
