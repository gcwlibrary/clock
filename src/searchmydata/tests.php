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
	<title>Tests</title>
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
			<h1 class="remove-bottom" style="margin-top: 40px">SEARCHmyDATA</h1>
			<h5>Version <?php the_version();?></h5>
			<br />
			<?php the_menu(); ?>
		</div>
		<div class="one-third column">
			
			<?php the_form(); ?>
		</div>
		<div class="two-thirds column">
			<h3>Test cases</h3>
			<p>The following tests have bee set up to demonstrate searches on the available endpoints and API's. There may be some delay in this page loading as the tests are populated.</p>
			<?php
				include( "sparqllib.php" );
			?>

			<ul class="tabs">
				<li><a class="active" href="#cottrell1">Test 1a - Cambridge</a></li>
				<li><a href="#cottrell2">Test 1b - Cambridge</a></li>
				<li><a href="#cottrell3">Test 2 - Harvard</a></li>
			</ul>
			
			<ul class="tabs-content">
				<li class="active" id="cottrell1">
					<?php cottrell1(); ?>
				</li> <!-- #cottrell1 -->
				<li id="cottrell2">
					<?php cottrell2(); ?>
				</li> <!-- #cottrell2 -->
				<li id="cottrell3">
					<?php cottrell3(); ?>
				</li> <!-- #cottrell3 -->
			</ul>
		</div>

	</div><!-- container -->



	<!-- JS
	================================================== -->
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="javascripts/tabs.js"></script>

<!-- End Document
================================================== -->
</body>
</html>