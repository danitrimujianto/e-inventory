<div class="row">
  <div class="col-md-12">
    <form name="fReject" id="fReject" method="post" action="{{ $urlPos }}">
      @csrf
    <div class="form-group">
      <label>Finish Date:</label>
      <div>
        <input type="text" class="form-control datepicker" name="finish_date" id="finish_date" placeholder="" autocomplete="off" value="">
      </div>
    </div>
    <div class="form-group">
      <label>Service:</label>
      <div>
        <input type="text" class="form-control" name="service" id="service" placeholder="" autocomplete="off" value="">
      </div>
    </div>
    <div class="form-group">
      <label>After:</label>
      <div>
        <select class="form-control" name="after_id">
          <option value="">-- Choose After --</option>
          @foreach($dCondition AS $condition)
            <option value="{{ $condition->id }}">{{ $condition->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div>
      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
      <button type="button" class="btn btn-danger closeModal"><i class="fa fa-remove"></i> Cancel</button>
    </div>
    </form>
  </div>
</div>
<script>
$(document).ready(function(){
  $("body").on("click", ".datepicker", function(){
    $(this).datepicker({
    	format: 'dd/mm/yyyy',
    	autoclose: true
    });
  });
});
</script>
