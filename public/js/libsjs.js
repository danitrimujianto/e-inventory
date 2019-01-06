function asd()
{
    alert("asd");
}

function processing(obj, type, time=120000)
{
  var loading;
  //asd();
  if(type=="save")
  {
    loading = loadingSpin();
    obj.attr("disabled","disabled");
    obj.html(loading);
  }

  timeOut(time);
}

function timeOut(time)
{
  setTimeout(function(){
    noResponPage();
  }, time);
}

function loadingSpin()
{
  return '<i class="fa fa-refresh fa-spin"></i>';
}

function noResponPage(width=40){
	$("#myModal2 .modal-dialog").css({"width":width+"%"});
	$("#myModal2 .modal-title").html("NO RESPON PAGE");
	$("#myModal2 .modal-body").html('<div style=" font-size: 30px; text-align: center; height: 200px; margin-top: 20%;">Halaman Tidak Merespon dengan Benar. <a href="#" onclick=" document.location.reload(); ">Klik disini untuk refresh</a></div>');
	$("#tombol-modal2").click();
}

function animateDown(target){
	$('html, body').animate({
		scrollTop: $(target).offset().top
	}, 1000);
}

function checkNeeded2(el)
{
	var arr = [];
	var tr;
	var eu = "";
	$(el+" .needed").each(function() {
		tr = $(this).val();
		//alert(tr);
		if(tr == '')
		{
			eu = "1";
			//$(this).parent("div").attr("class","has-error");
			$(this).parent("div").find(".help-block2").show();
		}
	});

	if(eu == "")
	{
		return false;
	}else{
		animateDown(el);
		return true;
	}
}

function actDel(id, modulPage)
{
  document.fGlobal.id.value=id;
  //$("#method").val();
  document.fGlobal._method.value="delete";
  document.fGlobal.action="/"+modulPage+"/"+id;
  document.fGlobal.submit();
}

function actRestore(id, modulPage)
{
  document.fGlobal.id.value=id;
  //$("#method").val();
  document.fGlobal._method.value="get";
  document.fGlobal.action="/"+modulPage+"/"+id+"/restore";
  document.fGlobal.submit();
}

function actAccept(id, modulPage)
{
  document.fGlobal.id.value=id;
  //$("#method").val();
  document.fGlobal._method.value="get";
  document.fGlobal.action="/"+modulPage+"/"+id+"/accept";
  document.fGlobal.submit();
}

function actReject(id, title, modulPage)
{
  document.fGlobal.id.value=id;
  var urlModal = '/modal/reject/', titleModal='Reject '+title;
  var param = "&urlPos=/"+modulPage+"/"+id+"/reject";
  modalPage(id, urlModal, titleModal, 80, param);
  $('#myModal').find('.modal-footer').hide();
}

function actCancel(id, title, modulPage)
{
  document.fGlobal.id.value=id;
  var urlModal = '/modal/reject/', titleModal='Cancel '+title;
  var param = "&urlPos=/"+modulPage+"/"+id+"/cancel";
  modalPage(id, urlModal, titleModal, 80, param);
  $('#myModal').find('.modal-footer').hide();
}

function saveModal($el)
{
  if(document.fReject.keterangan_batal.value.trim() != ''){
    document.fReject.submit();
    $el.html('<i class="fa fa-refresh fa-spin"></i>');
    $el.prop('disabled', 'true');
  }
}

function closeModal()
{
  $("#myModal").find("#tombol-close-modal").click();
  $('#myModal').find('.modal-footer').show();
}

function alertSweet(ket, id, field, kode, modulPage, pos)
{

	swal(
		{
			title: ket+" \n"+field+": "+kode+" ?",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: 'Batal',
			confirmButtonClass: 'btn-danger',
			confirmButtonText: pos,
			closeOnConfirm: false
		}
	).then((result) => {
		if(result.value)
		{
      if(pos == 'Hapus'){
        actDel(id, modulPage)
      }else if(pos == 'Restore'){
        actRestore(id, modulPage)
      }else if(pos == 'Accept'){
        actAccept(id, modulPage)
      }else if(pos == 'Reject'){
        actReject(id, kode, modulPage)
      }else if(pos == 'Cancel'){
        actCancel(id, kode, modulPage)
      }
		}
	});
}

function nominal(bilangan)
{
	var	number_string = bilangan.toString(),
		split	= number_string.split('.'),
		sisa 	= split[0].length % 3,
		rupiah 	= split[0].substr(0, sisa),
		ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);

	if (ribuan) {
		separator = sisa ? ',' : '';
		rupiah += separator + ribuan.join(',');
	}
	rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
	return rupiah;
}

function desimal(bilangan)
{
	var	number_string = bilangan.toString(),
		split	= number_string.split('.'),
		sisa 	= split[0].length % 3,
		rupiah 	= split[0].substr(0, sisa),
		ribuan 	= split[0].substr(sisa).match(/\d{1.3}/gi);

	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
	return rupiah;
}

function alamatCustomer(newOptions, id_el, id_choose = null)
{
	//alert(newOptions);
	var $el = id_el;

}

