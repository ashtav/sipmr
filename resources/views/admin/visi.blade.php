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
        Konten Visi & Misi
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
        <div class="col-xs-12">
          
          <div class="box" style="padding: 15px; padding-bottom: 35px">
            <button class="btn btn-primary pull-right" onclick="_edit({{$content}})"> <i class="fa fa-pencil"></i> </button>
            {!!$content->visi!!}
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

@include('admin.modals.form-content')
@include('partials.script')

  <script>
    // memberi class active pada sidebar
    $('#li7').addClass('active')
    $('#li7 li:eq(1)').addClass('active')

    // config textarea untuk editor
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

    // tampilkan modals tambah anggota
    let mod = $('#form-content');

    function _submit(f){
      // tampilkan animasi spiner pada tombol
      let btn = $(f).find('button:submit'), def = btn.html();
      btn.html(spiner).prop('disabled', true);

      // deklarasi vairbale formData untuk menyimpan data form
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
        url: url('content/visi/'+uid),
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
          toast('Visi berhasil diperbarui');
          goTo('reload')
        }, error: function(err){
          toast('Terjadi kesalahan')
        }
      })

      btn.html(def).prop('disabled', false);

      return false;

    }

    function _edit(data){
      mod.find('.modal-title').html('Edit Visi & Misi')
      isNew = false; uid = data.id;
      $('iframe').contents().find('.wysihtml5-editor').html(data.visi);

      mod.modal('show')
    }

  </script>
</body>
</html>
