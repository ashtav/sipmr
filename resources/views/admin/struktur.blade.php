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
        Konten Struktur Organisasi
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Konten</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
          
          <div class="box" style="padding: 15px; padding-bottom: 35px">
            <button class="btn btn-primary pull-right" onclick="_edit({{$content}})"> <i class="fa fa-pencil"></i> </button>
            {!!$content->struktur!!}
          </div>
          <!-- /.box -->
        </div>

        <div class="col-xs-6">
          
          <form onsubmit="return changeImg(this)">
            <div class="box" style="padding: 15px; ">
              <button class="btn btn-primary pull-right" onclick="_editImg({{$content}})"> <i class="fa fa-image fa-fw"></i> Tambahkan Gambar</button>
              <img onclick="$('#file').click()" style="width: 100%; margin-top: 15px" id="img" src="{{$content->img_struktur == null ? asset('public/assets/images/placeholder.png') : asset('public/images/'.$content->img_struktur)}}" alt="">
              
              <input type="file" id="file" name="filename" class="hide" onchange="previewImg(this, 'img')">

              <button type="submit" class="btn btn-primary" style="margin-top: 10px">Simpan</button>
            </div>
          </form>
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

@include('admin.modals.form-content')
@include('partials.script')

  <script>
    $('#li7').addClass('active')
    $('#li7 li:eq(2)').addClass('active')

    function changeImg(f){

      if($('#file').val() == ''){
        toast('Pilih gambar');
      }else{

        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'post',
          url: url('content/struktur_img'),
          data: new FormData($(f)[0]),
          contentType: false,
          processData: false,
          success: function(res){ alert(res)
            toast('Gambar struktur organisai berhasil diperbarui');
            goTo('reload')
          }, error: function(err){
            toast('Terjadi kesalahan')
          }
        })
      }

      return false;
    }


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

    let uid;

    // tampilkan modals tambahk anggota
    let mod = $('#form-content');

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
        url: url('content/struktur/'+uid),
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
          toast('Struktur organisai berhasil diperbarui');
          goTo('reload')
        }, error: function(err){
          toast('Terjadi kesalahan')
        }
      })

      btn.html(def).prop('disabled', false);

      return false;

    }

    function _edit(data){
      mod.find('.modal-title').html('Edit Struktur Organisai')
      isNew = false; uid = data.id;
      $('iframe').contents().find('.wysihtml5-editor').html(data.struktur);
      mod.modal('show')
    }

  </script>
</body>
</html>
