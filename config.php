<?php
	define("ROOT_DIR", substr_replace(dirname(__FILE__), '/', strlen(dirname(__FILE__))));
	define("ROOT_HOST", "https://".$_SERVER['HTTP_HOST'].''.str_replace('\\','/',dirname($_SERVER['SCRIPT_NAME']).((dirname($_SERVER['SCRIPT_NAME'])=='/' || dirname($_SERVER['SCRIPT_NAME'])=='\\' )?'':"/")));

	define("FILE_DIR", ROOT_DIR."files/");
	define("LIB_DIR", ROOT_DIR."lib/");
	define("SMARTY_DIR", LIB_DIR."smarty/");
	define("COMPONENT_DIR", ROOT_DIR."classes/");
	define("TEMPLATES_DIR", ROOT_DIR."templates/");
	define("COMPILE_DIR", ROOT_DIR."tmp/");
	//define("CACHE_DIR", COMPILE_DIR."cache/");
	define("CACHE_DIR", "z:/cache/");
	define("CACHING", false);
	define("DEBUG", "0");


	define("CLASS_NAME", "class");// Get param  for class name
	define("METHOD_NAME", "method"); // Ger param for method name
	define("DEFAULT_FRONT_CLASS_NAME", "front"); //default front class name
	define("DEFAULT_FRONT_METHOD_NAME", "home"); // default front method

if ($_SERVER['HTTP_HOST']=='www.macsim.ro') {
	define("DB_HOST",'localhost');
	define("DB_USER",'max');
	define("DB_PASSWORD",'sunflower');
	define("DB_NAME",'obproject');
} else {
	define("DB_HOST",'localhost');
	
	define("DB_USER",'official_project_new');
	define("DB_PASSWORD",'t$wz2Y?,iO=[');
	define("DB_NAME",'official_project_new');
	/*
	define("DB_USER",'official_project');
	define("DB_PASSWORD",'obproject');
	define("DB_NAME",'official_project');
	*/
}
	define("PROJECT_TYPE_PBASED",1);
	define("PROJECT_TYPE_HBASED",2);
	define("PROJECT_TYPE_DEFINED",3);
	$project_ttypes=array (
		PROJECT_TYPE_PBASED=>array(
			'name'=>'Project Based',
			'hourly'=>'0',
			'need_price'=>'1'
		),
		PROJECT_TYPE_HBASED=>array(
			'name'=>'Hourly Rate',
			'hourly'=>'1',
			'need_price'=>'1'
		),
		PROJECT_TYPE_DEFINED=>array(
			'name'=>'Project Defined',
			'hourly'=>'0',
			'need_price'=>'0'
		)
	);

	$project_wtypes=array (
		1=>"SEO",
		2=>"WEB DESIGN",
		3=>"SOCIAL MEDIA",
		4=>"PPC",
		5=>"MARKETING",
                6=>"US"
	);

	/*
	$project_priorities=array (
		1=>"LOW",
		2=>"NORMAL",
		3=>"HIGH"
	);
	*/

		$project_priorities=array (
		1=>"FREE",
		2=>"MEDIUM",
		3=>"HIGH",
		4=>"IMPORTANT",
		5=>"URGENT"
	);


	define("PS_PENDING",1);
	define("PS_WORKING",2);
	define("PS_COMPLETED",3);

	$project_phases=array(
		PS_PENDING=>"Pending",
		PS_WORKING=>"Working",
		PS_COMPLETED=>"Completed"
	);

	define('MT_STANDARD',1);
	define('MT_STATUSCHANGED',2);
	define('MT_PROJECT_ADDED',3);
	define('MT_USER_ADDED',4);
	define('MT_USER_REMOVED',5);
	define('MT_FILE_ADDED',6);
	define('MT_WORK_STARTED',7);
	define('MT_WORK_STOPPED',8);
	define('MT_PROJECT_DELETED',9);
	define('MT_WORK_CHANGED',10); // modified a timing

?>
