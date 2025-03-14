<?php
	class front {
	
		function front($action="") {
			global $smarty,$project_ttypes,$project_phases,$project_priorities,$project_wtypes;
			$q=$_GET['q'];
			$ar=explode('/',$q);
			
			$action=$ar[0];
			$this->rewrite_params=$ar;
			
			$smarty->assign("PROJECT_TYPES",$project_ttypes);
			$smarty->assign("PROJECT_WTYPES",$project_wtypes);
			$smarty->assign("project_phases",$project_phases);
			$smarty->assign("project_priorities",$project_priorities);
			
			if(!$_SESSION['auth']['user_id']) {
				$action='login';
			}
			
			$this->uid=$_SESSION['auth']['user_id'];
			$this->auth=$_SESSION['auth'];
			$this->admin=$_SESSION['auth']['user_admin'];
			$this->subadmin=$_SESSION['auth']['user_subadmin'];
			$smarty->assign("auth",$this->auth);
			
			//check for timings opened
			if($this->uid) {
				$q="select * from timing,project where timing_open=1 and project_id=timing_project and timing_user='{$this->uid}'";
				$res=_sqlQuery($q);
				//we have oppened work
				if(mysql_num_rows($res)) {
					//fetch timing data;
					$row=mysql_fetch_assoc($res);
					$row['efective']=$row['timing_end']-$row['timing_start'];
					$working=$row;
					
				}			
			}
			/* */
			
			/* check for expired timing */			
			if($working) {
				$now=time();
				$delta=$now-$working['timing_end'];
				if($this->rewrite_params[0]=='check_timing') {
					$working['delta']=$delta;
					$working['full']=$now-$working['timing_start'];					
					$smarty->assign('tworking',$working);
					$smarty->assign('stopinterval',1);
					if($_POST) {
						$id=$working['project_id'];
						if($_POST['efective']) {
							$q="UPDATE timing set timing_open=0 where timing_id=".$working["timing_id"];	
							$txt="Ended work";
							$this->logEvent(MT_WORK_STOPPED,$id,$txt);
						}
						if($_POST['full']) {
							$q="UPDATE timing set timing_end=$now,timing_open=0 where timing_id=".$working["timing_id"];
							$txt="Ended work";
							$this->logEvent(MT_WORK_STOPPED,$id,$txt);
						}
						if($_POST['continue']) {
							$q="UPDATE timing set timing_end=$now where timing_id=".$working["timing_id"];
							
						}
						_sqlQuery($q);
						
						redirect(ROOT_HOST."/project/".$working['project_id']);
					}
					
					$smarty->display("checktiming.tpl");
					exit();
				} else {					
					$smarty->assign('working',$row);
				}
				
				if($delta>300) {
					if(!$_GET['working']) {
						redirect(ROOT_HOST."/check_timing/");
					}
				}															
			}
			
			
			
			/* AJAX REQUEST */
			if($_GET['working']) {
				$data=array();
				if($working) {
					//update shits
					
					$delta=$now-$working['timing_end'];					
					if($delta>300) {
						$data['redirect']=ROOT_HOST."/check_timing/";
					} else {
						$q="UPDATE timing set timing_end=$now where timing_id=".$working["timing_id"];
						_sqlQuery($q);
					}
					
					$data["html"]=$smarty->fetch("inc/working.tpl");
					$data["hide"]=0;
					$data["working"]=1;
				} else {
					$data["html"]="";
					$data["hide"]=1;
					$data["working"]=0;
				}
				$json=json_encode($data);
				echo $json;
				exit();
			}
			/* END AJAX REQUEST*/
			
			if($_SESSION['auth']['user_admin'] || $_SESSION['auth']['user_subadmin'])																		
			{
				
					$treated=0;
				
					if($_SESSION['auth']['user_admin']) {
						switch ($action) {									
							case "users":
								$treated=1;
								$this->displayUsers();
							break;
							
							case "reports":
								$treated=1;
								$this->displayReports();
							break;	
						}					
					}
					
					if(!$treated) {
						switch ($action) {									
							case "myprojects":
								$this->displayMyProjects();						
							break;
							case "clients":
								$this->displayClients();
							break;
							case "projects":
								$this->displayProjects();
							break;
							case "project":
								$this->displayProject();
							break;					
							case "account":
								$this->displayAccount();
							break;
							case "logout":
								$this->displayLogout();
							break;
							case "login":
								$this->displayLogin();
							break;		
							case "home":											
							default:
								$this->displayHome();
							break;					
						}
					}
			
				
			}
			else {
			
				switch ($action) {
					case "myprojects":
						$this->displayMyProjects();						
					break;		
					case "project":
						$this->displayProject();
					break;										
					case "account":
						$this->displayAccount();
					break;
					case "logout":
						$this->displayLogout();
					break;
					case "login":
						$this->displayLogin();
					break;				
					case "home":	
					default:
						$this->displayHome();
					break;
				}
			}
			
			
			
		}
		
		function displayReports() {
			global $smarty,$project_wtypes;
			include(LIB_DIR.'/fpdf/report.php');
			
			$smarty->assign('active',"reports");
			$template="userreports";
			$report_type=$this->rewrite_params[1];
			
			if(!$report_type) $report_type='users';
				
			$q="SELECT *  from user where user_active=1  and user_deleted=0 order by user_name";
			$users=_sqlFetchResultRows($q,'user_id');
			$smarty->assign('users',$users);
				
			$q="SELECT c.client_id,c.client_name,cc.contractor_name,cc.contractor_id from client c,contractor cc where c.client_contractor=cc.contractor_id order by client_contractor,client_name";
			$clients=_sqlFetchResultRows($q,'client_id');								
			$smarty->assign('clients',$clients);
			
			$q="SELECT * from contractor order by contractor_name";			
			$contractors=_sqlFetchResultRows($q,'contractor_id');								
			$smarty->assign('contractors',$contractors);
			
			$q="SELECT * from ptype order by ptype_name";			
			$ptype=_sqlFetchResultRows($q,'ptype_id');								
			$smarty->assign('project_types',$ptype);
			
			if($report_type=='users') {					
					if($_POST) {
						$report=$_POST['report'];
					} else {
						$report=$_SESSION['user_report'];
					}
					if($report['start']=='') $report['start']=date("d-m-Y",strtotime("-1 Month"));
					if($report['stop']=='') $report['stop']=date("d-m-Y");
					$_SESSION['user_report']=$report;
					$smarty->assign('report',$report);
					if($_POST) {
						$dstart=reverseDate($report['start']);
						$dend=reverseDate($report['stop']);
						$dtstart=strtotime($dstart);
						$dtend=strtotime($dend. " +1 day");
						$q="SELECT project.*,sum(timing_end-timing_start)+1 as project_worked from project,timing where project_deleted=0 and  project_cdate between '$dtstart' and '$dtend' and project_status=".PS_COMPLETED." and project_id=timing_project and timing_user={$report['user']} {$q_tmp} group by timing_project";						
						$res=_sqlQuery($q);
						$total=0;
						while($row=mysql_fetch_assoc($res)) {
							$row['client']=$clients[$row['project_client']]['client_name'];
							if($row['project_ishourly']) {
								$row['price']=round($row['project_worked'] * $row['project_price'] /36)/100;
							} else {
								$q="select count(distinct(timing_user)) from timing where timing_project={$row['project_id']}";
								$rs2=_sqlQuery($q);
								$acnt=mysql_fetch_row($rs2);
								$cnt=$acnt[0];								
								$row['price']=$row['project_price'] * $row['project_count'] / $cnt;
							}
							$projects[]=$row;
							$total+=$row['price'];
						}
						$smarty->assign('total',$total);
						$smarty->assign('projects',$projects);
					if($_POST['submit']=='PDF') {
							$oreport=New Report();
							$header=array(
								0=>array('size'=>5,'name'=>'#','align'=>'R'),
								1=>array('size'=>60,'name'=>'Client','align'=>'L'),
								2=>array('size'=>61,'name'=>'Project','align'=>'L'),								
								3=>array('size'=>17,'name'=>'Date','align'=>'C'),
								4=>array('size'=>17,'name'=>'End','align'=>'C'),
								5=>array('size'=>10,'name'=>'Hours','align'=>'C'),
								6=>array('size'=>15,'name'=>'Price','align'=>'R'),
							);
							$i=0;
							foreach($projects as $project) {
								$i++;
								$rdata[]=array(
									$i,
									$clients[$project['project_client']]['client_name'],
									$project['project_name'],									
									date('d-m-Y',$project['project_date']),
									date('d-m-Y',$project['project_cdate']),
									($project['project_ishourly']?hm($project['project_worked']):"-"),
									$project['price'].'$'
								);
							}
							if(!$report[price]) {
								unset($header[6]);
								$total=-1;
							}
							$title="user_report_" . $users[$report['user']]['user_name'] . "{$report['start']}_{$report['stop']}";
							$oreport->setTitle("USER REPORT: " . $users[$report['user']]['user_name'] . " | Period: {$report['start']} - {$report['stop']}");
							$oreport->setFooter(" generated on " . date("d/m/Y H:i"));
							$oreport->AliasNbPages();
							$oreport->SetFont('Arial','',8);
							$oreport->AddPage();
							$oreport->FancyTable($header,$rdata,$total);
							$oreport->Output($title .".pdf","D");
							exit;
						}
					}
					
			} else {
				if($this->rewrite_params[2]=='saved') {
					$q="select * from report order by report_id desc";
					$reports=_sqlFetchResultRows($q,'report_id');	
					if($this->rewrite_params[3]) {						
						$template="savedreport";
						$rid=$this->rewrite_params[3];
						if($this->rewrite_params[4]=='delete') {
							$q="delete from report where report_id={$rid}";
							_sqlQuery($q);
							redirect(ROOT_HOST . "reports/client/saved/");	
						}
						$report=$reports[$this->rewrite_params[3]];
						$report['data']=unserialize(base64_decode($report['report_data']));
						$rdata=$report['data'];
						if($this->rewrite_params[4]=='getexcel') {
							$fileName=generateSlug($report['report_title']).".xls";
							header("Content-type: application/vnd.ms-excel");
							header("Content-Disposition: attachment; filename=$fileName"); 
							echo "<table border=1>";
							echo "<tr><td colspan='6'>{$report['report_title']}</td><td></td></tr>";
							
							echo "<tr >
								<td>#</td>
								<td>Client name</td>
								<td>Project name
								</td>
								<td>Type
								</td>
								<td>Project date
								</td>
								<td>Project completed
								</td>
								<td>Paid</td>				
								<td>Price</td></tr>";
							
							
							$cclient='';
							foreach($report['data'] as $data) {
								if(count($data)==1) { 
									$cclient=$data[0];
									continue;
								}
								unset($data[5]);
								unset($data[8]);
								if($data[7]) $data[7]=str_replace('$','',$data[7]);
								$cid=$data[0];
								unset($data[0]);
								$tdata=implode('</td><td>',$data);		
								
								echo "<tr><td>{$cid}</td><td>{$cclient}</td><td>{$tdata}</td></tr>";
							}
							echo "</table>";
							
							
							exit();
						}
						
						$projects=array();
						foreach($rdata as $data) {
							$pid=$data[8];
							if($pid)
								$projects[]=$pid;
						}
						$sprojects=implode(',',$projects);
						if($_POST) {
							$q="update report set report_paid=1 where report_id={$rid}";
							_sqlQuery($q);
							$q="update project set project_paid=1 where project_id in ({$sprojects})";
							_sqlQuery($q);
							redirect(ROOT_HOST . "reports/client/saved/");							
						} else {
							$q="select project_id,project_paid from project where project_id in ({$sprojects})";
							$report['projects']=_sqlFetchResultRows($q,'project_id');	
						}
						$smarty->assign('report',$report);
					} else {
						$template="savedreports";

						$page=$_GET['page'];
						
						if(!$page) $page=1;
						
						$per_page=20;
						
						$page_count=ceil(count($reports)/$per_page);
						if($page>$page_count) $page=1;
						$start=($page-1) * $per_page;
						$slice=array_slice($reports,$start,$per_page);
						
						
						
						$smarty->assign('reports',$slice);
						$smarty->assign('page',$page);
						$smarty->assign('page_count',$page_count);					
					}
					//$smarty->assign('reports',$reports);
					
				} else {
					$template="clientreports";
				
				
					if($_POST) {
						$report=$_POST['report'];
					} else {
						$report=$_SESSION['client_report'];
					}
					if($report['start']=='') $report['start']=date("d-m-Y",strtotime("-1 Month"));
					if($report['stop']=='') $report['stop']=date("d-m-Y");
					$_SESSION['client_report']=$report;
					$smarty->assign('report',$report);
					if($_POST) {
						$dstart=reverseDate($report['start']);
						$dend=reverseDate($report['stop']);
						$dtstart=strtotime($dstart);
						$dtend=strtotime($dend. " +1 day");
						
						if($report['ptype']) {
							$q_tmp .= "and project_type = " . $report['ptype'];
						}
						if($report['type']) {
							$q_from .= ",ptype ";
							$q_tmp .=" and project_type=ptype.ptype_id and (ptype.ptype_wtype=" . $report['type']. " or w.ptype_wtype=".$report['type'].")";
						}
						if($report['paid']!='') {
							$q_tmp .=" and project_paid=" . $report['paid'];
						}
						if($report['client']) {
							list($contractor,$client)=explode('_',$report['client']);
							if($client) {
								$q_tmp .= " and project_client=".$client;
							} else {
								$q_from .= ",client ";
								$q_tmp .= " and client_id=project_client and client_contractor=".$contractor;
							}
						}	
											
						$q="SELECT p.*,sum(timing_end-timing_start)+1 as project_worked,ptype.ptype_wtype AS wtype,w.*
						from timing{$q_from} ,project p 
						LEFT JOIN worktype w ON w.project_id = p.project_id
						where project_deleted=0 and project_cdate between '$dtstart' and '$dtend' and project_status=".PS_COMPLETED." and p.project_id=timing_project {$q_tmp} group by timing_project  order by project_client,project_date ASC";								
											
						$res=_sqlQuery($q);
						$total=0;
						while($row=mysql_fetch_assoc($res)) {
							$row['client']=$clients[$row['project_client']]['client_name'];
							if($row['project_ishourly']) {
								$row['price']=round($row['project_worked'] * $row['project_price'] /36)/100;
							} else {
								$row['price']=$row['project_price'] * $row['project_count'] ;
							}
							if($row['ptype_wtype']==$report['type'])
							{
							$projects[]=$row;
							$total+=$row['price'];
							}
							
							if($row['wtype']==$report['type'] && empty($row['ptype_wtype']))
							{
							$projects[]=$row;
							$total+=$row['price'];
							}														
						}
						//var_dump($projects);
						//die();
						$smarty->assign('total',$total);
						$smarty->assign('projects',$projects);
						if($_POST['submit']=='PDF') {
							$oreport=New Report();
							$header=array(
								0=>array('size'=>5,'name'=>'#','align'=>'R'),
								1=>array('size'=>61,'name'=>'Project','align'=>'L'),
								2=>array('size'=>60,'name'=>'Type','align'=>'L'),
								3=>array('size'=>17,'name'=>'Date','align'=>'C'),
								4=>array('size'=>17,'name'=>'End','align'=>'C'),
								/*5=>array('size'=>10,'name'=>'Hours','align'=>'C'),*/
								5=>array('size'=>10,'name'=>'Paid','align'=>'R'),
								6=>array('size'=>15,'name'=>'Price','align'=>'R'),
								
							);
							$i=0;
							$cclient='';
							$pdata=array();
							foreach($projects as $project) {
								$i++;
								
								if($cclient!=$project['project_client']) {
									$rdata[]=array(
										$clients[$project['project_client']]['client_name']
									);
									$pdata[]=array(
										$clients[$project['project_client']]['client_name']
									);
									$cclient=$project['project_client'];
								}
								$rdata[]=array(
									$i,
									$project['project_name'],						
									$ptype[$project['project_type']]['ptype_name'],
									date('d-m-Y',$project['project_date']),
									date('d-m-Y',$project['project_cdate']),
									/*($project['project_ishourly']?hm($project['project_worked']):"-"),*/
									($project['project_paid']?"Yes":"No"),
									$project['price'].'$'									
								);
								$pdata[]=array(
									$i,
									$project['project_name'],						
									$ptype[$project['project_type']]['ptype_name'],
									date('d-m-Y',$project['project_date']),
									date('d-m-Y',$project['project_cdate']),
									($project['project_ishourly']?hm($project['project_worked']):"-"),
									($project['project_paid']?"Yes":"No"),
									$project['price'].'$',
									$project['project_id']
								);
							}
							
							
							
							
							if($client) {
								$rtitle="CLIENT REPORT: " . $clients[$client]['contractor_name'] . "-".$clients[$client]['client_name'] . " | Period: {$report['start']} - {$report['stop']}";
								$title="client_report_" . $clients[$client]['contractor_name'] . "_".$clients[$client]['client_name'] .  "_{$report['start']}_{$report['stop']}";
							} else {
								$rtitle="CLIENT REPORT: " . $contractors[$report['client']]['contractor_name'] . " | Period: {$report['start']} - {$report['stop']}";
								$title="client_report_" . $contractors[$report['client']]['contractor_name'] . "_{$report['start']}_{$report['stop']}";
							}
							if($report['type']) {
								$title.='-'. $project_wtypes[$report['type']];
								$rtitle.='-'. $project_wtypes[$report['type']];
							}
							if($report['ptype']) {
								$title.='-'. $ptype[$report['ptype']]["ptype_name"];
								$rtitle.='-'. $ptype[$report['ptype']]["ptype_name"];
							}
							
							$oreport->setTitle($rtitle);
							$title=generateSlug($title,0);
							$now=time();
							$sdata=base64_encode(serialize($pdata));
							$q="insert into report set report_title='{$rtitle}',report_date={$now},report_data='{$sdata}',report_paid=0,report_price={$total}";
							_sqlQuery($q);
							$rid=mysql_insert_id();
							
							$oreport->setFooter(" generated on " . date("d/m/Y H:i"));
							$oreport->AliasNbPages();
							$oreport->SetFont('Arial','',8);
							$oreport->AddPage();
							$oreport->FancyTable($header,$rdata,$total);
							$oreport->Output('freports/'.$rid .".pdf");
							$oreport->Output($title .".pdf","D");
							
							exit;
						}
					}
				}
			}
			
			$smarty->display($template . '.tpl');
		}
		
		function displayProject() {
			global $smarty;
			$smarty->assign('active',"myprojects");
			$template="project";
			$id=_sqlEscValue($this->rewrite_params[1]);
			if($id) {
				$q="SELECT *,client_name  from project,client where project_id={$id} and project_client=client_id";
				$res=_sqlQuery($q);
				while($row=mysql_fetch_assoc($res)) {
					$row['timing']=1;
					$q="SELECT * from timing,user where timing_project={$row['project_id']} and user_id=timing_user";
					$res2=_sqlQuery($q);
					while($row2=mysql_fetch_assoc($res2)) {
						$delta=($row2['timing_end'] - $row2['timing_start']);
						$row2['delta']=$delta;
						$row['alltimings'][$row2['timing_id']]=$row2;
						$row['timing']=$row['timing'] + $delta;
						$row['timings'][$row2['timing_user']]+=$delta;
						$row['users'][$row2['timing_user']]=$row2['user_name'];
						if($row2['timing_open'] && $row2['timing_user']==$this->uid) {
							$row['started']=1;
						}
						if($row2['timing_start']==0 && $row2['timing_user']==$this->uid) {
							$empty_timing=$row2['timing_id'];
						}
						
					}
					$q="SELECT * from file where file_project=$id and file_message=0";
					$row['files']=_sqlFetchResultRows($q,'file_id');					
					
					$q="SELECT * from file where file_project=$id and file_message!=0";
					$tmfiles=_sqlFetchResultRows($q,'file_id');
					foreach($tmfiles as $key=>$value) {
						$mfiles[$value['file_message']][$key]=$value;
					}
					$row['mfiles']=$mfiles;
					
					$q="SELECT *,u.user_name as user from message,user u where message_project=$id and message_user=u.user_id order by message_time desc";
					$row['messages']=_sqlFetchResultRows($q,'message_id');
					
					//check for file and download
					
					if($this->rewrite_params[2]=='download') {		
						
						$fid=$this->rewrite_params[3];
						$file=$row['files'][$fid];
						if(!$file) $file=$tmfiles[$fid];						
						
						if($file) {
										$filePath=FILE_DIR."/".$fid;
										header("Content-type: application/force-download"); 			
										header("Content-disposition: attachment; filename=\"".$file['file_name']."\""); 
										header("Content-length: ".filesize($filePath)); 
										header("Content-Transfer-Encoding: Binary");
										@readfile("$filePath") or die("File not found.");
										exit();
						}
					}
					//post a message
					if($this->rewrite_params[2]=='post') {		
						$message=_sqlEscValue($_POST['message']);
						$hasfiles=0;
						$files=array();
						if($_FILES['project_file']) {							
							foreach($_FILES['project_file']['name'] as $key=>$value) {
								$fname=$value;
								if($fname=='') continue;
								$hasfiles=1;
								$files[]=array("name"=>$fname,"ftmp"=>$_FILES['project_file']['tmp_name'][$key]);
								/*
						
								*/
							}						
						}
						$stamp=time();
						$q="INSERT INTO message set message_text='{$message}',message_project='{$id}',message_user={$this->uid},message_time={$stamp},message_file={$hasfiles}";
						_sqlQuery($q);
						$mid=mysql_insert_id();
						
						foreach ($files as $file) {
								$fname=$file['name'];
								$ftmp=$file['ftmp'];
								$q="INSERT INTO file SET file_name='{$fname}',file_project='{$id}',file_message={$mid}";
								_sqlQuery($q);
								$fid=mysql_insert_id();
								move_uploaded_file($ftmp,FILE_DIR."/".$fid);								
						}
						
						redirect(ROOT_HOST . "project/{$id}/");						
						
					}
					//change timing
					if($this->rewrite_params[2]=='timing') {
						$tid=$_POST['tid'];
						$val=$_POST['timing'];
						list($h,$m)=explode(':',$val);
						$dt=($h*60+$m)*60;
						if(!$dt) $dt=1;
						//log modifier
						$odt=$row['alltimings'][$tid]['delta'];						
						$txt="Modified timing ($tid) from ".hm($odt)." to ".hm($dt)."  ";
						$this->logEvent(MT_WORK_CHANGED,$id,$txt);
						$q="update timing set timing_end=timing_start+{$dt} where timing_id={$tid}";						
						_sqlQuery($q);
						
						redirect(ROOT_HOST . "project/{$id}/");						
					}
					if($this->rewrite_params[2]=='rm') {
						$mid=$this->rewrite_params[3];
						if($row['messages'][$mid]) {
							$q="delete from message where message_id={$mid}";						
							_sqlQuery($q);
						}
						
						redirect(ROOT_HOST . "project/{$id}/");						
					}					
					//change project status
					if($this->rewrite_params[2]=='change') {		
						
						$new_status=$_POST['project_status'];
						$old_status=$row['project_status'];
						if($new_status!=$old_status) {						
							
							//finish project
							if ($new_status==PS_COMPLETED) {
								$now=time();
								$q_tmp=",project_cdate={$now} ";
							}
							
							//reopen project
							if ($old_status==PS_COMPLETED) {
								$q_tmp=",project_cdate=0 ";
							}
							
							_sqlQuery("update project set project_status={$new_status} {$q_tmp} where project_id={$id}");
							//log status change
							global $project_phases;
							$txt="Changed status  from " . $project_phases[$old_status] . " to " .$project_phases[$new_status];
							$this->logEvent(MT_STATUSCHANGED,$id,$txt);
							
						}
						redirect(ROOT_HOST . "project/{$id}/");
						
						
					}					
					//start project by hour
					if($this->rewrite_params[2]=='start') {		
						$now=time();
						if($empty_timing) {
							$q="update timing set timing_start=$now,timing_end=$now,timing_open=1 where timing_id=$empty_timing";
							_sqlQuery($q);
							$timing_id=$empty_timing;
						} else {
							$q="insert into timing set timing_project={$id},timing_user={$this->uid},timing_start=$now,timing_end=$now,timing_open=1";
							_sqlQuery($q);
							$timing_id=mysql_insert_id();
						}
						$q="update timing set timing_open=0 where timing_project!={$id} and timing_user={$this->uid}";
						_sqlQuery($q);
						//log work start					
						$txt="Started work";
						$this->logEvent(MT_WORK_STARTED,$id,$txt);
						redirect(ROOT_HOST . "project/{$id}/");	
					}					
					//stop project by hour
					if($this->rewrite_params[2]=='stop') {		
						//log work end ? 	
						$q="update timing set timing_open=0 where timing_project={$id} and timing_user={$this->uid}";
						_sqlQuery($q);
						$txt="Ended work";
						$this->logEvent(MT_WORK_STOPPED,$id,$txt);
						redirect(ROOT_HOST . "project/{$id}/");	
					}					
					$project=$row;
				}
			}
			$smarty->assign('project',$project);
			$smarty->display($template . '.tpl');
		}
/* Display My Projects */ 		
		function displayMyProjects() {
			global $smarty;
			$smarty->assign('active',"myprojects");
			$template="myprojects";
			
			$q="SELECT ut.*,COUNT(DISTINCT(project_id)) as cnt,u.project_id FROM ptype ut LEFT  JOIN project u ON ut.ptype_id = u.project_type GROUP BY ut.ptype_id ORDER BY ptype_name";
			$projecttypes=_sqlFetchResultRows($q,'ptype_id');
			$smarty->assign('projecttypes',$projecttypes);
				
				$q="SELECT c.client_id,c.client_name,cc.contractor_name from client c,contractor cc where c.client_contractor=cc.contractor_id order by client_contractor,client_name";
				$clients=_sqlFetchResultRows($q,'client_id');			
				$smarty->assign('clients',$clients);			
			//get projects list
				$sort=$_SESSION['myproject_sort'];
				$sort_name=$_SESSION['myproject_sortname'];
				if(!$sort) $sort='DESC';
				if(!$sort_name) $sort_name="project_date";
				
				if($_GET['sort']) $sort=$_GET['sort'];
				if(strchr($sort,'|')) {
					
					list($sort_name,$sort)=explode('|',$sort);
					
				}
				$_SESSION['myproject_sort']=$sort;
				$_SESSION['myproject_sortname']=$sort_name;
				$smarty->assign('sort',$sort);
				$smarty->assign('sort_name',$sort_name);
				$filters=$_SESSION['myproject_filters'];
				if($_POST['submit']) {
					
					if($_POST['submit']=="Filter") {
						$filters=$_POST['filter'];
					} else {
						$filters=array();
					}
					unset($_POST);
				}
				if(!$filters) $filters=array();
				
				foreach($filters as $key=>$value) {
					if($value=='') continue;
					switch($key) {
						case 'name': 
								$q_tmp.=" AND project_name like '%{$value}%' ";
								break;
						case 'client':
								$q_tmp.=" AND project_client='{$value}' ";
								break;
						case 'status':
								$q_tmp.=" AND project_status='{$value}' ";
								break;						
						case 'priority':
								$q_tmp.=" AND project_priority='{$value}' ";
								break;								
					}
				}
				
				$smarty->assign('filter',$filters);
				$_SESSION['myproject_filters']=$filters;
				$projects=array();
				
				$q="SELECT *  from project p,timing t where project_deleted=0 and project_id=timing_project and timing_user='{$this->uid}' {$q_tmp} group by project_id order by {$sort_name} {$sort}";
				$res=_sqlQuery($q);
				while($row=mysql_fetch_assoc($res)) {
					
					$q="SELECT * from timing where timing_project={$row['project_id']} and timing_user='{$this->uid}'";
					$res2=_sqlQuery($q);
					while($row2=mysql_fetch_assoc($res2)) {
						$row['timings'][]=$row2;
					}
					
					$projects[$row['project_id']]=$row;
				}
				//init pagination
				$page=$_GET['page'];
				
				if(!$page) $page=1;
				
				$per_page=20;
				
				$page_count=ceil(count($projects)/$per_page);
				if($page>$page_count) $page=1;
				$start=($page-1) * $per_page;
				$slice=array_slice($projects,$start,$per_page);
				
				
				
				$smarty->assign('projects',$slice);
				$smarty->assign('page',$page);
				$smarty->assign('page_count',$page_count);			
			
			$smarty->display($template . '.tpl');
		}
		
/* Display Projects */ 
		function displayProjects() {
			global $smarty;
			$smarty->assign('active',"projects");
			$template="projects";
			$q="SELECT ut.*,COUNT(DISTINCT(project_id)) as cnt,u.project_id FROM ptype ut 
			LEFT  JOIN project u ON ut.ptype_id = u.project_type 
			GROUP BY ut.ptype_id ORDER BY ptype_name";
			$projecttypes=_sqlFetchResultRows($q,'ptype_id');
			$smarty->assign('projecttypes',$projecttypes);	
			$action=$this->rewrite_params[1];
			
			if ($action=="types") {
//edit project types
					if($_POST) {
					
						$id=_sqlEscValue($_POST['ptid']);
						unset($_POST['ptid']);
												
						$q_tmp=prepareTableFields(array_keys($_POST),$_POST);
						if($id) {
							$q="UPDATE ptype SET {$q_tmp} where ptype_id={$id}";
							//die($_POST);
						} else {
							$q="INSERT INTO ptype SET {$q_tmp}";
						}
						_sqlQuery($q);
						
						redirect(ROOT_HOST . "projects/types/");						
					}
					
					if($this->rewrite_params[2]=='edit') {
					
						$smarty->assign('projecttype',$projecttypes[$this->rewrite_params[3]]);
						
					}
					if($this->rewrite_params[2]=='delete') {
						$q="DELETE FROM ptype WHERE ptype_id=" . $this->rewrite_params[3];
						_sqlQuery($q);
						redirect(ROOT_HOST . "projects/types/");							
					}
					$template="projecttypes";			
			} else {
				//get clients
				$q="SELECT c.client_id,c.client_name,cc.contractor_name from client c,contractor cc where c.client_contractor=cc.contractor_id order by client_contractor,client_name";
				$clients=_sqlFetchResultRows($q,'client_id');			
				$smarty->assign('clients',$clients);
				//get users
				$q="SELECT *  from user where user_active=1 and user_deleted=0 order by user_name";
				$users=_sqlFetchResultRows($q,'user_id');
				$smarty->assign('users',$users);

				
				$sort=$_SESSION['project_sort'];
				$sort_name=$_SESSION['project_sortname'];
				if(!$sort) $sort='DESC';
				if(!$sort_name) $sort_name="project_date";
				
				if($_GET['sort']) $sort=$_GET['sort'];
				if(strchr($sort,'|')) {
					
					list($sort_name,$sort)=explode('|',$sort);
					
				}
				$_SESSION['project_sort']=$sort;
				$_SESSION['project_sortname']=$sort_name;
				$smarty->assign('sort',$sort);
				$smarty->assign('sort_name',$sort_name);
							
				
				$filters=$_SESSION['project_filters'];
				if($_POST['submit']) {
					
					if($_POST['submit']=="Filter") {
						$filters=$_POST['filter'];
					} else {
						$filters=array();
					}
					unset($_POST);
				}
				if(!$filters) $filters=array();
				
				foreach($filters as $key=>$value) {
					if($value=='') continue;
					switch($key) {
						case 'name': 
								$q_tmp.=" AND project_name like '%{$value}%' ";
								break;
						case 'client':
								$q_tmp.=" AND project_client='{$value}' ";
								break;
						case 'status':
								$q_tmp.=" AND project_status='{$value}' ";
								break;						
						case 'paid':
								$q_tmp.=" AND project_paid='{$value}' ";
								break;								
					}
				}
				
				$smarty->assign('filter',$filters);
				$_SESSION['project_filters']=$filters;
				$projects=array();
				//$q="SELECT *  from project where project_deleted=0 {$q_tmp} order by {$sort_name} {$sort}";
				$q="SELECT u.*,w.ptype_wtype
					FROM project u
					LEFT JOIN worktype w ON w.project_id = u.project_id
					where project_deleted=0
					{$q_tmp} order by {$sort_name} {$sort}";
				$res=_sqlQuery($q);
				while($row=mysql_fetch_assoc($res)) {
					
					$q="SELECT * from timing where timing_project={$row['project_id']}";
					$res2=_sqlQuery($q);
					while($row2=mysql_fetch_assoc($res2)) {
						$row['project_users'][$row2['timing_user']]=$users[$row2['timing_user']]['user_name'];
					}
					
					$projects[$row['project_id']]=$row;
					

				}
				//init pagination
				$page=$_GET['page'];
				
				if(!$page) $page=1;
				
				$per_page=20;
				
				$page_count=ceil(count($projects)/$per_page);
				if($page>$page_count) $page=1;
				$start=($page-1) * $per_page;
				$slice=array_slice($projects,$start,$per_page);
				
				
				
				$smarty->assign('projects',$slice);
				$smarty->assign('page',$page);
				$smarty->assign('page_count',$page_count);
				
				
				
				if($action=='edit') {
					$pid=_sqlEscValue($_POST['pid']);
					
					if(!$pid) {
							$pid=$this->rewrite_params[2];
					}
					

					
					if($pid) {
						$project=$projects[$pid];
						$q="SELECT *  from timing where timing_project=$pid order by timing_user";
						$pusers=_sqlFetchResultRows($q,'timing_user');										
						$q="SELECT * from file where file_project=$pid and file_message=0";
						$pfiles=_sqlFetchResultRows($q,'file_id');
						
						if($this->rewrite_params[3]=='delete') {
							$fid=$this->rewrite_params[4];
							$q="DELETE FROM file where file_id={$fid} and file_project={$pid}";
							_sqlQuery($q);
							unlink(FILE_DIR .'/' . $fid);
							//log delete file
							
							//redirect to project edit
							redirect(ROOT_HOST . "projects/edit/" . $fid);
						}
					} else {
						$pusers=array();
					}
				}
				
				if($_POST) {
						
						$id=_sqlEscValue($_POST['pid']);
						$idd=$_POST['pid'];
						unset($_POST['pid']);	
						$project_users=$_POST['project_users'];
						unset($_POST['project_users']);
						$uadd=array();
						$udel=array();
						if(!$_POST['project_paid']) {
							$_POST['project_paid']=0;
						}						
						if(!$_POST['project_ishourly']) {
							$_POST['project_ishourly']=0;
						}						
						foreach($pusers as $k=>$u) {
							if(array_search($k,$project_users)===FALSE) {
								$udel[$k]=$u;
							}
						}
						
						foreach($project_users as $k=>$u) {
							if(!$pusers[$u]) {
								$uadd[$u]=$users[$u];
							}
						}					
						$ptype_wtype=$_POST['ptype_wtype'];
						if($_POST['ptype_wtype'] && empty($idd))
						{					    							
						unset($_POST['ptype_wtype']);							
					    }						
						else
						{
                        $qq="SELECT * from ptype WHERE ptype_id=".$_POST['project_type']." and ptype_wtype=".$ptype_wtype;
					    $ress=_sqlQuery($qq);			   
					   
					    if(mysql_num_rows($ress)) 
					    {
					    $roww=mysql_fetch_assoc($ress);				   
					    }				   
				  
						if(!$roww['ptype_id'])
						{
						
                        $qes="SELECT * from worktype WHERE project_id=".$idd;
					    //$ress=_sqlQuery($qes);
						
						
						$result=_sqlQuery($qes);	
						//var_dump(mysql_fetch_assoc($result));
						
						if(mysql_num_rows($result)) 
					    {
					    $roww=mysql_fetch_assoc($result);				   
					    }
																		
						//die($roww);
						
						if(isset($roww))
						{					
						$qq="UPDATE worktype SET ptype_id=".$_POST['project_type'].",ptype_wtype=".$ptype_wtype." where project_id=".$idd;
						mysql_query($qq);
						}
						else
						{					
						$qer="INSERT INTO worktype(project_id,ptype_id,ptype_wtype) VALUES('".$idd."','".$_POST['project_type']."','".$ptype_wtype."')";
						mysql_query($qer);
						}																																
						}
                        
						unset($_POST['ptype_wtype']);
						}												
						$q_tmp=prepareTableFields(array_keys($_POST),$_POST);
						if($id) {															
						$q="UPDATE project SET {$q_tmp} where project_id={$id}";
							_sqlQuery($q);
							
							
							foreach($udel as $k=>$u) {								
								$q="DELETE FROM timing where timing_user={$u['timing_user']} and timing_project={$id}";
								_sqlQuery($q);
								//log delete user
								$txt="Removed user ".$users[$u['timing_user']]['user_name']." from the project";
								$this->logEvent(MT_USER_REMOVED,$id,$txt);
								
							}
							
							foreach($uadd as $k=>$u) {
								$q="INSERT INTO timing set timing_user={$u['user_id']},timing_project={$id}";
								_sqlQuery($q);
								//log add user
								$txt="Added user ".$u['user_name']." to the project";
								$this->logEvent(MT_USER_ADDED,$id,$txt);
							}
							//add log updated
							//check if status changed and add log
							$new_status=$_POST['project_status'];
							$old_status=$project['project_status'];
							if($new_status!=$old_status) {						
								global $project_phases;
								if ($new_status==PS_COMPLETED) {
										$now=time();
										$q="update project set project_cdate={$now} where project_id={$id}";
										_sqlQuery($q);
								}
								$txt="Changed status  from " . $project_phases[$old_status] . " to " .$project_phases[$new_status];
								$this->logEvent(MT_STATUSCHANGED,$id,$txt);								
							}							
							
						} else {
							
							$q_tmp .=" ,project_date=".time();
							$new_status=$_POST['project_status'];
							if($new_status == PS_COMPLETED) {
								$q_tmp .=" ,project_cdate=".time();
							}
							
							//die($_POST['ptype_wtype']);
							$q="INSERT INTO project SET {$q_tmp}";
							_sqlQuery($q);	
							//$id=mysql_insert_id();
				   
				   							
						$id=mysql_insert_id();
							
						$qq="SELECT * from ptype WHERE ptype_id=".$_POST['project_type']." and ptype_wtype=".$ptype_wtype;
					    $ress=_sqlQuery($qq);			   
					   
					    if(mysql_num_rows($ress)) 
					    {
					    $roww=mysql_fetch_assoc($ress);				   
					    }				   
				  
						if(!$roww['ptype_id'])
						{				  
						$qer="INSERT INTO worktype(project_id,ptype_id,ptype_wtype) VALUES ('".$id."','".$_POST['project_type']."','".$ptype_wtype."')";
						mysql_query($qer);
						}
							
							//add log created
							$txt="Created project";
							$this->logEvent(MT_PROJECT_ADDED,$id,$txt);
							
							foreach($uadd as $k=>$u) {
								$q="INSERT INTO timing set timing_user={$u['user_id']},timing_project={$id}";
								_sqlQuery($q);
								//log add user
								
							}
						}
						if($_FILES['project_file']) {
							
							foreach($_FILES['project_file']['name'] as $key=>$value) {
								$fname=$value;
								if($fname=='') continue;
								$tfiles[]=$fname;
								$ftmp=$_FILES['project_file']['tmp_name'][$key];
								$q="INSERT INTO file SET file_name='{$fname}',file_project='{$id}'";
								_sqlQuery($q);
								$fid=mysql_insert_id();
								move_uploaded_file($ftmp,FILE_DIR."/".$fid);
								//log add files
								
								
							}
							if(count($tfiles)>0) {
								$txt="Added file(s):" .implode(', ',$tfiles);
								$this->logEvent(MT_FILE_ADDED,$id,$txt);								
							}
						
						}
												
						redirect(ROOT_HOST . "projects/");						
				}
				
				$action=$this->rewrite_params[1];
				if($action=='add' || $action=='edit') {
					$project=$projects[$this->rewrite_params[2]];
					$project['project_users']=$pusers;
					$project['project_files']=$pfiles;
					$smarty->assign('project',$project);
					
					$template="addproject";
				}
				if($this->rewrite_params[1]=='delete') {
						$q="UPDATE project set project_deleted=1 where project_id=" . $this->rewrite_params[2];
						_sqlQuery($q);
						$txt="Deleted project";
						$this->logEvent(MT_PROJECT_DELETED,$this->rewrite_params[2],$txt);								
						redirect(ROOT_HOST . "projects/");						
				}
			
			}
			$smarty->display($template . '.tpl');
		}
		
/* Display Clients*/
		function displayClients() {
			global $smarty;
			$smarty->assign('active',"clients");
			//$q="SELECT * from contractor order by contractor_name";
			$q="SELECT ut.*,COUNT(DISTINCT(client_id)) as cnt,u.client_id FROM contractor ut LEFT  JOIN client u ON ut.contractor_id = u.client_contractor GROUP BY ut.contractor_id ORDER BY contractor_name";
			$contractors=_sqlFetchResultRows($q,'contractor_id');
			$smarty->assign('contractors',$contractors);
			
			$q="SELECT * from client order by client_contractor,client_name";
			$clients=_sqlFetchResultRows($q,'client_id');
			$smarty->assign('clients',$clients);
			
			
			$template="clients";
			$action=$this->rewrite_params[1];
			if ($action=="contractors") {
//edit contractors
					if($_POST) {
						$id=_sqlEscValue($_POST['cid']);
						unset($_POST['cid']);
												
						$q_tmp=prepareTableFields(array_keys($_POST),$_POST);
						if($id) {
							$q="UPDATE contractor SET {$q_tmp} where contractor_id={$id}";
						} else {
							$q="INSERT INTO contractor SET {$q_tmp}";
						}
						_sqlQuery($q);
						redirect(ROOT_HOST . "clients/contractors/");						
					}
					
					if($this->rewrite_params[2]=='edit') {
						$smarty->assign('contractor',$contractors[$this->rewrite_params[3]]);
						
					}
					if($this->rewrite_params[2]=='delete') {
						$q="DELETE FROM contractor WHERE contractor_id=" . $this->rewrite_params[3];
						_sqlQuery($q);
						redirect(ROOT_HOST . "clients/contractors/");						
					}
					$template="contractors";
				
			} else {
					if($_POST) {
						$id=_sqlEscValue($_POST['cid']);
						unset($_POST['cid']);
												
						$q_tmp=prepareTableFields(array_keys($_POST),$_POST);
						if($id) {
							$q="UPDATE client SET {$q_tmp} where client_id={$id}";
						} else {
							$q="INSERT INTO client SET {$q_tmp}";
						}
						
						_sqlQuery($q);
						
						redirect(ROOT_HOST . "clients/");						
					}
					
					if($this->rewrite_params[1]=='edit') {
						
						$smarty->assign('client',$clients[$this->rewrite_params[2]]);
						
					}
					if($this->rewrite_params[1]=='delete') {
						$q="DELETE FROM client WHERE client_id=" . $this->rewrite_params[2];
						_sqlQuery($q);
						redirect(ROOT_HOST . "clients/");						
					}
			}
			$smarty->display($template . '.tpl');
		}
/* Display users*/		
		function displayUsers() {
				global $smarty;
				$smarty->assign('active',"users");
				$q="SELECT *  from user u,usertype ut where ut.usertype_id=u.user_type and u.user_deleted=0 order by user_name";
				$users=_sqlFetchResultRows($q,'user_id');
				$smarty->assign('users',$users);
				
				$q="SELECT ut.*,COUNT(DISTINCT(user_id)) as cnt,u.user_id FROM usertype ut LEFT  JOIN user u ON ut.usertype_id = u.user_type GROUP BY ut.usertype_id ORDER BY usertype_name";
				$usertypes=_sqlFetchResultRows($q,'usertype_id');
				
				$smarty->assign('usertypes',$usertypes);
				$template="users";
				
				$action=$this->rewrite_params[1];
				$user_id=$this->rewrite_params[2];
				
				if($action=="add" || $action=="edit") {
					$smarty->assign('user',$users[$this->rewrite_params[2]]);
					if($_POST) {
						$uid=_sqlEscValue($_POST['uid']);
						unset($_POST['uid']);
						if($_POST['user_password']) {
							$_POST['user_password']=md5($_POST['user_password']);
						} else {
							unset($_POST['user_password']);
						}
						if(!$_POST['user_admin']) {
							$_POST['user_admin']=0;
						}
						if(!$_POST['user_subadmin']) {
							$_POST['user_subadmin']=0;
						}
						if(!$_POST['user_active']) {
							$_POST['user_active']=0;
						}
						
						$q_tmp=prepareTableFields(array_keys($_POST),$_POST);
						if($uid) {
							$q="UPDATE user SET {$q_tmp} where user_id={$uid}";
						} else {
							$q="INSERT INTO user SET {$q_tmp}";
						}

						_sqlQuery($q);
						redirect(ROOT_HOST . "users/");
					}
					//$template="useredit";
				} else if ($action=="types") {
//edit usertypes	
					if ($_POST) {
						$id=_sqlEscValue($_POST['utid']);
						$utname=_sqlEscValue($_POST['name']);
						if($id) {
							$q="UPDATE usertype SET usertype_name='{$utname}' where usertype_id={$id}";
						} else {
							$q="INSERT INTO usertype SET usertype_name='{$utname}'";
						}
						_sqlQuery($q);
						redirect(ROOT_HOST . "users/types/");
					}
					
					if($this->rewrite_params[2]=='edit') {
						$smarty->assign('usertype',$usertypes[$this->rewrite_params[3]]);
						
					}
					if($this->rewrite_params[2]=='delete') {
						$q="DELETE FROM usertype WHERE usertype_id=" . $this->rewrite_params[3];
						_sqlQuery($q);
						redirect(ROOT_HOST . "users/types/");						
					}
					$template="usertypes";
				}
				else if ($action=="switch") {
					_sqlFieldSwitch("user","user_active","user_id",$user_id);
					redirect(ROOT_HOST . "users/");
				} else if ($action=="delete") {
					_sqlFieldSwitch("user","user_deleted","user_id",$user_id);
					redirect(ROOT_HOST . "users/");
				}
				$smarty->display($template . '.tpl');
		}
		
		function displayPage($page) {
			global $smarty;
			$smarty->assign('show_right_ads',0);
			$smarty->assign('active',$page);
			$smarty->assign('title',ucfirst($page));
			$smarty->assign('page',$page);
			$smarty->display('page.tpl');
		}
			
		
		function displayAccount() {
			global $smarty,$db;
			
			//print_r($_POST);
			if($_POST) {
				$user=$_POST;
				unset($user['user_password2']);
				if($user['user_password']) {
					$user['user_password']=md5($user['user_password']);
				} else {
					unset($user['user_password']);
				}
				$q_tmp=prepareTableFields(array_keys($user),$user);
				$q="UPDATE user SET {$q_tmp} where user_id={$this->uid}";
				_sqlQuery($q);
				$user=_sqlGetRowContent("user","user_id",$this->uid);
				$_SESSION['auth']=$user;
				redirect(ROOT_HOST);
			}
			$smarty->display('account.tpl');
			
		}
		
		function displayLogin() {
			global $smarty;
			$email=_sqlEscValue($_POST['email']);
			if($email) {
				if(strlen($_POST['password'])!=32) {
					$pass=md5($_POST['password']);
				} else {
					$pass=$_POST['password'];
				}
				
				$user=_sqlGetRowContent("user","user_email", $email, "user_password",$pass);
				if($user["user_active"]==1 && $user["user_deleted"]==0) {					
					$_SESSION['auth']=$user;
					redirect(ROOT_HOST);
				} else {
					$smarty->assign('message',"Invalid user name or password");
				}
			}
			$smarty->display('login.tpl');
		}
		function displayLogout() {
			$_SESSION['auth']=array();
			redirect(ROOT_HOST);
		}
		
		function displayHome() {
			global $smarty;
			$action=$this->rewrite_params[0];
			$template="index.tpl";
			
			if($action=='finished') {
				$template="finished.tpl";
				//$q="select message.*,project_name,project_id,user_name from message,project,user where message_project=project_id and project_status=".PS_COMPLETED." and message_type=".MT_STATUSCHANGED." and user_id=message_user order by message_time desc limit 50";
				$q="select * from project,client where project_client=client_id and project_status=".PS_COMPLETED." order by project_cdate desc limit 50";
				$messages=_sqlFetchResultRows($q,'project_id');
			} else {
				$q="select * from project,ptype where project_type=ptype_id and project_status!=".PS_COMPLETED." and project_deleted=0 and project_id in (SELECT distinct(timing_project) from timing where timing_user={$this->uid})";
				$projects=_sqlFetchResultRows($q,'project_id');
				
				$q="select message.*,project_name,project_id,user_name from message,project,user where message_project=project_id and message_user=user.user_id and project_id in (SELECT distinct(timing_project) from timing where timing_user={$this->uid}) order by message_time desc limit 50";
				$messages=_sqlFetchResultRows($q,'message_id');
				
				$smarty->assign('projects',$projects);
				
			}
			$smarty->assign('messages',$messages);
			$smarty->display($template);


		}
				
		function logEvent($type,$project,$text,$role=0) {
			$time=time();
			$text=_sqlEscValue($text);
			$q="INSERT INTO message SET message_type={$type},message_user='{$this->uid}',message_project={$project},message_text='{$text}',message_role={$role},message_time={$time}";
			_sqlQuery($q);			
		}
		
		
	}
?>