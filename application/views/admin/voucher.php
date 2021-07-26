
<h4>Voucher Configuration</h4>
<hr>

<?php
    if ($voucher){
    	$logo =  $voucher['voucher_logo'] . "?dummy=" . rand(10,999) ;
    	$voucher_notes = $voucher['voucher_notes'];
    	$voucher_steps = $voucher['voucher_steps'];
     	$hour_coin = $voucher['voucher_duration'];
    	$bandwidth_limit = $voucher['bandwidth_limit'];   		  	   	   
 	    $bandwidth = $voucher['bandwidth'];
  }else{
        $logo =  base_url('public/src/img/default.png');
        $voucher_notes = "";
        $voucher_steps = "";
        $hour_coin = "";
        $bandwidth_limit = "";                  
        $bandwidth = "";
     }

?>

    
<center> 
    <img src="<?php echo $logo; ?>" id ='profile' class="img-rounded image" alt="voucher logo" width="50%" height="40%" style= 'border: solid 1px; border-color: grey; border-style: solid;'> 
</center>

<center> <br>
    <button class ='btn btn-secondary btn-sm' style="display:block; width:120px; height:30px;" onclick="document.getElementById('fileToUpload').click()">Change</button> 
</center>


    <form id = "uploadfile" method="Post" enctype="multipart/form-data">
        <input name="fileToUpload"  id="fileToUpload" type="file" onchange="loadFile(event)" style="display:none"></input>                                 
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
			<input id = "hourcoin" type="number" class="form-control mb-2 mr-sm-2" value = "<?php echo $hour_coin; ?>" name="hourcoin">
		</div>

		<div class="form-group">
			<label for="usr">Bandwidth Limit: (MB)</label>
			<input type="number" class="form-control mb-2 mr-sm-2" value = "<?php echo $bandwidth_limit; ?>" name="bandwidth_limit">
		</div>


        <div class="form-group">
            <label for="usr">Bandwidth: (KB)</label>
            <input type="number" class="form-control mb-2 mr-sm-2" value = "<?php echo $bandwidth; ?>" name="bandwidth_updown">
        </div>
		<center>
		    <button type="submit" id = "btn-save" class="btn btn-success btn-lg"><i class='fa fa-save'></i> Save</button>
		</center>
	</form>
