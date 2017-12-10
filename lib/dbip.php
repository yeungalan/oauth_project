<?php

function geoip($dbipcsv, $ip){

$csvData = file_get_contents("/lib/".$dbipcsv);
$lines = explode(PHP_EOL, $csvData);
$rangeArray = array();
foreach ($lines as $line) {
    $rangeArray[] = str_getcsv($line);
}

$input = $ip;
$array_input = explode(".", $input);

foreach($rangeArray as $current)
{
$array_start = explode(".", $current['0']);
$array_stop = explode(".", $current['1']);

if((int)$array_input[0] >= (int)$array_start[0]){
	if((int)$array_input[0] <= (int)$array_stop[0]){
		if((int)$array_input[1] >= (int)$array_start[1]){
			if((int)$array_input[1] <= (int)$array_stop[1]){
				if((int)$array_input[2] >= (int)$array_start[2]){
					if((int)$array_input[2] <= (int)$array_stop[2]){
						if((int)$array_input[3] >= (int)$array_start[3]){
							if((int)$array_input[3] <= (int)$array_stop[3]){
								$data = $current[2];
							}
						}
					}
				}
			}
		}
	}
}	
	

}

	return $data;
}

?>