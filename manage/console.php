<div class="well">
	<h2>Console</h2>
	<div class="well" style="text-align:left;">
		<script type="text/javascript">
			var auto_refresh = setInterval(
			function (){
				$('#load').load('../inc/log.php');
			}, 2000);
		</script>
		<div id="load" style="min-width:100%;min-height:500px;"><?php include_once "inc/log.php";?></div>
	</div>
	<input type="text" style="float:left;" class="form-control" placeholder="Enter a command here..." /><input value="Send Command" style="max-width:120px;" class="btn btn btn-primary btn-block" type="submit" />
</div>