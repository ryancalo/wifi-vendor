<h4>Galileo Configuration</h4>
<hr>


<?php
if ($galileo) {
	foreach ($galileo as $key => $value) {
		$galileo_ip = $galileo['galileo_ip'];
	}
} else {
	$galileo_ip = "";
}

?>

<form id="savegalileo" method="Post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="usr">IP/HOST ADDRESS:</label>
		<input type="text" class="form-control" id="galileo_ip" name="galileo_ip" placeholder="xxx.xxx.xx.xxx/sample.com" value="<?php echo $galileo_ip; ?>">
	</div>

	<center>
	<button type="button" id="btn-test-connection-galileo" class="btn btn-primary btn-lg"><i class='fa fa-cogs'></i> Test Connection</button> <button id="btn-save-galileo" type="submit" class="btn btn-success btn-lg"><i class='fa fa-save'></i> Save</button>
   </center>
</form>