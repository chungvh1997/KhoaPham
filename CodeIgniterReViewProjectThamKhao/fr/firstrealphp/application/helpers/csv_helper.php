<?php 
	function parse_file($p_Filepath , $table)
	{
		$fields = array();            /** columns names retrieved after parsing */ 
		$separator  =   ';';    /** separator used to explode each line */
		$enclosure  =   '"';    /** enclosure used to decorate each field */
		$max_row_size   =   4096;    /** maximum row size to be used for decoding */
		$file         = fopen($p_Filepath, 'r');
		$fields = fgetcsv($file, $max_row_size, $separator, $enclosure);
		$fields  = explode(',', $fields[0]);
		$thead = resultfiled($fields,$table['name']);
		$tbody      = array();
		$keys         = $thead['success'];
		$type = $table['type'];
		$i            = 1;
		while (($row = fgetcsv($file, $max_row_size, $separator, $enclosure)) != false) {
			if ($row != NULL) {
				$values = explode(',', $row[0]);
				//if ((count($thead['success']) + count($thead['failure'])) == count($values)) {
					$arr        = array();
					$new_values = array();
					$new_values = escape_string($values);
					for ($j = 0; $j < count($keys); $j++) {
						if ($keys[$j] != "") {
							if ($new_values[$j] != '') {
								switch ($type[$keys[$j]]) {
									case 'int':
										$arr[$keys[$j]] = intval($new_values[$j]);
										break;
									case 'double':
										$arr[$keys[$j]] = floatval($new_values[$j]);
										break;
									default:
										$arr[$keys[$j]] = $new_values[$j];
										break;
								}
							}
						}
					}
					if (!empty($arr)) {
						array_push($tbody,$arr);
					}
					$i++;
				//}
			}
		}
		fclose($file);
		$data = array('thead' => $thead,'tbody' => $tbody);
		return $data;
	}
	function resultfiled($fields , $keys){
		$fields = escape_string($fields);
		$success = array();
		$failure = array();
		foreach($fields as $field){
			$f = strtolower($field);
			if(in_array($f, $keys)){
				array_push($success , $f);
			}else{
				array_push($failure , $f);
			}
		}
		return array('success' => $success , 'failure' => $failure);
	}

	function escape_string($data)
	{
		$result = array();
		foreach ($data as $row) {
			$result[] = str_replace('"', '', $row);
		}
		return $result;
	}
?>