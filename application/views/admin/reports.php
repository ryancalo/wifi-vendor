<div class = "row">

   <div class = "col-lg-3">
       <button  style ='height: 150px; margin-bottom: 10px' type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modalinput">Print Free Voucher</button>
   </div>
   <div class = "col-lg-3">
       <button  style ='height: 150px; margin-bottom: 10px' type="button" class="btn btn-block btn-success">Print Weekly Report</button>
   </div>
   <div class = "col-lg-3">
       <button  style ='height: 150px; margin-bottom: 10px' type="button" class="btn btn-block btn-primary">Print Monthly Report</button>
   </div>

</div>



<!-- The Modal -->
<div class="modal fade" id="modalinput">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Number of voucher(s)</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <input type="number" class="form-control" value = "1" id="voucher_num">
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button id = "btn-print-free-voucher" type="button" class="btn btn-success" >Print</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>





















