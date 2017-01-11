<?php
	function convert_date($time){
		//error("This happens");
		if(gettype($time)=="string"){
			$time = intval($time);
		}
		return date("M d y, G:i:s", $time);
	}
	
	function maketable($result, $fields){
		$num_papers = mysqli_num_rows($result);
		if($num_papers!=0){
			echo("<table class='papersTable'>");
			//var_dump($fields);
			//$fields = ["name", "filename", "author", "subject", "time"];
			echo("<tr>");
			for($i=0; $i<count($fields); $i++){
				echo("<th>");
				echo($fields[$i]);
				echo("</th>");
			}
			echo("</tr>");
			for($i=0; $i<$num_papers; $i++){
				$row = mysqli_fetch_assoc($result);
				echo("<tr>");
				foreach($fields as $key){
					$val = $row[$key];
					if(!in_array($key, $fields)){
						continue;
					}
					if($key=="filename"){
						$val = "<a href='../papers/$val'>$val</a>";
                        $val = substr($val, 0, strrpos($val, '_'));
					}
					echo("<td style= 'padding: 0px 10px;'>$val</td>");
				}unset($val);
				echo("</tr>");								
				//var_dump($rows[$i]);
			}
			echo("</table>");
		}
	}
?>
