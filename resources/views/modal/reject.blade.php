<div class="row">
  <div class="col-md-12">
    <form name="fReject" id="fReject" method="post" action="{{ $urlPos }}">
      @csrf
    <div class="form-group">
      <label>Keterangan:</label>
      <div>
        <textarea class="form-control" id="keterangan_batal" name="keterangan_batal"></textarea>
      </div>
    </div>
    <div>
      <button type="button" class="btn btn-success saveModal"><i class="fa fa-save"></i> Save</button>
      <button type="button" class="btn btn-danger closeModal"><i class="fa fa-remove"></i> Cancel</button>
    </div>
    </form>
  </div>
</div>
