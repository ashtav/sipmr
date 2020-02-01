@include('partials.header')

<body class="hold-transition skin-blue sidebar-mini">
<style>
  
  .col:hover .g-options{
    top: 10px;
    opacity: 1;
  }

  .g-options{
    position: absolute;
    transition: .2s;
    top: -30px;
    right: 30px;
    opacity: 0;
  }

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

<div class="wrapper">

  @include('partials.navbar')
  @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Galeri
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Galeri</li>
      </ol>
    </section>

    <div style="padding: 15px 15px 0 15px" class="text-right">
      <button class="btn btn-primary" onclick="_new()"> <i class="fa fa-plus fa-fw"></i> Tambah Foto</button>
    </div>

    
    <!-- Main content -->
    <section class="content">
      <div class="row">
         
              @foreach ($gallery as $item)
              <div class="col-md-3 col" style="position: relative; overflow: hidden; margin-bottom: 10px">
                <div class="btn-group g-options">
                  <button class="btn btn-sm btn-secondary" onclick="_edit({{$item}})"> <i class="fa fa-pencil"></i></button>
                  <button class="btn btn-sm btn-danger" onclick="_delete({{$item->id}})"><i class="fa fa-trash"></i></button>
                </div>
                <img src="{{asset('public/images/'.$item->filename)}}" alt="" onclick="_view({{$item}})" style="object-fit: cover; height: 250px; width: 100%; padding: 3px; background: #fff">
              </div>
              @endforeach
                
            <!-- /.box-body -->
          <!-- /.box -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    <div id="imgPreview" onclick="$('#imgPreview').fadeOut(300)" style="display: none">
      <img src="{{asset('public/images/1580488358.jpg')}}" alt="">
      <div id="info">lorem ipsum dolor set amet consecttur lorem isum</div>
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('partials.footer')

</div>
<!-- ./wrapper -->

@include('admin.modals.form-gallery')
@include('partials.script')

  <script>
    $('#li3').addClass('active')

    let isNew = true, uid;

    // tampilkan modals tambahk anggota
    let mod = $('#form-gallery');
    let _new = () => {
      mod.find('.modal-title').html('Tambah Foto')
      mod.modal('show'); mod.find('.alert').html('Klik gambar diatas untuk memilih gambar')
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
        url: isNew ? url('gallery') : url('gallery/'+uid),
        data: formData,
        contentType: false,
        processData: false,
          success: function(res){ console.log(res)
            toast(isNew? 'Foto berhasil ditambahkan' : 'Foto berhasil diperbarui');
            goTo('reload')
          }, error: function(err){
              toast('Terjadi kesalahan')
          }
      })

      btn.html(def).prop('disabled', false);

      return false;

    }

    function _edit(data){
      mod.find('.modal-title').html('Edit Foto')
      isNew = false; uid = data.id; mod.find('.alert').html('Untuk edit, hanya bisa perbarui info')

      $('#info').val(data.info)
      $('#img').attr('src', url('public/images/'+data.filename))

      mod.modal('show')
    }

    function _delete(id){
      let ask = confirm('Apakah Anda yakin ingin menghapus foto ini?')
      if(ask){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'delete',
          url: url('gallery/'+id),
          success: function(){
            toast('Foto berhasil dihapus');
            goTo('reload')
          }, error: function(err){
            toast('Terjadi kesalahan')
          }
        })
      }
    }

    function _view(data){
      $('#imgPreview').fadeIn(300);
      $('#imgPreview img').attr('src', url('public/images/'+data.filename))
      $('#imgPreview #info').html(data.info)
    }
  </script>
</body>
</html>
