<?php
	//database connection
	include('lib/config.php');
	
	//clean and fetch data
	include('lib/product.php');
	
?>
<!DOCTYPE html>
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
                <li class="active">Product Scan</li>
              </ul>
			</div>
			<div class="row">
				<div class="scan-section" style="text-align:center">
					<a href="p2spro://scan?formats=EAN13,EAN8,UPCE,ITF,CODE39,CODE128,CODE93,STD2OF5,CODABAR,QR&callback=<?php echo urlencode($callback_url); ?>" class="btn btn-primary btn-lg">Start Scan</a>
				</div>
			</div>
		</div>
	  
		<div class="page-header">
			
			<?php if ($products[0]['IMAGE 1'] != "") : ?>
			<div class="row">
			<img src="<?php echo $products[0]['IMAGE 1']; ?>" >
			<span class="label label-success">Image 1</span>
			</div>
			<?php endif; ?>
			
			<div class="row">
			
				<ul class="nav nav-tabs">
					<li class="active"><a aria-expanded="true" href="#details" data-toggle="tab">Product Details</a></li>
					<li class=""><a aria-expanded="false" href="#images" data-toggle="tab">Images</a></li>
					<li class=""><a aria-expanded="false" href="#scan" data-toggle="tab">Scan Details</a></li>
				</ul>
				
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade active in" id="details">
					<?php if ($products) : ?>
					<?php foreach ($products as $pk => $product) :?>
						<h2>Product <?php echo $pk+1; ?></h2>
						  <table class="table table-striped table-hover ">
								<thead>
								  <tr>
									<th style="width:30%">Title</th>
									<th style="width:70%">Value</th>
								  </tr>
								</thead>
								<tbody>
								<?php foreach($product as $k => $v): ?>
								  <tr>
									<td><?php echo $k; ?></td>
									<td class="text-info"><?php echo $v; ?></td>
								  </tr>
								<?php endforeach; ?>
								</tbody>
							</table>

					<?php endforeach; ?>
					<?php else : ?>
					<p>No Product Found</p>
					<?php endif; ?>
					</div>
					
					<div class="tab-pane fade" id="images">
						<?php if ($products[0]['IMAGE 1'] != "") : ?>
						<div class="row">
						<img src="<?php echo $products[0]['IMAGE 1']; ?>" >
						<span class="label label-success">Image 1</span>
						</div>
						<?php endif; ?>
						
						<?php if ($products[0]['image 2'] != "") : ?>
						<div class="row">
						<img src="<?php echo $products[0]['image 2']; ?>" >
						<span class="label label-success">Image 2</span>
						</div>
						<?php endif; ?>		
						
						<?php if ($products[0]['image 3'] != "") : ?>
						<div class="row">
						<img src="<?php echo $products[0]['image 3']; ?>" >
						<span class="label label-success">Image 3</span>
						</div>
						<?php endif; ?>	
						
						<?php if ($products[0]['image flat'] != "") : ?>
						<div class="row">
						<img src="<?php echo $products[0]['image flat']; ?>" >
						<span class="label label-success">Image flat</span>
						</div>
						<?php endif; ?>
						
						<?php if ($products[0]['image full'] != "") : ?>
						<div class="row">
						<img src="<?php echo $products[0]['image full']; ?>" >
						<span class="label label-success">Image full</span>
						</div>
						<?php endif; ?>
						
						<?php if ($products[0]['image front'] != "") : ?>
						<div class="row">
						<img src="<?php echo $products[0]['image front']; ?>" >
						<span class="label label-success">Image front</span>
						</div>
						<?php endif; ?>
						
						<?php if ($products[0]['image side'] != "") : ?>
						<div class="row">
						<img src="<?php echo $products[0]['image side']; ?>" >
						<span class="label label-success">Image side</span>
						</div>
						<?php endif; ?>
						
						<?php if ($products[0]['image back'] != "") : ?>
						<div class="row">
						<img src="<?php echo $products[0]['image back']; ?>" >
						<span class="label label-success">Image back</span>
						</div>
						<?php endif; ?>
						
						
					</div>
				
					<div class="tab-pane fade" id="scan">
						<table class="table table-striped table-hover ">
							<thead>
							  <tr>
								<th>Title</th>
								<th>Value</th>
							  </tr>
							</thead>
							<tbody>
							<?php foreach($_GET as $k => $v): ?>
							  <tr>
								<td><?php echo $k; ?></td>
								<td class="text-info"><?php echo $v; ?></td>
							  </tr>
							<?php endforeach; ?>
							</tbody>
						</table>  
					</div>
				</div>

			</div>
		</div>
	</div>

<?php include('footer.php'); ?>
</body>
</html>





