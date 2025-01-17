<?php
set_time_limit(300);error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", "on");
session_start();
date_default_timezone_set('Europe/Bucharest');
require_once "config.php";

require_once "functions.php";

//===> ENGINE TEMPLATE INITIALISATION
require(SMARTY_DIR."Smarty.class.php");
$smarty = new Smarty;
$smarty->autoload_filters = array('pre' => array('trimwhitespace'));
$smarty->template_dir = TEMPLATES_DIR;
$smarty->compile_dir = COMPILE_DIR;
$smarty->config_dir = TEMPLATES_DIR."configs/";
$smarty->debugging = false;
$smarty->cache_dir = CACHE_DIR;
$smarty->caching = CACHING;
//<===


require_once(LIB_DIR."db/db.lib.php");
require_once(LIB_DIR."/db/db.inc.php");
$db=new DB(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db->open();

//mysql_query("SET NAMES 'UTF8'");  

initSite();


if(!isset($_GET[CLASS_NAME])) $_GET[CLASS_NAME] = DEFAULT_FRONT_CLASS_NAME;
if(!isset($_GET[METHOD_NAME])) $_GET[METHOD_NAME] = DEFAULT_FRONT_METHOD_NAME;

if(file_exists(COMPONENT_DIR.'site/'.$_GET[CLASS_NAME].".class.php"))
{
	include_once COMPONENT_DIR.'site/'.$_GET[CLASS_NAME].".class.php";
		
	//echo $_GET[CLASS_NAME];
	if($_GET[CLASS_NAME] != "")
		$obj = new $_GET[CLASS_NAME]($_GET[METHOD_NAME]);
	else 
		$obj = new $_GET[CLASS_NAME];
}
?>