<?php
	include ("kint/Kint.class.php");
	
	//$root = "http://clock.lncd.org/comparemydata";
	$root = "http://localhost/clock/src/buildmydata";
	
	function the_menu(){
		global $root;
		
		$menu = '<ul class="tabs">
					<li><a href="'.$root.'">Home</a></li>
					<li><a href="'.$root.'/build.php">Build</a></li>
					<li><a href="'.$root.'">CLOCK</a></li>			
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
		//		- Anything else, pointer in the array
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
				//Step through the values within the current record value
				//Is value an array?
				//	- If yes, we need to break this down and only write the value back
				//	- If not, write the value
				if( is_array($record[$trans[0]]) ) :
					foreach( $record[$trans[0]] as $index => $value ) :
						//echo "index => ".$index." | value => ".$value."<br />"; //#DEBUG
						if( is_array($value) ) :
							foreach( $value as $index_a => $value_a ) :
								//echo "index => ".$index_a." | value => ".$value_a."<br />"; //#DEBUG
								if( $index_a === "type" ) :
									//echo "SKIPIT<br />"; //#DEBUG
								else :									
									$local_record[$trans[1]][] = $value_a;
								endif;
							endforeach;
						else :
							//echo $index; #DEBUG
							//var_dump(is_null($index)); //#DEBUG
							if( $index === "type" ) :
								//echo "SKIPIT<br />"; //#DEBUG
							else :							
								$local_record[$trans[1]][] = $value;
							endif;
						endif;
						//echo $index." ".$value;
					endforeach;
				else :
					$local_record[$trans[1]][] = $record[$trans[0]];
				endif;
				//$local_record[$trans[1]][] = $record[$trans[0]]; //#DEBUG
			endif;
		endforeach;
		
		//var_dump($local_record); //#DEBUG
		
		return($local_record);
	}
	
	function compare( $elements, $default ){
		//Read each source into an array
		//These are stored in sources.csv, representing:
		//	{translator file},{uri}
		//Long term, these will be derived from our index database
		$source_file = fopen( "sources.csv", "r" );
		
		while (( $data = fgetcsv($source_file, 1000, ",")) !== FALSE ) {
			$sources[] = $data;
		}
		
		fclose($source_file);
		
		//d($sources); //#DEBUG
		foreach( $sources as $source ) :
			$trans_file = $source[0].".csv";
			$bibs[$source[0]] = translate( $source[1],$trans_file ); //Translating all of our data from our sources
		endforeach;
		//d($bibs); //#DEBUG
		
		$output = '<form action="build.php" method="post">';
		$output .= '<input type="hidden" name="records" value="yes" />';
		$output .= '<ul class="compared">'; //Set up our blank output
		
		//For each element
		foreach( $elements as $element ) :
		//	1. Add the default source to the output
			$output .= "<li>";
			$output .= "<h5>" . $element . "</h5>";
			
			foreach( $bibs[$default][$element] as $the_default ) :
				$output .= "<input type='checkbox' name='". $element ."[]' value='". $the_default ."' checked /> ". $the_default ."<br />";
			endforeach;
			
			
						
		//	2. For each source not default
		//		2a. Compare element to default
		
			foreach( $sources as $source ) :
				if ( $source[0] != $default ) : //If this isn't the default source
					//echo $source[0]; #DEBUG
					///echo $element; #DEBUG
					foreach( $bibs[$source[0]][$element] as $the_element ) :
						if( in_array( $the_element, $bibs[$default][$element] ) ) :
							//Do nothing
						else :
		//		2b. Add element to output if different
							$output .= '<span class="diff"><input type="checkbox" name="'. $element .'[]" value="'. $the_element .'" /> <strong>' . $source[2] . ' says -> </strong>' . $the_element . '<br /></span>';
						endif;
					endforeach;
				endif;
			endforeach;
			
			$output .= "</li>";
			
		endforeach;
		
		$output .= "</ul>";
		$output .= '<input type="submit" value="Go!" />';
		$output .= "</form>";
		
		return $output;
	}
?>