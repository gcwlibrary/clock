<?php
	include ("kint/Kint.class.php");
	
	$root = "http://clock.lncd.org/comparemydata";
	//$root = "http://localhost/comparemydata";
	
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
	
	function translate($uri,$a_trans_file){
		//1. Load translate file
		//	- Stored as a 2D array in $translator
		//	- First row should always contain a pointer to the root (clock_root) of the documents with the followin rules
		//		- #URI = the URI of the data
		//		- #NONE = no root
		//		- Anything else, pointer in the array, pipe delimited
		//	- Second row is an offset pointer (clock_root_offset) in case the root is just off, as in Harvard
		//		- #NONE = no offset
		//		- Anything else, the offset number

		$trans_file = fopen("translations/".$a_trans_file, "r");
		
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
		
		//var_dump($local_record); //#DEBUG
		
		return($local_record);
	}
	
?>