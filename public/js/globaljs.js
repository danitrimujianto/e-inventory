$(document).ready(function(){
  var modulPage = $("#modulPage").val();

  //Date range picker
  $('#rangepicker').daterangepicker();

  //logout button
  $("#logout").click(function(){
    document.fGlobal.method="POST";
    document.fGlobal.action="/logout";
    document.fGlobal.submit();
  });

  //add button
  $("#addButton").click(function(){
    document.location.href='/'+modulPage+'/add';

  });

  //save button
	$("#saveButton").click(function(){
		if(!checkNeeded2(".fProcess2"))
		{
      processing($(this), "save");
			$("#fProcess").submit();
		}
	});

  //back button
  $("#backButton, .backButton").click(function(){
    document.location.href='/'+modulPage;
  });

  //save modal
  $("body").on('click', '.saveModal', function(){
    var $el = $(this);
    saveModal($el);
  });

  //close modal
  $("body").on('click', '.closeModal', function(){
    closeModal();
  });

  //onchange submit
  $(".changeSubmit").change(function(){
    //document.fKategori.action='/'+modulPage;
    document.fKategori.submit();
  });

  //filter button
  $("#filterButton").click(function(){
    $("#searchForm").slideToggle();
  });

  //reset button
  $("#resetFilter").click(function(){
    document.location.href='/'+modulPage;
  });
  $("#resetFilterReport").click(function(){
    $("#sf").val("");
    $("#sq").val("");
    document.fReport.submit();
  });

  //delete button
  $(".deleteButton").click(function(){
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Apakah Anda Yakin Menghapus ", id, field, value, modulPage, 'Hapus');
  });

  //restore button
  $(".restoreButton").click(function(){
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Apakah Anda Yakin Restore ", id, field, value, modulPage, 'Restore');
  });

  //edit button
  $(".editButton").click(function(){
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    document.location.href="/"+modulPage+"/"+id;
  });

  //view button
  $(".viewButton").click(function(){
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    document.location.href="/"+modulPage+"/"+id+"/detail";
  });

  $(".viewRowButton td:not(:last-child)").click(function(){
    var id = $(this).parent('tr').attr('data-id');
    var field = $(this).parent('tr').attr('data-field');
    var value = $(this).parent('tr').attr('data-value');
    document.location.href="/"+modulPage+"/"+id+"/detail";
  });

  //print button
  $("#printButton").click(function(){
      document.fGlobal.method="GET";
      document.fGlobal.action="/"+modulPage+"/print/";
      document.fGlobal.target="_blank";
      document.fGlobal.submit();
  });

  //excel button
  $("#excelButton").click(function(){
      document.fGlobal.method="GET";
      document.fGlobal.action="/"+modulPage+"/export/excel";
      document.fGlobal.target="_blank";
      document.fGlobal.submit();
  });

  //excel report button
  $("#ReportSubmitButton").click(function(){
      document.fReport.action="/"+modulPage;
      document.fReport.target="";
      document.fReport.submit();
  });

  //excel report button
  $("#ReportExcelButton").click(function(){
      document.fReport.action="/"+modulPage+"/export/excel";
      document.fReport.target="_blank";
      document.fReport.submit();
  });

  //print report button
  $("#ReportPrintButton").click(function(){
      document.fReport.action="/"+modulPage+"/print";
      document.fReport.target="_blank";
      document.fReport.submit();
  });

  //upload button
  $(".showUploadButton").click(function(){
    $('.fileArea').hide();
    $('.uploadArea').show();

    $('#upload_file').val(1);
  });

  //undo upload button
  $(".undoUploadButton").click(function(){
    $('.fileArea').show();
    $('.uploadArea').hide();

    $('#upload_file').val(0);
  });

  //number only
  $("body").on("keydown", "input[type='number']", function(e){
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         // Allow: Ctrl/cmd+A
        (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
         // Allow: Ctrl/cmd+C
        (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
         // Allow: Ctrl/cmd+X
        (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
  });

  //nominal
  $('body').on('keyup', '.nominal', function(event) {
    var isi = $(this).val().replace(/,/g,"");
    $(this).val(nominal(isi));
	});

  //desimal
  $('body').on('keyup', '.desimal', function(event) {
    // skip for arrow keys
	  if(event.which >= 37 && event.which <= 40){
		event.preventDefault();
	  }
	  $(this).val(function(index, value) {
		return value
		  .replace(/\D/g, "")
		  .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
	  });
	});

  //action pilih kabupaten by provinsi
  $('#pilihProv').change(function(){
    var id = $(this).val();
    var el = $('#pilihKab');
    pilihProv(id, el);
  });

  //action pilih kecamatan by kabupaten
  $('#pilihKab').change(function(){
    var id = $(this).val();
    var el = $('#pilihKec');
    pilihKab(id, el);
  });

  //action pilih kabupaten by provinsi
  $('#pilihProv2').change(function(){
    var id = $(this).val();
    var el = $('#pilihKab2');
    pilihProv(id, el);
  });

  //action pilih kecamatan by kabupaten
  $('#pilihKab2').change(function(){
    var id = $(this).val();
    var el = $('#pilihKec2');
    pilihKab(id, el);
  });

  //action pilih kavling by proyek
  $('#id_proyek').change(function(){
    var id = $(this).val();
    var el = $('#id_kavling');
    pilihKavling(id, el);
  });

  //datepicker tanggal
  $('.datepicker').datepicker({
  	format: 'dd/mm/yyyy',
  	autoclose: true
  });

  //datepicker on element js
  $('body').on('click', '.datepickerjs', function(){
    $(this).datepicker({
    	format: 'dd/mm/yyyy',
    	autoclose: true
    });
		$(this).datepicker('show');
  });

});

$(window).ready(function(){

});
