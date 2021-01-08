<div class="modal fade" id="form-foto" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <i class="fa fa-close pull-right" data-dismiss="modal"></i>
        <h5 class="modal-title">Ganti Foto Profil</h5>
      </div>
      <form onsubmit="return _submit(this)">

      <div class="modal-body text-center">

        <img src="{{asset('public/assets/images/placeholder.png')}}" alt="" id="img" style="width: 250px; height: 250px; object-fit: cover" onclick="$('#filename').click()">
        <input type="file" name="filename" class="hide" id="filename" onchange="previewImg(this, 'img')">

        <div class="alert alert-info" style="padding: 5px 15px; margin-top: 15px; margin-bottom: 0">Klik gambar diatas untuk memilih foto</div>
        
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" >Simpan</button>
      </div>
    </form>

    </div>
  </div>
</div>