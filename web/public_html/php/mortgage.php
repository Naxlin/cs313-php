<!DOCTYPE html>
<html>
<head>
	<title>Mortgage Calculator</title>
	<meta charset="utf-8"/>
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   	<script type="text/javascript" src="../js/assign09-1.js"></script>
   	<link rel="stylesheet" type="text/css" href="../css/assign09-1.css">
   	<link rel="icon" href="../house.png">
</head>

<body>
	<form id="formContainer"> 
		<h1 class="borderNormal">Mortgage Calculator</h1>
		
		<!-- First text inputs -->
		<div class="borderThin flexRow relative">
			<span class="widthQuarter">Annual Percentage Rate</span>
			<span class="borderRight widthQuarter" style="text-align: left;">
				<span class="phpValues widthQuarter">
				<?php
					$apr = "=     ";
					$apr = $apr . number_format((float)$_GET["APR"], 2, '.', '') . " %";
			    echo "<pre>$apr</pre>";
				?>
				</span>
			</span>
	    <span class="widthQuarter">Loan Term</span>
			<span class="widthQuarter" style="text-align: left;">		 
				<span class="phpValues widthQuarter">   
		    <?php
		    	$lt = "=     ";
					$lt = $lt . number_format((float)$_GET["LT"], 0, '.', '');
			    echo "<pre>$lt</pre>";
				?>
				</span>
			</span>
		</div>

		<!-- Second text inputs -->
		<div class="borderThin flexRow relative">
			<span class="widthQuarter">Loan Amount</span>
			<span class="borderRight widthQuarter" style="text-align: left;">
				<span class="phpValues widthQuarter">
		    <?php 
		    	$la = "=     \$"; 
		    	$la = $la . number_format((float)$_GET["LA"], 2, '.', '');
			    echo "<pre>$la</pre>";
				?>
				</span>
			</span>
	    <span class="widthQuarter">Monthly Payment</span>
	    <span class="widthQuarter" style="text-align: left;">
	    	<span class="phpValues widthQuarter">
	    		<?php 
		    		// Converts to float and rounds to nearest 2nd decimal place.
	   	 			$apr = number_format((float)$_GET["APR"], 2, '.', '');
	   	 			// Converts to float and rounds to nearest 2nd decimal place.
	    			$la = number_format((float)$_GET["LA"], 2, '.', '');
	    			// Converts to float and rounds to nearest year.
	    			$lt = number_format((float)$_GET["LT"], 0, '.', ''); 
	    			$apr = $apr / 100; // Reducing to percentage.
	    			$mpr = $apr / 12; // Reducing to month.
	    			$lt = $lt * 12; // Turning loan term into months.
	    			$ltNeg = -1 * abs($lt); // Turning the Loan Term negative.
	    			$prePay = "=     \$";

	    			$payment = (($mpr * $la) / (1 - (pow(($mpr + 1), $ltNeg))));
	    			$payment = number_format($payment, 2, '.', '');
	    			echo "<pre>$prePay$payment</pre>";
	    		?>
	    	</span>
	    </span>
		</div>

		<!-- Alerts box -->
		<div id="alerts" class="borderThin flexRow relative" 
		style="display: none;"></div>

		<!-- Buttons -->
        <div class="borderThin flexRow relative"> 
          	<button type="button" class="button widthHalf" onclick="returnHome()">Reset Form</button>
        </div>
		
	</form>
   	<!-- Page Footer -->
   	<footer>
   	   <p id="pageEnd">Give us your soul...<br/>Please.<br/>© copyright 2018</p>
   	</footer>
</body>
</html>