<?php

if(!isset($_GET['access']) || empty($_GET['access']) || $_GET['access']!="56yh1f9") { die(); exit(0);} 

$servername = "localhost";
$username = "official_project";
$password = "obproject";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname = "official_project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql="SELECT * FROM user where user_active=1 and user_deleted=0";
$result = $conn->query($sql);

 while($row = $result->fetch_assoc()) {
   echo '<b><a href="user.php?id='.$row["user_id"].'&access=56yh1f9">'.$row['user_name'].'</a></b><br>';
   $spro="SELECT * from project p,timing t where project_deleted=0 and project_id=timing_project and timing_user='".$row['user_id']."' and project_status=2 group by project_id order by p.project_priority desc";
   $result_spro= $conn->query($spro);
   echo '<ul>';

   while($row_spro = $result_spro->fetch_assoc()) {
      echo '<li><a href="http://www.officialbranding.org/project/project/'.$row_spro["project_id"].'/">'.$row_spro['project_name'].' '.$row_spro['project_priority'].'</a></li>';
   }
    echo '</ul><br><br>';
 }


?>
