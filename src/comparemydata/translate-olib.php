<?php include ("functions.php"); ?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Your Page Title Here :)</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>



	<!-- Primary Page Layout
	================================================== -->

	<!-- Delete everything in this .container and get started on your own site! -->

	<div class="container">
		<div class="sixteen columns">
			<h1 class="remove-bottom" style="margin-top: 40px">COMPAREmyDATA</h1>
			<h5>Version <?php the_version();?></h5>
			<br />
			<?php the_menu(); ?>
		</div>
		<div class="sixteen columns">
			<h3>Open Library Translation</h3>
			<p>This is a test to try and fix a system for translating JSON files.</p>
			<p>Translation file is a csv, which shows which fields in the JSON output need translating.</p>
			
			<?php
				//Pseudocode!!
				//-----------------------------------------------------------------------
				//1. Load translate file
				//	- Stored as a 2D array in $translator
				//	- First row should always contain a pointer to the root (clock_root) of the documents with the followin rules
				//		- #URI = the URI of the data
				//		- #NONE = no root
				//		- Anything else, pointer in the array, pipe delimited
				//	- Second row is an offset pointer (clock_root_offset) in case the root is just off, as in Harvard
				//		- #NONE = no offset
				//		- Anything else, the offset number
				
				$trans_file = fopen("translations/olib.csv", "r");
				$uri = "http://openlibrary.org/books/OL15479330M.json";
				
				while (($data = fgetcsv($trans_file, 1000, ",")) !== FALSE) {
					$translator[] = $data;
				}
				
				fclose($trans_file);
				
				//var_dump($translator); //#DEBUG
				
				//2. Load JSON
				//	2a. Identify document root
				
				$json = file_get_contents($uri);
				$json_a=json_decode($json,true);
				
				$clock_root = $translator[0][1];
				$clock_root_offset = $translator[1][1];
				
				//echo $clock_root; //#DEBUG
				//echo $clock_root_offset; //#DEBUG
				
				if( $clock_root == "#URI" ) :
					if( $clock_root_offset <> "#NONE" ) :
						$record = $json_a[$uri][$clock_root_offset];
					else :
						$record = $json_a[$uri];
					endif;
				elseif( $clock_root == "#NONE" ) :
					$record = $json_a;
				else :
					if( $clock_root_offset <> "#NONE" ) :
						$record = $json_a[$clock_root][$clock_root_offset];
					else :
						$record = $json_a[$clock_root];
					endif;
				endif;
				
				//var_dump($record); //#DEBUG
				
				//3. Step through JSON
				//	3a. For each entry in JSON, check in translation file
				//	3b. If JSON identifier is found, write value into Array
				
				
				foreach( $translator as $trans ) :
					if( array_key_exists( $trans[0],$record ) ) :
						$local_record[$trans[1]] = $record[$trans[0]];
					endif;
				endforeach;
				
				var_dump($local_record); //#DEBUG
				
				//4. Output array
			
			?>
		</div>
		
	</div><!-- container -->



	<!-- JS
	================================================== -->
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="javascripts/tabs.js"></script>

<!-- End Document
================================================== -->
</body>
</html>