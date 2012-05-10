<?php
	$root = "http://localhost/searchmydata";
	
	function the_menu(){
		global $root;
		
		$menu = '<ul class="tabs">
					<li><a href="'.$root.'">Home</a></li>
					<li><a href="'.$root.'/about.php">About</a></li>
					<li><a href="'.$root.'/cottrell.php">Cottrell Test</a></li>
					<li><a href="'.$root.'/cottrell2.php">Cottrell Test 2</a></li>	
					<li><a href="'.$root.'/cottrell3.php">Cottrell Test 3</a></li>	
					<li><a href="'.$root.'/cottrell4.php">Cottrell Test 4</a></li>						
				</ul>';
		
		echo $menu;
	}
	
	function the_version(){
		echo "0";
	}
	
	function the_form(){
		global $root;
		
		$form = '<h3>Search criteria</h3>
				<form name="s" action="'.$root.'/search.php" method="post">
				<label for="s_title">Title</label>
				<input type="text" name="s_title" id="s_title" />
				
				<label for="s_surname">Author</label>
				<input type="text" name="s_surname" id="s_surname" />
				
				<label for="s_limit">Limit</label>
				<select name="s_limit" id="s_limit">
					<option value="1">1</option>
					<option value="10">10</option>
					<option value="20">20</option>
				</select>
				
				<input type="submit" id="s_submit" name="s_submit" value="Go!" />';
		
		echo $form;
	}


?>