<?php

function _sqlPrint($value)
{
	$value = str_replace("\n","<br>\n",$value);	
	echo $value;
}


function _sqlTraceError($result, $q="")
{
	global $db;
	echo _sqlPrint($q)."<br><br>";
	echo $db->error();
	
	_sqlPrint("<br>".$result->userinfo."<br>");
	
	return;
}

function _sqlQuery($q)
{
	global $db;
		
	$result = $db->query($q);

	if($db->error()) 
			_sqlTraceError($result, $q);
	
	return $result;
}

function _sqlInsertId() {
	global $db;
	$value=$db->insertID();
	return($value);
}

function _sqlDel($tableName, $idName, $idValue)
{
	$q="DELETE FROM $tableName WHERE $idName = '$idValue'";
	_sqlQuery($q);
}

function _sqlEmptyTable($tableName)
{
	$q="DELETE FROM $tableName";
	_sqlQuery($q);
}

function _sqlFieldSwitch($tableName, $fieldSwitch, $idName, $idValue)
{
	$q="UPDATE $tableName SET $fieldSwitch=($fieldSwitch+1)%2 WHERE $idName='$idValue'";
	_sqlQuery($q);	
}

function _sqlGetFieldContent($tableName, $fieldName, $idName, $idValue, $idName2='', $idValue2='')
{
	$sqlWhere="";
	if($idName2!="")
		$sqlWhere=" AND $idName2='$idValue2' ";
		
	$q="SELECT $fieldName FROM $tableName WHERE $idName='$idValue' $sqlWhere ORDER BY $fieldName LIMIT 0,1";
	$result = _sqlQuery($q);
	
	if($record=$result->fetchRow())
		return $record[0];
	else
		return false;
}

function _sqlGetRowContent($tableName, $idName, $idValue, $idName2='', $idValue2='') 
{    
	global $db;
	$sqlWhere='';
	if($idName2!='')
		$sqlWhere=" AND $idName2='$idValue2' ";
		
	$q="SELECT * FROM $tableName WHERE $idName = '$idValue' $sqlWhere LIMIT 0,1";
    $result=_sqlQuery($q);
    if($ret=$db->fetchAssoc($result))
    	return $ret;
    else 
    	return false;
}

function _sqlGetTableContent($tableName, $idName, $fieldName, $fieldOrder='', $outType=0) 
{   
	global $db;
	$ret=array();	
	
	if($outType==2)	
	{
		if(''!=$fieldOrder)
			$sqlOrder = "ORDER BY $fieldOrder";
		else
			$sqlOrder = "";
		
		$sqSelect = "*";
	}
	else
	{
		if(''==$fieldOrder)
			$fieldOrder = $fieldName;
			
		$sqlOrder = "ORDER BY $fieldOrder";
		
		$sqSelect = "$idName, $fieldName";
	} 
				
	$q="SELECT $sqSelect FROM $tableName $sqlOrder";
    $result=_sqlQuery($q);
    
    if(1==$outType || 2==$outType)
    {
	    while($ret[]=$result->fetchRow(DB_FETCHMODE_ASSOC));
		unset($ret[count($ret)-1]);
    }
    else 
    {
    	while($record=$result->fetchRow()) 
	    {
	        $ret[0][]=$record[0];
	        $ret[1][]=$record[1];
	    }
    }    

    return $ret;
}

function _sqlGetTableContentFiltered($tableName, $idName, $fieldName, $filterName, $filterValue, $fieldOrder='', $outType=0)
{
	global $db;
    $ret=array();
    if($outType==2 || $outType==3)	
	{
		if(''!=$fieldOrder)			
			$sqlOrder = "ORDER BY $fieldOrder";
		else
			$sqlOrder = "";
		
		$sqSelect = "*";
	}
	else
	{
		if(''==$fieldOrder)
			$fieldOrder = $fieldName;
			
		$sqlOrder = "ORDER BY $fieldOrder";
		
		$sqSelect = "$idName, $fieldName";
	} 
				
	$q="SELECT $sqSelect FROM $tableName WHERE $filterName = '$filterValue' $sqlOrder";
    $result=_sqlQuery($q);
       
    if(1==$outType || 2==$outType || 3==$outType)
    {
		if ($outType=3) {
					while($row=$db->fetchAssoc($result)){
						$ret[$row[$idName]]=$row;
					}
		} else {
			while($ret[]=$db->fetchAssoc($result));
			unset($ret[count($ret)-1]);
		}
	}
    else 
    {
    	while($record=$db->fetchRow($result)) 
	    {
	        $ret[0][]=$record[0];
	        $ret[1][]=$record[1];
	    }
    }
	
    return $ret;
}


function _sqlGetTableNoRows($tableName, $filterName='', $filterValue='')
{
	global $db;
    $sqlWhere="";
	if($filterName!='')
    	$sqlWhere=" WHERE {$filterName} = '{$filterValue}' ";
	
	$q="SELECT count(*) FROM {$tableName} {$sqlWhere}";
    $result=_sqlQuery($q);
    if($record = $db->fetchRow())
    	return $record[0];
    else 
    	return 0;
}


function _sqlEscValue($value)
{
	$value = mysql_real_escape_string(stripslashes($value));
	return $value;
}

function _sqlFetchResultRows($q,$key='') {
	global $db;
	$result=_sqlQuery($q);
	$data=array();
	if(!$key) {
		while($row=$db->fetchAssoc($result)){
			$data[]=$row;
		}
	} else {
		while($row=$db->fetchAssoc($result)){
			$data[$row[$key]]=$row;
		}
	}
	return $data;
}

function _sqlCheckFieldExist($tableName, $fieldName, $fieldValue, $fieldName2='', $fieldValue2='')
{
	$sqlWhere="";
	if($fieldName2!='')
		$sqlWhere=" AND $fieldName2 = '$fieldValue2' ";
	
	$q = "SELECT $fieldName FROM $tableName WHERE $fieldName = '$fieldValue' $sqlWhere LIMIT 0,1";
	$result=_sqlQuery($q);
	if($result->fetchAssoc)
		return true;
	else 
		return false;
}

?>