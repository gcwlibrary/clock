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
	<link rel="stylesheet" href="stylesheets/clock.css">

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
			<h3>Compare!</h3>
			<p>This prototype takes the translation module (which you can see demo'd in the examples above) and places it inside a comparison module.</p>
			<p>The comparison module takes X number of translated sources, reads them into a local array and compares each of the elements to the defaut source. Where it find any differences in the data it has gathered, it will flag this up to the user.</p>
			<p>Ultimately, this will allow cataloguers (who are AT the default source) to interrogate their on records and identify any discrepancies or additional information they can include.</p>
			<p>The module is currently working off local flat CSV files, however the next step is to look at a database structure which could run the comparison module.</p>
			<h4>Filters</h4>
			<p>The default source is Cambridge data. You can change this here:</p>
			<p><a href="?source=cambs">Cambridge</a> | <a href="?source=harvard">Harvard</a> | <a href="?source=olib">Open Library</a></p>
			
			<?php
				if( isset($_GET['source']) ) :
					$source = $_GET['source'];
				else:
					$source = "cambs";
				endif;
				
				$terms = array("Title","Description","ISBN","Creator");
				echo compare($terms,$source);
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