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
			<h1 class="remove-bottom" style="margin-top: 40px">SEARCHmyDATA</h1>
			<h5>Version <?php the_version();?></h5>
			<br />
			<?php the_menu(); ?>
		</div>
		<div class="one-third column">
			<?php the_form(); ?>
		</div>
		<div class="two-thirds column">
			<h3>Cottrell 3 - Harvard JSON test</h3>
			<p>A little test to grab some data from the Harvard JSON API. Tested for an author keyword AND a titlekeyword, limit 20.</p>
			<?php
				$json = file_get_contents("http://api.dp.la/v0.03/item/?filter=dpla.creator_keyword:cottrell&filter=dpla.title_keyword:ann&limit=20");
				$json_a=json_decode($json,true);
				
				echo "<table class='example_table'>";
				echo "	<tr>";
				echo "		<th>Title</th>";
				echo "		<th>Author(s)</th>";
				echo "	</tr>";
				
				foreach($json_a['docs'] as $document) :
					echo "<tr>";
					
					//Title
					
					echo "<td>".$document['dpla.title']."</td>";
					
					//Authors
					$creator_counter = 0;
					
					$all_authors = false;
					
					echo "<td>";
					
					do {
						if (array_key_exists($creator_counter, $document['dpla.creator'])) :
							if ($creator_counter == 0) :
								echo $document['dpla.creator'][$creator_counter];
							else :
								echo ", ".$document['dpla.creator'][$creator_counter];
							endif;
							$creator_counter++;
						else :
							$all_authors = true;
						endif;
					} while ($all_authors == false);
					
					echo "</td>";
					echo "</tr>";
				endforeach;
				
				/*$jsonIterator = new RecursiveIteratorIterator(
					new RecursiveArrayIterator(json_decode($json, TRUE)),
					RecursiveIteratorIterator::SELF_FIRST);

				foreach ($jsonIterator as $key => $val) {
					if(is_array($val)) {
						echo "<strong>$key:</strong><br />";
					} else {
						echo "$key => $val<br />";
					}
				}*/
			?>
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