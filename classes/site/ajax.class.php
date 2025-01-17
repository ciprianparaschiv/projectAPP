<?php
//#########################################################################//
//# Advanced Module Pattern
//#
//# Author: Strajeru Marius (E-mail: tzyganu@yahoo.com)
//# Date: 06.04.2008
//#########################################################################//



class ajax
{
	function ajax($action="")
	{
		switch ($action)
		{
			case "checkemail":
				$this->checkemail();
				break;
			default:
				$a = 0;
				break;
				
		}
	}
	
	function checkemail() {
	
		$email=_sqlEscValue($_GET['user_email']);
		$x=_sqlGetTableNoRows("user","user_email",$email);
		if($x>0) {
			echo 0;
		} else {
			echo 1;
		}
		return;
	}
	
	function subscribe() {
		global $smarty;
		$email=$_GET['email'];
		$name=$_GET['name'];
		if(!$name) $name=$email;
		if(is_valid_email($email)){
			$x=_sqlGetTableNoRows("newsletter_users","newsletter_users_email",$email);
			if($x<>0){
				if($_SESSION['lang'] == 'en') {
					echo "This email is already subscribed";
				} else {
					echo "Emailul specificat este deja abonat la  newsletter";
				}
			} else {
							$q="INSERT INTO
								newsletter_users
							SET
								newsletter_groups_id = 1,
								newsletter_users_name='$name', 
								newsletter_users_email='$email', 
								newsletter_users_active = 1
							";
							_sqlQuery($q);
					if($_SESSION['lang'] == 'en') {
						echo "You are now subscribed to our newsletter!";
					} else {
						echo "Abonarea la newsletter a reusit!";
					}
				}		
		} else {
			if($_SESSION['lang'] == 'en')
				echo "Type a valid e-mail address";
			else
				echo "Introduceti o adresa de e-mail valida";
			exit;
		}
	}
}