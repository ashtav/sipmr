<div class="modal fade" id="form-kegiatan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <i class="fa fa-close pull-right" data-dismiss="modal"></i>
        <h5 class="modal-title"></h5>
      </div>
      <form onsubmit="return _submit(this)">

      <div class="modal-body">

        <div class="form-group">
          <label for="" class="form-label">Nama Kegiatan</label>
          <input type="text" id="i1" name="nama_kegiatan" class="form-control" placeholder="Nama kegiatan" autocomplete="off">
        </div>

        <div class="form-group">
          <label for="" class="form-label">Tanggal Pelaksana</label>
          <input type="date" id="i2" name="tgl_pelaksana" class="form-control">
        </div>

        <div class="form-group">
          <label for="" class="form-label">Waktu Pelaksana</label>
          <input type="time" id="i3" name="waktu_pelaksana" class="form-control">
        </div>

        <div class="form-group">
          <label for="" class="form-label">Panitia</label>
          <input type="text" id="i4" name="panitia" class="form-control" placeholder="Nama panitia" autocomplete="off">
        </div>

        <div class="form-group">
          <label for="" class="form-label">Deskripsi Kegiatan</label>
          <textarea id="i5" name="deskripsi_kegiatan" class="form-control" placeholder="Deskripsi kegiatan" style="height: 100px"></textarea>
        </div>

        <div class="row">
          <div class="col-md-6">
            <img src="{{asset('public/assets/images/placeholder.png')}}" alt="" id="img" style="width: 100%; height: 180px; object-fit: cover">
            <input type="file" name="filename" class="hide" id="filename" onchange="previewImg(this, 'img')">
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary"  onclick="$('#filename').click()" type="button"> <i class="fa fa-image fa-fw"></i> Tambahkan Foto</button>
          </div>
          
        </div>
        
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" >Simpan</button>
      </div>
    </form>

    </div>
  </div>
</div>