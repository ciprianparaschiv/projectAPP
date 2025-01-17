<?php

function smarty_modifier_pre($string)
{
	$string=preg_replace('!^(\t)!m',"&nbsp;&nbsp;&nbsp;&nbsp;",$string);
    return preg_replace('!^(\s)!m',"&nbsp;&nbsp;",$string);
}

?>
