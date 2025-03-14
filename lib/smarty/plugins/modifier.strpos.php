<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty strpos modifier plugin
 *
 * Type:     modifier<br>
 * Name:     strpos<br>
 * Purpose:  strpos in smarty
 */
function smarty_modifier_strpos($haystack, $needle)
{
    return strpos($haystack, $needle);
}

/* vim: set expandtab: */

?>
