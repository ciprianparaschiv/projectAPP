<?php

function initSite() {

	
}

if (get_magic_quotes_gpc()) {
   function stripslashes_deep($value) { 
 	$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
   	return $value; 
   } 
   $_POST = array_map('stripslashes_deep', $_POST);
   $_GET = array_map('stripslashes_deep', $_GET);
   $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}



function redirect($url='') {
	
	if(!$url) {
		header('Location: ' . ROOT_HOST);
	} else {
		header('Location: ' . $url);
	}
	exit();
	
}

function hm($stamp) {
	
	$m=floor($stamp/60);
	$h=floor($m/60);		
	$m=str_pad($m-($h*60),2,'0',STR_PAD_LEFT);
	$h=str_pad($h,2,'0',STR_PAD_LEFT);
	return "$h:$m";
}

function getUniqueId($base=36) {

	$t=uniqid();
	return base_convert($t,16,$base);
	
}
setlocale ( LC_CTYPE, 'C' );

function reverseDate($date) {
	$d=explode('-',$date);
	$date=$d[2].'-'.$d[1].'-'.$d[0];
	return $date;
}

function prepareTableFields($fields,$farray)
{
	if(count($fields)>0)
	{
    	$q_tmp = "";
    	foreach($fields as $k=>$filedName)
    	{
    		$filedValue = _sqlEscValue(isset($farray[$filedName]) ? $farray[$filedName]:'');
    		$q_tmp .= "$filedName = '$filedValue',";
    	}
    	$q_tmp = substr($q_tmp, 0, strlen($q_tmp)-1);
    	
    	return $q_tmp;
	} 
}

function file_get_csv ($file) {
        $array=array();
        $fh=fopen($file, 'r');
		$header=fgetcsv($fh);
        while (($data = fgetcsv($fh)) !== FALSE) {
                $array[]=array_combine($header,$data);
        }
        fclose($fh);
        return $array;
}


function generateSlug($phrase,$short=1)
{
    

		$result = strtolower($phrase);
		$result = preg_replace("/[^a-z0-9\s-_]/", "", $result);
		$result = trim(preg_replace("/\s+/", " ", $result));
		if($short) $result = trim(substr($result, 0, 45));
		$result = preg_replace("/\s/", "-", $result);

    return $result;
}
	
?>