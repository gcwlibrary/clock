<?php
	//$root = "http://clock.lncd.org/searchmydata";
	$root = "http://localhost/comparemydata";
	
	function the_menu(){
		global $root;
		
		$menu = '<ul class="tabs">
					<li><a href="'.$root.'">Home</a></li>
					<li><a href="'.$root.'/translate-cambs.php">Cambridge Translation (TEST)</a></li>
					<li><a href="'.$root.'/translate-harvard.php">Harvard Translation (TEST)</a></li>
					<li><a href="'.$root.'/translate-olib.php">Open Library Translation (TEST)</a></li>
					<li><a href="'.$root.'/compare.php">Compare!</a></li>			
				</ul>';
		
		echo $menu;
	}
	
	function the_version(){
		echo "0";
	}
	
?>