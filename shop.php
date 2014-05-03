<?php session_start();?>
<?php

include_once "inc/db_connect.php";
include_once "inc/functions.php";
?>
<html>
<head>
		<?php
		$title = "DominationVPS Shop";
		$pageName = "shop";
		include_once "inc/head.php";
		?>
	</head>
<body>
	<?php include_once "inc/header.php";?>
		<div class="body">
		<div class="main">

			<div class="alert-warning"
				style="padding-top: 10px; padding-bottom: 10px;">
				<h2>The webstore is under construction! It will be buggy!</h2>
			</div>
			<div class="alert-success"
				style="margin-top: 10px; padding-top: 10px; padding-bottom: 10px;">
				<h4>
					<strong>If you want to rent a minecraft server, add me on skype:
						thunderbolt135<br>I can get you set up from there :)
					</strong>
				</h4>
			</div>
			<br> <br>

			<div class="well"
				style="margin-right: auto; margin-left: auto; min-width: 300px; max-width: 300px;">
				<div class="well">
					<div class="center">
						<!-- paypal button -->
						<form target="paypal"
							action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_s-xclick"> <input
								type="hidden" name="hosted_button_id" value="XXJTFF3LCPZGC">
							<table>
								<tr>
									<td><input type="hidden" name="on0" value="RAM">RAM</td>
								</tr>
								<tr>
									<td><select name="os0">
											<option value="256MB (1/4GB)">256MB (1/4GB) $2.00 USD</option>
											<option value="512MB (1/2GB)">512MB (1/2GB) $4.00 USD</option>
											<option value="1GB">1GB $8.00 USD</option>
											<option value="1.5GB">1.5GB $12.00 USD</option>
											<option value="2GB">2GB $16.00 USD</option>
											<option value="2.5GB">2.5GB $20.00 USD</option>
											<option value="3GB">3GB $24.00 USD</option>
											<option value="4GB">4GB $32.00 USD</option>
									</select></td>
								</tr>
								<tr>
									<td><input type="hidden" name="on1" value="Minecraft Username">Minecraft
										Username</td>
								</tr>
								<tr>
									<td><input type="text" name="os1" maxlength="200"></td>
								</tr>
							</table>
							<input type="hidden" name="currency_code" value="USD"> <input
								type="image"
								src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif"
								border="0" name="submit"
								alt="PayPal - The safer, easier way to pay online!"> <img alt=""
								border="0"
								src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
								width="1" height="1">
						</form>
						<!-- /paypal button -->
					</div>
				</div>
				<div class="well">
					Custom Package:<br> <input type="text" placeholder="RAM" /> <select><option
							value="MB">MB</option>
						<option value="GB">GB</option></select>
				</div>
			</div>

		</div>
	</div>
</body>
</html>
<?php include_once "inc/script.php";?>