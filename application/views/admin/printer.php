<h4>Printer Configuration</h4>
<hr>


<?php
if ($printer) {
	foreach ($printer as $key => $value) {
		$printer_ip = $printer['printer_ip'];
		$printer_port = $printer['printer_port'];
	}
} else {
	$printer_ip = "";
	$printer_port = "";
}

?>

<form id="saveprinter" method="Post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="usr">IP/HOST ADDRESS:</label>
		<input type="text" class="form-control" id="printer_ip" name="printer_ip" placeholder="xxx.xxx.xx.xxx/sample.com" value="<?php echo $printer_ip; ?>">
	</div>

	<div class="form-group">
		<label for="usr">PORT:</label>
		<input type="text" class="form-control" id="printer_port" name="printer_port" placeholder="9100" value="<?php echo $printer_port; ?>">
	</div>

	<center>
	<button type="button" id="btn-test-connection-printer" class="btn btn-primary btn-lg"><i class='fa fa-cogs'></i> Test Connection</button> <button id="btn-save-printer" type="submit" class="btn btn-success btn-lg"><i class='fa fa-save'></i> Save</button>
   </center>
</form>