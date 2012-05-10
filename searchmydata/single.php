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
	<title>Single item view</title>
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
			<h3>Single</h3>
			<?php
			/*This is a rough and ready proof of concept to take data from the cambridge endpoint.*/

			include( "sparqllib.php" );

			$query = "SELECT * WHERE { '".$_GET["uri"]."' ?p ?o . }";

			/*$query = 'SELECT * WHERE {
				?s <http://purl.org/dc/terms/title> "Annual report" .
				?s <http://purl.org/dc/terms/creator> <http://data.lib.cam.ac.uk/id/entity/cambrdgedb_6db47ed8462b441136702548d9170484>
				}';*/
				
			/*$query = 'SELECT * WHERE { "http://data.lib.cam.ac.uk/id/entry/cambrdgedb_1043422" ?p ?o . }';*/

			$db = sparql_connect( "http://data.lib.cam.ac.uk/endpoint.php" );
			if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );

			$sparql = $query;
			$result = sparql_query( $sparql ); 
			if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

			$fields = sparql_field_array( $result );

			print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
			print "<table class='example_table'>";
			print "<tr>";
			foreach( $fields as $field )
			{
				print "<th>$field</th>";
			}
			print "</tr>";
			while( $row = sparql_fetch_array( $result ) )
			{
				print "<tr>";
				foreach( $fields as $field )
				{
					echo "<td>$row[$field]</td>";
				}
				print "</tr>";
			}
			print "</table>"; ?>
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