
<h4>Voucher Configuration</h4>
<hr>


  

<?php

  

    if ($voucher)
    	{


    		  foreach ($voucher as $key => $value) {
    		  	 

    		  	   	   	  $logo =  base_url('public/src/img/') . $value->voucher_logo;
    		  	   	   	  $voucher_notes = $value->voucher_notes;
    		  	   	   	  $voucher_steps = $value->voucher_steps;
    		  	   	      $voucher_duration = $value->voucher_duration;

    		  	   	      $bandwidth_limit = $value->bandwidth_limit;
                      $bandwidth = $value->bandwidth;

                     




    		  }
    	}
    else
       {

    		      $logo =  base_url('public/src/img/default.png');
    		      $voucher_notes ="";
    		      $voucher_steps = "";
    		      $voucher_duration = "";

                      $bandwidth_limit = "";
                      $bandwidth = "";

       }




?>
   
                               
                               <center> 

                               	    <img src="<?php echo $logo; ?>" id ='profile' class="img-rounded image" alt="Cinque Terre" width="50%" height="40%" style= 'border: solid 1px; border-color: grey; border-style: solid;'> 

                               </center>


                                <center> <br>

                                	 <button class ='btn btn-secondary btn-sm' style="display:block; width:120px; height:30px;" onclick="document.getElementById('fileToUpload').click()">Change</button> 

                                </center>

                                        <center>


                                  <form id = "uploadfile" method="Post" enctype="multipart/form-data">

                                       <input name="fileToUpload"  id="fileToUpload" type="file" onchange="loadFile(event)" style="display:none"></input>
                                  
                                  
                                       </center>
                                     

                                   



  

											<div class="form-group">
											  <label for="usr">Steps:</label>
											   <textarea name = "voucher_step" class="form-control" rows="5" id="steps"> <?php echo $voucher_steps; ?></textarea>
											</div>



											<div class="form-group">
											  <label for="usr">Notes:</label>
											   <textarea name = "voucher_notes" class="form-control" rows="5" id="notes"> <?php echo $voucher_notes; ?> </textarea>
											</div>




											<div class="form-group">
											  <label for="usr">Minutes Per voucher:</label>
											   <input id = "hourcoin" type="number" class="form-control mb-2 mr-sm-2" value = "<?php echo $voucher_duration; ?>" name="hourcoin">
											</div>


											<div class="form-group">
											  <label for="usr">Bandwidth Limit: (MB)</label>
											   <input type="number" class="form-control mb-2 mr-sm-2" value = "<?php echo $bandwidth_limit; ?>" name="bandwidth">
											</div>



                      <div class="form-group">
                        <label for="usr">Bandwidth: (KB)</label>
                         <input type="number" class="form-control mb-2 mr-sm-2" value = "<?php echo $bandwidth; ?>" name="bandwidth_updown">
                      </div>


											<button type="button" id = "btn-test-print" class="btn btn-primary">Print Test</button> <button type="submit" id = "btn-save" class="btn btn-success">Save</button>
							        </form>

















