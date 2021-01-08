<div class="modal fade" id="form-member" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <i class="fa fa-close pull-right" data-dismiss="modal"></i>
        <h5 class="modal-title"></h5>
      </div>
      <form onsubmit="return _submit(this)">

      <div class="modal-body">
        
          <div class="form-group">
            <label for="" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="i1" placeholder="Nama lengkap" required autocomplete="off" name="name">
          </div>

          <div class="form-group">
            <label for="" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="i2" placeholder="Tempat lahir" required autocomplete="off" name="tmp_lahir">
          </div>

          <div class="form-group">
            <label for="" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="i3" name="tgl_lahir" required>
          </div>

          <div class="form-group" id="i4">
            <label for="" class="form-label">Jenis Kelamin</label>

            <div class="radio" style="margin: 0">
              <label style="margin-right: 15px" for="lk">
                <input type="radio" name="jk" id="lk" value="laki-laki" checked>
                Laki-laki
              </label>

              <label for="pr">
                <input type="radio" name="jk" id="pr" value="perempuan">
                Perempuan
              </label>
            </div>
          </div>

          <div class="form-group" id="igd">
            <label for="" class="form-label">Golongan Darah</label>

            <div class="radio" style="margin: 0">
              @php
                  $gol = ['A','AB','B','O'];
              @endphp
              @for ($i = 0; $i < count($gol); $i++)
                <label style="margin-right: 15px" for="g{{$i}}">
                <input type="radio" name="gol_darah" id="g{{$i}}" value="{{$gol[$i]}}">
                  {{$gol[$i]}}
                </label>
              @endfor
              
            </div>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Agama</label>
            <select name="agama" class="form-control" id="i5">
              <option value="">Pilih Agama</option>
              <option value="buddha">Buddha</option>
              <option value="hindu">Hindu</option>
              <option value="islam">Islam</option>
              <option value="katolik">Katolik</option>
              <option value="konghucu">Konghucu</option>
              <option value="kristen">Kristen</option>
            </select>
          </div>

          <div class="form-group">
            <label for="" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="i6" number-only name="telp" maxlength="13" placeholder="No. Telepon" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="i7" name="alamat" placeholder="Alamat" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" id="i8" name="email" required placeholder="Alamat email" autocomplete="off">
          </div>

          <div class="form-group" id="pass">
            <label for="" class="form-label">Password</label>
            <input type="password" class="form-control" id="i9" name="password" required placeholder="Password" autocomplete="off">
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