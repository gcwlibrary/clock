<?php
	//$root = "http://clock.lncd.org/searchmydata";
	$root = "http://localhost/comparemydata";
	
	function the_menu(){
		global $root;
		
		$menu = '<ul class="tabs">
					<li><a href="'.$root.'">Home</a></li>
					<li><a href="'.$root.'/compare.php">Compare!</a></li>			
				</ul>';
		
		echo $menu;
	}
	
	function the_version(){
		echo "0";
	}
	
?>