function pilihProv(id_prov, el, id_choose = null)
{

  var $el = el;
	$el.empty(); // remove old options
	$el.append($("<option></option>").attr("value", "").text("-- Pilih Kabupaten --"));

  $.ajax({
    url: "/kabupaten/api/get",
		type: "GET",
		data: "id_prov="+id_prov,
		dataType: "json",
		success: function(data)
		{
      //alert("id");
			//alert(data);
			$.map(data, function (item) {
      	//$.each(obj,function(i,item){
          // console.log(item.id_kab);
      		if(id_choose == item.id_kab)
      		{
      			$el.append($("<option></option>").attr("value", item.id_kab).attr("selected", "selected").text(item.nama));
      		}else{
      			$el.append($("<option></option>").attr("value", item.id_kab).text(item.nama));
      		}
      	//});
			});
		}
  });
}

function pilihKab(id_kab, el, id_choose = null)
{

  var $el = el;
	$el.empty(); // remove old options
	$el.append($("<option></option>").attr("value", "").text("-- Pilih Kecamatan --"));

  $.ajax({
    url: "/kecamatan/api/get",
		type: "GET",
		data: "id_kab="+id_kab,
		dataType: "json",
		success: function(data)
		{
      //alert("id");
			//alert(data);
			$.map(data, function (item) {
      	//$.each(obj,function(i,item){
           //console.log(item.id_kab);
      		if(id_choose == item.id_kec)
      		{
      			$el.append($("<option></option>").attr("value", item.id_kec).attr("selected", "selected").text(item.nama));
      		}else{
      			$el.append($("<option></option>").attr("value", item.id_kec).text(item.nama));
      		}
      	//});
			});
		}
  });
}

function pilihKavling(id_proyek, el, id_choose = null)
{

  var $el = el;
	$el.empty(); // remove old options
	$el.append($("<option></option>").attr("value", "").text("-- Pilih Kavling --"));

  $.ajax({
    url: "/kavling/api/get",
		type: "GET",
		data: "id_proyek="+id_proyek,
		dataType: "json",
		success: function(data)
		{
      //alert("id");
      //console.log(data);
			$.map(data, function (item) {
      	//$.each(obj,function(i,item){
           //console.log(item.id_kab);
      		if(id_choose == item.id_kavling)
      		{
      			$el.append($("<option></option>").attr("value", item.id_kavling).attr("selected", "selected").text(item.blok+" / "+item.nomor));
      		}else{
      			$el.append($("<option></option>").attr("value", item.id_kavling).text(item.blok+" / "+item.nomor));
      		}
      	//});
			});
		}
  });
}

function addDataRow(){

	var maxField5 = 10; //Input fields increment limitation
	var addButton5 = $('#add-field5'); //Add button selector
	var wrapper5 = $('.field_wrapper5'); //Input field wrapper
	var fieldHTML5 = '<tr><td><input type="text" name="payment_ke[]" class="form-control col-md-7 col-xs-12" autocomplete="off" ></td><td><input type="text" name="persen[]" class="form-control col-md-7 col-xs-12" autocomplete="off" ></td><td><input type="text" name="keterangan[]" class="form-control col-md-7 col-xs-12" autocomplete="off" ></td><td><button type="button" class="btn btn-danger" id="del_field5"><i class="fa fa-minus"></i></button></td></tr>'; //New input field html
	var x5 = 1; //Initial field counter is 1
	$(addButton5).click(function(){ //Once add button is clicked
		if(x5 < maxField5){ //Check maximum number of input fields
			x5++; //Increment field counter
			$(wrapper5).append(fieldHTML5); // Add field html
		}
	});
	$(wrapper5).on('click', '#del_field5', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('td').parent('tr').remove(); //Remove field html
		x5--; //Decrement field counter
	});
}

function tgl_sql_to_indo(obj)
{

  var bj = obj.split('-');;
  if(obj != ''){
    bj = bj[2]+'/'+bj[1]+'/'+bj[0];
  }else{
    bj = '';
  }
  return bj;
}

function modalPage(id, url, title, width=40, param = null){
	$("#myModal .modal-dialog").css({"width":width+"%"});
	$("#myModal .modal-title").html(title);
	$("#myModal .modal-body").html('<div style=" font-size: 30px; text-align: center; height: 200px; margin-top: 20%;"><i class="fa fa-spinner fa-spin" ></i></div>');
	$.ajax({
		url: url, // Url to which the request is send

		type: "GET",             // Type of request to be send, called as method

		data: "id="+id+"&ajax=true"+param, // Data sent to server, a set of key/value pairs (i.e. form fields and values)

		contentType: false,       // The content type used when sending data to the server.

		cache: false,             // To unable request pages to be cached

		processData:false,        // To send DOMDocument or non processed data file it is set to false

		success: function(data)   // A function to be called if request succeeds

		{
			$("#myModal .modal-body").html(data);
		}
	});
	//$("#myModal .modal-body").load(page+".inc.php?id="+id);
	$("#tombol-modal").click();
}
