<?php

function smarty_modifier_time_format($stamp, $format="%H-%M", $default_date=null)
{
    $m=floor($stamp/60);
	$h=floor($m/60);		
	$m=str_pad($m-($h*60),2,'0',STR_PAD_LEFT);
	$h=str_pad($h,2,'0',STR_PAD_LEFT);
	$ret=str_replace('%H',$h,$format);
	$ret=str_replace('%M',$m,$ret);
	return($ret);
}

/* vim: set expandtab: */

?>
