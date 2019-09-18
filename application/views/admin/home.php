



<div class="row">



                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">


                          <div id = 'graph_buttons' class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="button" value = "today" class="btn btn-sm btn-secondary active">Today</button>
                                <button type="button" value = "week" class="btn btn-sm btn-secondary ">This Week</button>
                                <button type="button" value = "month" class="btn btn-sm btn-secondary ">This Month</button>

                         </div> 

                     </div>




        <div  style = "margin-top: 20px" class="col-lg-12 col-md-12 col-sm-12 col-12">
          
       
             
             <div   id="canvas"></div>
            
           
                
        </div>








        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box bg-red">
            <span class="info-box-icon text-white"> <i class='fa fa-money'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">Today</span>
              <span id = 'income0' class="info-box-number text-white "> <i class='fa fa-spinner fa-spin'></i> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    PESO
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>









        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box bg-warning">
            <span class="info-box-icon text-white"> <i class='fa fa-money'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">Yesterday</span>
              <span id = 'income1' class="info-box-number text-white "> <i class='fa fa-spinner fa-spin'></i> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    PESO
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>








        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box bg-green">
            <span class="info-box-icon text-white"> <i class='fa fa-money'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">This Week</span>
              <span id = 'income2' class="info-box-number text-white "> <i class='fa fa-spinner fa-spin'></i> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    PESO
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>







        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box bg-blue">
            <span class="info-box-icon text-white"> <i class='fa fa-money'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">This Month</span>
              <span id = 'income3' class="info-box-number text-white "> <i class='fa fa-spinner fa-spin'></i> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    PESO
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>






        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box bg-purple">
            <span class="info-box-icon text-white"> <i class='fa fa-money'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">In Vault</span>
              <span id = 'income4' class="info-box-number text-white "> <i class='fa fa-spinner fa-spin'></i> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    PESO
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>






        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box bg-dark">
            <span class="info-box-icon text-white"> <i class='fa fa-users'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">Active Users</span>
              <span id = 'income5' class="info-box-number text-white "> <i class='fa fa-spinner fa-spin'></i> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    CONTROLLER
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>









        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box bg-maroon">
            <span class="info-box-icon text-white"> <i class='fa fa-print'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">Paper Status</span>
              <span id = 'income6' class="info-box-number text-white "> <i class='fa fa-spinner fa-spin'></i> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    PRINTER
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>







        <!-- /.col -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="info-box bg-teal">
            <span class="info-box-icon text-white"> <i class='fa fa-cogs'></i> </span>

            <div class="info-box-content">
              <span class="info-box-text text-white">Conn Status</span>
              <span id = 'income7' class="info-box-number text-white "> <i class='fa fa-spinner fa-spin'></i> </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span id = 'total-cost-peso' class="progress-description text-white">
                    DEVICES
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>







       <div class="col-lg-12">

        <table class="table table-sm table-hover">
            <thead>
               <tr>
                  <th><i class="fa fa-fw fa-calendar"></i> Date</th>
                  <th><i class="fa fa-fw fa-gavel"></i> Action</th>
              </tr>
           </thead>
           <tbody>
             
              <?php
          
                   if ( $maintenance_log )
                      {

                                   echo "<tr><td>" . date("M d, Y h:i A", strtotime($maintenance_log['maintenance_date'])) . "</td><td>" . $maintenance_log['maintenance_type'] . "</td></tr>"; 
                                

                      }

              ?>
            
          </tbody>
      </table>

</div>













</div>

    <script src="<?php echo base_url('public/js/graph.js');?>"></script>