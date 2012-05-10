<?php
			$form = '<form name="s" action="search.php" method="post">
				<label for="s_surname">Surname</label>
				<input type="text" name="s_surname" id="s_surname" />
				
				<label for="s_limit">Limit</label>
				<select name="s_limit" id="s_limit">
					<option value="1">1</option>
					<option value="10">10</option>
					<option value="20">20</option>
				</select>
				
				<input type="submit" id="s_submit" name="s_submit" value="Go!" />
			</form>';
?>