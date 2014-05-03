<?php
if(isset($_POST['c'])){
	executeCommand($_SESSION["server"]["id"], $_POST['c']);
}
?>
<div class="well">
	<div style="text-align: left;">
		<script type="text/javascript">
			var auto_refresh = setInterval(
			function (){
				$('#load').load('inc/log.php');
			}, 2000);
		</script>
		<div id="load"
			style="min-width: 100%; min-height: 300px; background-color: black; color: white;"><?php include_once "inc/log.php";?></div>
	</div>
	<form method='post' style='margin-bottom: 0px;'>
		<input name='c' type="text" style="float: left; max-width: 80%;"
			class="form-control" placeholder="Enter a command here..." autofocus /><input
			value="Send Command" style="min-width: 120px; max-width: 20%"
			class="btn btn btn-primary btn-block" type="submit" />
	</form>
</div>