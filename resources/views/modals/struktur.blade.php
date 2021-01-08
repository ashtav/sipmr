<div class="modal fade" id="struktur" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Struktur Organisasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        @if ($content->img_struktur != null)
        <img style="width: 100%; margin-bottom: 15px" src="{{$content->img_struktur == null ? asset('public/assets/images/placeholder.png') : asset('public/images/'.$content->img_struktur)}}" alt="">
        @endif


        {!!$content->struktur!!}
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>