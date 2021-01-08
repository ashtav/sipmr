{{-- PENJELASAN LENKGAP UNTUK SEMUA FILE --}}

{{-- memanggil file hedaer pada folder partials, file ini berisi head, meta, style, dsb
    nah kenapa harus dibagi2 dan ditaruh pada folder partials?
    untuk file yg digunakan oleh banyak file lain haruslah dibagi untuk efektivitas kode.

    setiap kode @include() artinya memanggil suatu file
--}}
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

  {{-- memanggil file navbar & sidebar --}}
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

    @if ($me->role == 'admin')
    <div style="padding: 15px 15px 0 15px" class="text-right">
      <button class="btn btn-primary" onclick="_new()"> <i class="fa fa-plus fa-fw"></i> Tambah Foto</button>
    </div> @endif

    
    <!-- Main content -->
    <section class="content">
      <div class="row">
         
              @foreach ($gallery as $item)
              <div class="col-md-3 col" style="position: relative; overflow: hidden; margin-bottom: 10px">
                @if ($me->role == 'admin')
                <div class="btn-group g-options">
                  <button class="btn btn-sm btn-secondary" onclick="_edit({{$item}})"> <i class="fa fa-pencil"></i></button>
                  <button class="btn btn-sm btn-danger" onclick="_delete({{$item->id}})"><i class="fa fa-trash"></i></button>
                </div> @endif
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

{{-- script, kode yang menghubungkan tampilan dengan controller melalui routes --}}

  <script>
    // memberikan class active pada sidebar
    $('#li3').addClass('active')

    // deklarasi variabel
    let isNew = true, uid;

    // deklarasi modals
    let mod = $('#form-gallery');

    // fungsi untuk menampilkan form tambah data
    let _new = () => {
      mod.find('.modal-title').html('Tambah Foto') // set judul modals
      mod.modal('show'); // tampilkan modal
      mod.find('.alert').html('Klik gambar diatas untuk memilih gambar') // set teks dalam modal
      isNew = true; // menandakan bahwa form yang ditampilkan adalah untuk menambah data
    }

    // fungsi untuk mengirim data form ke database
    function _submit(f){ // f = parameter = this(form)

      // tampilkan animasi spiner pada tombol,
      // sebenarnya gak tampil sih karena proses datanya terlalu cepat (localhost), dan faktor lain

      // deklarasi style button, get value, set default, dan disabled
      let btn = $(f).find('button:submit'), def = btn.html();
      btn.html(spiner).prop('disabled', true);

      // deklarasi formData untuk menyimpan data inputan form
      let formData = new FormData($(f)[0]);

      // jika isNew == false, maka inputkan pada formData method PUT (method untuk update)
      if(!isNew){
        formData.append('_method', 'PUT');
      }

      // menggunakan fungsi ajax sebagai penghubung tampilan -> data -> controller
      $.ajax({
        // token, syarat dalam laravel untuk manupulasi data
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post', // method post
        url: isNew ? url('gallery') : url('gallery/'+uid), // jika isNew == true 'add data', jika tidak 'update data'
        data: formData, // ambil data pada formData untuk dikirim
        contentType: false, // tipe konten false (syarat penggunaan new FormData())
        processData: false, // begitu juga ini (syarat penggunaan new FormData())
        success: function(res){ // jika sukses (terkoneksi)
          // tampilkan pesan
          toast(isNew? 'Foto berhasil ditambahkan' : 'Foto berhasil diperbarui');
          goTo('reload') // refresh halaman

          // o--
        }, error: function(err){ // jika gagal, tampilkan pesan error
            toast('Terjadi kesalahan');
            // o--
        }
      })

      // nah, kode ini bisa ditaruh di o-- untuk nampilin animasi saat submit
      btn.html(def).prop('disabled', false);

      return false; // cegah form untuk bertindak default, supaya kita bisa memerintahkan apa saja, sikap default form adalah akan merefresh saat disubmit serta tidak menjalankan perintah diatas
    }

    // fungsi untuk edit data
    function _edit(data){ // data = parameter, berisi data yang akan di edit
      mod.find('.modal-title').html('Edit Foto') // set title
      isNew = false; // apakah baru? false
      uid = data.id; // set id data yang akan diubah
      mod.find('.alert').html('Untuk edit, hanya bisa perbarui info') // tampilkan teks
      $('#img').attr('src', url('public/images/'+data.filename)) // tampilkan gambar
      mod.find('#info').val(data.info) // tampilkan data

      mod.modal('show') // tampilkan form (modals)
    }

    // hapus data
    function _delete(id){ // id = parameter, id data yg akan dihapus
      let ask = confirm('Apakah Anda yakin ingin menghapus foto ini?') // konfirmasi
      if(ask){ // jika true

        // jalan kan perintah ajax
        $.ajax({
          headers: { // seperti biasa, headers wajib pada laravel
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'delete', // method delete
          url: url('gallery/'+id), // url (route)
          success: function(){ // jika sukses, dst...
            toast('Foto berhasil dihapus');
            goTo('reload')
          }, error: function(err){
            toast('Terjadi kesalahan')
          }
        })
      }
    }

    function _view(data){ // fungsi menampilkan gambar
      $('#imgPreview').fadeIn(300); // memberi animasi fadeIn dengan durasi 300 miliseconds
      $('#imgPreview img').attr('src', url('public/images/'+data.filename)) // menampilkan gambar
      $('#imgPreview #info').html(data.info) // menampilkan info
    }
  </script>
</body>
</html>
