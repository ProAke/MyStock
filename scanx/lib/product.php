<?php

	//sanitise and check GET variables
	if (isset($_GET['barcode'])) {
		$barcode = preg_replace("/[^0-9,.]/", "", $_GET['barcode']);
	} else {
		$barcode = 0;
	}
	
	if ($barcode != 0) {

		//fetch product details
		$sql_query = 
			"select
				*
			from
				`Products`
			where
				`Barcode` = '".$barcode."'
			";
			
			
		$result = mysqli_query($link,$sql_query) or die('Query failed: Unable to Read Table Record' .mysql_error());
		
		while ($row = mysqli_fetch_assoc($result))
		{
				$products[] = $row;
		}

	}


?>