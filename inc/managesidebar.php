<div class="sidebar">
	<div class="col-sm-3 col-md-2 sidebar"
		style="padding-right: 0px; padding-left: 0px; min-width: 230px;">
		<div class='well'>
			<ul class="nav nav-sidebar">
				<li><input class="btn btn-lg btn-info btn-block" type="button"
					value="Dashboard"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button" value="Console"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>&page=console'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button"
					value="Server Mod"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>&page=mod'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button"
					value="Server Configuration"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>&page=config'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button" value="Files"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>&page=files'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button"
					value="Scheduled Tasks"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>&page=tasks'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button" value="Backup"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>&page=backup'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button" value="Plugins"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>&page=plugins'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button" value="Support"
					onClick="parent.location='support.php'" /></li>
				<li style="margin-top: 5px;"><input
					class="btn btn-lg btn-info btn-block" type="button"
					value="Log Viewer"
					onClick="parent.location='manage.php?server=<?php echo $_SESSION["server"]["id"];?>&page=logs'" /></li>
			</ul>
		</div>
	</div>
</div>