<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="row" id="searchForm" >
    <div class="col-md-12" >
      <h4>Filter</h4>
    </div>
    <div class="form-group">
      <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Status</label>-->
      <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Nomor</label>-->
      <div class="col-md-5 col-xs-12">
        <select name="sf" class="form-control" id="sf">
          <option value="item">Item</option>
          <option value="code">Code</option>
        </select>
      </div>
      <div class="col-md-5 col-xs-12">
      <input type="text" name="sq" id="sq" class="form-control" placeholder="" value="" autocomplete="off">
      </div>
      <div class="col-sm-2 col-xs-12" style="  ">
      <button class="btn btn-primary"><i class="fa fa-search"></i></button>
      <button type="button" id="resetFilter" class="btn btn-warning"><i class="fa fa-eraser"></i></button>
      </div>
    </div>
    </div>
    <br/>
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th style=" width:5%; ">&nbsp;</th>
          <th>ID Tools</th>
          <th>Item</th>
          <th>Merk</th>
          <th>Type</th>
          <th>SN</th>
          <th>Imei</th>
        </tr>
        <tbody id="listData">
        @foreach($data AS $d)
        <tr data-id='{{ $d->id }}'>
          <td style=' text-align:center; '><button class='btn btn-success btn-xs pilihItem'><i class='fa fa-check'></i>Pilih</button></td>
          <td>{{ $d->code }}</td>
          <td>{{ $d->item }}</td>
          <td>{{ $d->merk }}</td>
          <td>{{ $d->type }}</td>
          <td>{{ $d->serial_number }}</td>
          <td>{{ $d->imei }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.row (main row) -->
<script>
$(document).ready(function(){
  var $list = $('#listData');
  var dataAdd = '';
  $('body').on('keyup', '#sq', function(){
    var sf = $("#sf").val();
    var sq = $("#sq").val();

    $list.html("");
    $.ajax({
      url: '/tools/search/mutasi',
      type: "GET",
      data: "sf="+sf+"&sq="+sq,
      dataType: "json",
      beforeSend: function(){
        $list.html('<tr><td colspan="7" style="text-align:center;"><i class="fa fa-spinner fa-spin" ></i></td></tr>');
      },
      success: function(data)
      {
        // alert(sq);
        // console.log(data);
        $.map(data, function (item) {
          dataAdd += "<tr data-id='"+item.id+"'><td style=' text-align:center; '><button type='button' class='btn btn-success btn-xs pilihItem'><i class='fa fa-check'></i>&nbsp;Pilih</button></td><td>"+item.code+"</td><td>"+item.item+"</td><td>"+item.merk+"</td><td>"+item.type+"</td><td>"+item.serial_number+"</td><td>"+item.imei+"</td></tr>";
        });
        $list.html(dataAdd);
        dataAdd = "";
      }
    });
  });

  $('body').on('click', '.pilihItem', function(){

    var el = $(this);
    var _one = el.parent('td');
    var _two = el.parent('td').parent('tr');
    var _twoVal = _two.attr('data-id');

    _one.html("<button type='button' class='btn btn-default btn-xs cancelItem'><i class='fa fa-check-circle-o'></i>&nbsp;Terpilih</button>");
  });

  $('body').on('click', '.cancelItem', function(){

    var el = $(this);
    var _one = el.parent('td');
    var _two = el.parent('td').parent('tr');
    var _twoVal = _two.attr('data-id');

    _one.html("<button type='button' class='btn btn-success btn-xs pilihItem'><i class='fa fa-check'></i>&nbsp;Pilih</button>");
  });
});
</script>
