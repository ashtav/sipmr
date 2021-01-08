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
        Kegiatan
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Kegiatan</li>
      </ol>
    </section>
    @if ($me->role == 'admin')
    <div style="padding: 15px 15px 0 15px" class="text-right">
      <button class="btn btn-primary" onclick="_new()"> <i class="fa fa-calendar fa-fw"></i> Buat Kegiatan</button>
    </div> @endif

    <div id="imgPreview" onclick="$('#imgPreview').fadeOut(300)" style="display: none">
      <img src="{{asset('public/images/1580488358.jpg')}}" alt="">
      <div id="info">lorem ipsum dolor set amet consecttur lorem isum</div>
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
                  <th>Tanggal</th>
                  <th>Nama Kegiatan</th>
                  <th>Penanggung Jawab</th>
                  <th>Deskripsi Kegiatan</th>
                  @if ($me->role == 'admin')
                  <th></th> @endif
                </tr>
                </thead>
                <tbody>

                  @foreach ($activity as $item)

                  @php
                      $p = str_replace('&nbsp;',' ',strip_tags($item->pengumuman));
                  @endphp
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>
                        <img src="{{ $item->foto == '' ? asset('public/assets/images/placeholder.png') : asset('public/images/'.$item->foto)}}" onclick="_view({{$item}})" style="object-fit: cover; height: 50px; width: 50px; padding: 3px; background: #fff">
                      </td>
                      <td>{{$item->tgl_pelaksana.', '.$item->waktu_pelaksana}}</td>
                      <td>{{$item->nama_kegiatan}}</td>
                      <td>{{$item->panitia}}</td>
                      <td>{{$item->deskripsi_kegiatan}}</td>
                      {{-- <td>{{strlen($p) >= 100 ? substr($p, 0, 100).'...' : $p}}</td> --}}
                      @if ($me->role == 'admin')
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-sm btn-secondary" onclick="_edit({{$item}})"> <i class="fa fa-pencil"></i> </button>
                          <button class="btn btn-sm btn-danger" onclick="_delete({{$item->id}})"> <i class="fa fa-trash"></i> </button>
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

@include('admin.modals.form-kegiatan')
@include('partials.script')

  <script>
    $('#li6').addClass('active')

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
      $('#imgPreview').fadeIn(300);
      $('#imgPreview img').attr('src', data.foto == '' ? url('public/assets/images/placeholder.png') : url('public/images/'+data.foto))
      $('#imgPreview #info').html(data.deskripsi_kegiatan)
    }
   

    let isNew = true, uid;

    // tampilkan modals tambahk anggota
    let mod = $('#form-kegiatan');
    let _new = () => {
      mod.find('.modal-title').html('Buat Kegiatan')
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
        url: isNew ? url('activity') : url('activity/'+uid),
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
          toast(isNew? 'Kegiatan berhasil ditambahkan' : 'Kegiatan berhasil diperbarui');
          goTo('reload')
        }, error: function(err){
          toast('Terjadi kesalahan')
        }
      })

      btn.html(def).prop('disabled', false);

      return false;

    }

    function _edit(data){
      mod.find('.modal-title').html('Edit Kegiatan')
      isNew = false; uid = data.id;
      $('#i1').val(data.nama_kegiatan)
      $('#i2').val(data.tgl_pelaksana)
      $('#i3').val(data.waktu_pelaksana)
      $('#i4').val(data.panitia)
      $('#i5').val(data.deskripsi_kegiatan)
      mod.find('#img').attr('src', data.foto == '' ? url('public/assets/images/placeholder.png') : url('public/images/'+data.foto))

      mod.modal('show')
    }

    function _delete(id){
      let ask = confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')
      if(ask){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'delete',
          url: url('activity/'+id),
          success: function(){
            toast('Kegiatan berhasil dihapus');
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
