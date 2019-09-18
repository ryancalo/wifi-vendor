
<?php



   if ( $printer_status )
        {

           
             foreach ($printer_status as $printer_key => $printer_value) {
                
                 $status_printer = $printer_value->printer_status;
             }


        }  
   else
      {

           $status_printer = "Uknown Error";   
 
      }






   if ( $controller_status )
        {

           
             foreach ($controller_status as $controller_key => $controller_value) {
                
                 $status_controller = $controller_value->controller_status;
             }


        }  
   else
      {

           $status_controller = "Uknown Error";   
 
      }















?>





<div class="row">









        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box <?php if ( $status_printer == "Offline" ) { echo "bg-red"; } else { echo "bg-green"; } ?> ">
            <span class="info-box-icon text-white"> <i class='fa fa-print'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">PRINTER</span>
              <span id = 'cost0' class="info-box-number text-white "> <?php echo $status_printer; ?> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                     Status
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>








        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box <?php if ( $status_controller == "Offline" ) { echo "bg-red"; } else { echo "bg-green"; } ?> ">
            <span class="info-box-icon text-white"> <i class='fa fa-cogs'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">CONTROLLER</span>
              <span id = 'cost0' class="info-box-number text-white "> <?php echo $status_controller; ?> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    Status
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>








</div>