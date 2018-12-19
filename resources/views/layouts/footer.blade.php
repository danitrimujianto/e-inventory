<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2018 <a href="/home">PT. Sinergi AITIKOM</a>.</strong> All rights
  reserved.
</footer>
@yield('footerAdd')
<form name="fGlobal" id="fGlobal" method="POST" action="">
  @csrf
  <input type="hidden" name="id" id="idFGlobal" value="">
  <input type="hidden" name="_method" id="method" value="">
</form>


<!-- Modal -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="tombol-modal" style=" display:none; ">Open Modal</button>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body" style="  ">
		<center><i class='fa fa-refresh fa-spin'></i>&nbsp;&nbsp;&nbsp;Mohon Tunggu...</center>
      </div>
      <div class="modal-footer" id="btn-closemodal">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="tombol-close-modal">Close</button>
      </div>
    </div>

  </div>
</div>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2" data-backdrop="static" id="tombol-modal2" style=" display:none; ">Open Modal</button>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog" style=" ">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body" style="  ">
  		     <center><i class='fa fa-refresh fa-spin'></i>&nbsp;&nbsp;&nbsp;Mohon Tunggu...</center>
        </div>
      </div>
    </div>
	</div>
