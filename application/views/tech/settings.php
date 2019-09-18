
<h4>Controller Configuration</h4>
<hr>


<?php





   if ($controller)
   	 {


   	 	   foreach ($controller as $key => $value) {
   	 	   	
               
               $controller_ip = $host = trim($value->controller_ip,"https://wwww.");
               $controller_port = $value->controller_port;
               $controller_username = $value->controller_username;
               $controller_password = $value->controller_password;

   	 	   }
   	 }
   	else

   	{

               $controller_ip = "";
               $controller_port = "";
               $controller_username = "";
               $controller_password = "";


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
			  <label for="usr">USERNAME:</label>
			  <input type="text" class="form-control" id ="controller_username" name ="controller_username" placeholder = "Controller's Username" value = "<?php echo $controller_username; ?>">
			</div>


			<div class="form-group">
			  <label for="usr">PASSWORD:</label>
			  <input type="password" class="form-control" id ="controller_password" name ="controller_password" placeholder = "Controller's Password" value = "<?php echo $controller_password; ?>">
			</div>

			<button type="button" id = "btn-test-connection" class="btn btn-primary">Test Connection</button> <button id = "btn-save-controller" type="submit" class="btn btn-success">Save</button>


</form>