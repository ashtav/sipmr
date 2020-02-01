<div class="modal fade" id="form-pengumuman" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <i class="fa fa-close pull-right" data-dismiss="modal"></i>
        <h5 class="modal-title"></h5>
      </div>
      <form onsubmit="return _submit(this)">

      <div class="modal-body">

        <div class="form-group">
          <label for="" class="form-label">Judul</label>
          <input type="text" placeholder="Judul" class="form-control" autocomplete="off" name="judul">
        </div>
        
        <textarea id="editor" name="pengumuman" placeholder="Ketik pengumuman..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Kirim</button>
      </div>
    </form>

    </div>
  </div>
</div>