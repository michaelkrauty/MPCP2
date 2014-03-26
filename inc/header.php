<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class='container'>
		<div class='navbar-header'>
			<span class='sr-only'>Toggle navigation</span>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span>
			<a class='navbar-brand' href='index.php';"vertical-align:middle";> DominationVPS </a>
		</div>
		<div class='navbar-collapse'>
			<ul class='nav navbar-nav'>
				<?php echo "<li";if($pageName == "index"){echo" class='active'";}echo">";echo"<a href='index.php' title='Home'>Home</a></li>";?>
				<?php echo "<li";if($pageName == "shop"){echo" class='active'";}echo">";echo"<a href='shop.php' title='Shop'>Shop</a></li>";?>
				<?php echo "<li";if($pageName == "manage"){echo" class='active'";}echo">";echo"<a href='manage.php' title='My Servers'>My Servers<br></a></li>";?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php if(login_check()){?>
			<?php 
			if(isset($_POST["logout"])){
				session_destroy();
				header("Location: index.php");
			}
			?>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $_SESSION["user"]["email"]; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php if($_SESSION["user"]["id"] == 1 && $_SESSION["user"]["email"] == "michaelkrauty@gmail.com" && $_SESSION["user"]["username"] == "mi16"){?>
						<li style="text-align:center;"><button style="width:90%;margin-top:10px;" name="settings" onClick="parent.location='admin.php'" class="btn btn-sm btn-info">Admin Area</button></li>
						<?php }?>
						<li style="text-align:center;"><button style="width:90%;margin-top:10px;" name="settings" onClick="parent.location='settings.php'" class="btn btn-sm btn-info">Account Settings</button></li>
						<li class="divider"></li>
						<li style="text-align:center;"><form method="post"><button style="width:90%;" name="logout" action="submit" class="btn btn-sm btn-info">Logout</button></form></li>
					</ul>
				</li>
				<?php }if(!login_check()){?>
					<div style="margin-top:10px;">
						<button style="margin-right:10px;" onClick="parent.location='login.php'" class="btn btn-sm btn-info">Log In</button>
						<button onClick="parent.location='register.php'" class="btn btn-sm btn-info">Register</button>
					</div>
				<?php }?>
			</ul>
		</div>
	</div>
</div>