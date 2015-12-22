
<?php
	function id_to_name($table,$field,$id,$output_name) 
	{
		$db = mysql_query("SELECT * FROM ".$table." WHERE ".$field."='".$id."' LIMIT 1");
		while($db=mysql_fetch_array($db)) {
			return $db[$output_name];
		}
	}
	?>