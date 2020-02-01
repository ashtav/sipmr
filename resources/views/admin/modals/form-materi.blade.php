<div class="modal fade" id="form-materi" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <i class="fa fa-close pull-right" data-dismiss="modal"></i>
        <h5 class="modal-title"></h5>
      </div>
      <form onsubmit="return _submit(this)">

      <div class="modal-body">

        <div class="row">
          <div class="col-md-6">
            <img src="{{asset('public/assets/images/file-upload.jpg')}}" alt="" id="img" style="width: 100%; height: 180px; object-fit: cover" onclick="if(isNew) $('#filename').click()">
            <input type="file" name="filename" class="hide" id="filename" onchange="getFileInfo(this)" accept=".pdf">
          </div>
          
          <div class="col-md-6">
            <textarea name="info" id="info" class="form-control" placeholder="Keterangan" style="height: 180px"></textarea>
          </div>
        </div>

        <div class="alert alert-info" style="padding: 5px 15px; margin-top: 15px; margin-bottom: 0"></div>
        
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
    </form>

    </div>
  </div>
</div>