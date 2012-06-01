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
			<h3>About</h3>
			<p>COMPAREmyDATA is a prototpe app which takes a number of URI's pointing at the same piece of data in different bibliographic datastores, compares them and identifies any similarities and differences.</p>
			<p>The key working part of this app is, at present, the Universal JSON Translator, which works to convert data from each of the URI's into a usable format.</p>
			<p>For the purpose of this prototype, we're using fixed URI's, referencing Watchmen by Alan Moore. Format is JSON. The URI's are:</p>
			<ul>
				<li><a href="http://data.lib.cam.ac.uk/id/entry/cambrdgedb_4741140.json">http://data.lib.cam.ac.uk/id/entry/cambrdgedb_4741140.json (Cambridge)</a></li>
				<li><a href="http://api.dp.la/v0.03/item/0EF862E2-4F73-1F0C-57BB-371DA1876AD7">http://api.dp.la/v0.03/item/0EF862E2-4F73-1F0C-57BB-371DA1876AD7 (Harvard)</a></li>
				<li><a href="http://openlibrary.org/books/OL15479330M.json">http://openlibrary.org/books/OL15479330M.json (OpenLibrary)</a></li>
			</ul>
			<p>We're taking the data from these URI's and running it through a universal translator to give us a standrd array structure that we can work with.</p>
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