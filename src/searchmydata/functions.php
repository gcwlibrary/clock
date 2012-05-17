<?php
	$root = "http://clock.lncd.org/searchmydata";
	
	function the_menu(){
		global $root;
		
		$menu = '<ul class="tabs">
					<li><a href="'.$root.'">Home</a></li>
					<li><a href="'.$root.'/about.php">About</a></li>
					<li><a href="'.$root.'/tests.php">Tests</a></li>				
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

/*Test functions*/

	function cottrell1(){
		echo "<p>Search on author='Cottrell'</p>";
		$query = ' SELECT ?s ?p ?who WHERE {
					?s <http://purl.org/dc/terms/title> ?p .
					?s <http://purl.org/dc/terms/creator> ?sc .
					?sc <http://www.w3.org/2000/01/rdf-schema#label> ?who .
					FILTER regex(?who, "Cottrell", "i")
					} 
					LIMIT 20';

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

		echo "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
		echo "<table class='example_table'>";
		echo "<tr>";
		foreach( $fields as $field )
		{
			if( $field != "s" ):
				echo "<th>$field</th>";
			endif;
		}
		echo "</tr>";
		while( $row = sparql_fetch_array( $result ) )
		{
			echo "<tr>";
			foreach( $fields as $field )
			{
				if( $field == "s" ) :
					echo '<td><a href="'.$row[$field].'" target="_blank">';
				elseif ( $field == "p" ) :
					echo $row[$field].'</a></td>';
				else :
					echo "<td>by $row[$field]</td>";
				endif;
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	
	function cottrell2(){
		echo "<p>Search on author='Cottrell' and title='Ann'</p>";
		
		$query = '  SELECT ?s ?title ?who WHERE {
					?s <http://purl.org/dc/terms/title> ?title .
					?s <http://purl.org/dc/terms/creator> ?sc .
					?sc <http://www.w3.org/2000/01/rdf-schema#label> ?who .
					FILTER regex(?title, "Ann", "i").
					FILTER regex(?who, "Cottrell", "i")
					} 
					LIMIT 20';

		/*$query = 'SELECT * WHERE {
			?s <http://purl.org/dc/terms/title> "Annual report" .
			?s <http://purl.org/dc/terms/creator> <http://data.lib.cam.ac.uk/id/entity/cambrdgedb_6db47ed8462b441136702548d9170484>
			}';*/
			
		/*$query = 'SELECT * WHERE { "http://data.lib.cam.ac.uk/id/entry/cambrdgedb_1043422" ?p ?o . }';*/

		$db = sparql_connect( "http://data.lib.cam.ac.uk/endpoint.php" );
		if( !$db ) { echo sparql_errno() . ": " . sparql_error(). "\n"; exit; }
		sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );

		$sparql = $query;
		$result = sparql_query( $sparql ); 
		if( !$result ) { echo sparql_errno() . ": " . sparql_error(). "\n"; exit; }

		$fields = sparql_field_array( $result );

		echo "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
		echo "<table class='example_table'>";
		echo "<tr>";
		foreach( $fields as $field )
		{
			if( $field != "s" ):
				echo "<th>$field</th>";
			endif;
		}
		echo "</tr>";
		while( $row = sparql_fetch_array( $result ) )
		{
			echo "<tr>";
			foreach( $fields as $field )
			{
				if( $field == "s" ) :
					echo '<td><a href="'.$row[$field].'" target="_blank">';
				elseif ( $field == "title" ) :
					echo $row[$field].'</a></td>';
				else :
					echo "<td>by $row[$field]</td>";
				endif;
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	
	function cottrell3(){
		echo "<p>Search for Author='Cottrell'. The Harvard API does not seem to support multiple terms on all search terms and documentation is not so detailed.</p>";
	
		$json = file_get_contents("http://api.dp.la/v0.03/item/?filter=dpla.creator_keyword:cottrell&limit=20");
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
	}
	
?>