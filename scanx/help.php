<?php
	//database connection
	include('lib/config.php');
	
?><!DOCTYPE html>
<html lang="en">
  <head>
	<?php include('head.php'); ?>
  </head>
<body>
	<?php include('navbar.php'); ?>

	<div class="container" style="margin-top:35px">
	
		<div class="page-header" id="banner">
			<div class="row">
				<ul class="breadcrumb">
                <li><a href="./">Home</a></li>
                <li class="active">Help</li>
              </ul>
			</div>
		</div>
	  
		<div class="page-header">
			
			<div class="row">
			
				<h1>Help guide</h1>
				<p>In the menu options goto 'Congire URLs' and set the Home page URL and Barcode/QR code Lookup URL as below.</p>
			
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Home Page URL</h3>
					</div>
					<div class="panel-body"><?php echo $homepage_url; ?></div>
				</div>
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Barcode/QR code Lookup URL</h3>
					</div>
					<div class="panel-body"><?php echo $callback_url; ?></div>
				</div>
			</div>
		</div>
	</div>

<?php include('footer.php'); ?>
</body>
</html>





