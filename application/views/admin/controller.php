
<h4>Controller Configuration</h4>
<hr>


<?php





   if ($controller)
   	 {


   	 	   foreach ($controller as $key => $value) {
   	 	   	
              
							 $controller_ip = $controller['controller_ip'];						 
               $controller_port = $controller['controller_port'];
               $controller_username = $controller['controller_username'];
							 $controller_password = $controller['controller_password'];
							 $controller_siteid = $controller['controller_siteid'];
                                                                 $controller_version = $controller['controller_version'];
   	 	   }
   	 }
   	else

   	{

               $controller_ip = "";
               $controller_port = "";
               $controller_username = "";
							 $controller_password = "";
							 $controller_siteid = "";
	                                                        $controller_version = "";

   	}




?>




<form id = "savecontoller" method="Post" enctype="multipart/form-data">



			<div class="form-group">
			  <label for="usr">IP:</label>
			  <input type="text" class="form-control" id ="controller_ip" name ="controller_ip" placeholder = "xxx.xxx.xx.xxx" value = "<?php echo $controller_ip; ?>">
			</div>

			<div class="form-group">
			  <label for="usr">PORT:</label>
			  <input type="text" class="form-control" id ="controller_port" name ="controller_port" placeholder = "8443" value = "<?php echo $controller_port; ?>">
			</div>

			<div class="form-group">
			  <label for="usr">SITE ID:</label>
			  <input type="text" class="form-control" id ="controller_site" name ="controller_site" placeholder = "default" value = "<?php echo $controller_siteid; ?>">
			</div>


			<div class="form-group">
			  <label for="usr">Controller Version:</label>
			  <input type="text" class="form-control" id ="controller_version" name ="controller_version" placeholder = "default" value = "<?php echo $controller_version; ?>">
			</div>


			<div class="form-group">
			  <label for="usr">USERNAME:</label>
			  <input type="text" class="form-control" id ="controller_username" name ="controller_username" placeholder = "Controller's Username" value = "<?php echo $controller_username; ?>">
			</div>


			<div class="form-group">
			  <label for="usr">PASSWORD:</label>
			  <input type="password" class="form-control" id ="controller_password" name ="controller_password" placeholder = "Controller's Password" value = "<?php echo $controller_password; ?>">
			</div>

			<button type="button" id = "btn-test-connection" class="btn btn-primary"><i class='fa fa-cogs'></i> Test Connection</button> <button id = "btn-save-controller" type="submit" class="btn btn-success"><i class='fa fa-save'></i> Save</button>


</form>