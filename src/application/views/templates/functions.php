<?php
	include ("kint/Kint.class.php");
	
	function the_menu(){		
		$menu = '<ul class="tabs">
					<li><a href="'. base_url() .'">Home</a></li>
					<li><a href="http://clock.blogs.lincoln.ac.uk">Blogs</a></li>
					<li><a href="http://clock.blogs.lincoln.ac.uk/2012/04/23/clock-project-implementation-plan/">Implementation Plan</a></li>
				</ul>';
		
		echo $menu;
	}
	
	function the_version(){
		echo "0";
	}
	
	function the_side_menu(){
		$menu = '<h3>Prototypes</h3>
				<ul>
					<li><a href="'. base_url() .'sparqlmydata">SPARQLmyDATA</a></li>	
					<li><a href="'. base_url() .'comparemydata">COMPAREmyDATA</a></li>	
				</ul>';
		
		echo $menu;
	}	
?>