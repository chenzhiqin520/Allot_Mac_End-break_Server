<?php

function markuse2json($markflag)
{
	$arr =array();

	if(0 == $markflag)
	{
		$arr["markinfo"]["stat"] = "success";
	}
	else if(1== $markflag)
	{
    	$arr["markinfo"]["stat"] = "fail";
	}

	$json = json_encode($arr);	
	
	return $json;
}

function markuse($pc_type)
{
	//markparserurl();

	//echo "<br>";
	//echo $pc_type;

	//echo "<br>";
	$datetime = date("Y-m-d H:i:s");
	//echo $datetime;
	//echo "<br>";

	$myfile = fopen("/var/www/html/mac_system/mac.txt", "r") or die("Unable to open file!");
	$filemac = fread($myfile,filesize("/var/www/html/mac_system/mac.txt"));
	fclose($myfile);

	//echo $filemac;
	//echo "<br>";

	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$dbname = "mac_system";
 
	// 创建连接
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
    	die("连接失败: " . mysqli_connect_error());
	}

	$marksqlhead = "UPDATE mac_table SET";
	$marksqltime = " handle_time =";
	$makesqluseflag = " use_flag = \"1\"";
	$makesqlpctype = " pc_type =";
	$marksqlmind = " WHERE mac=";
	//$marksql = $marksqlhead.$datetime.$filemac";

	$marksql = $marksqlhead.$marksqltime."\"".$datetime."\"".",".$makesqluseflag.",".$makesqlpctype."\"".$pc_type."\"".$marksqlmind."\"".$filemac."\"";

	//echo $marksql;
	//echo "<br>";

	if(mysqli_query($conn, $marksql))
	{
		$sqlinsertflag = 0;	
	}
	else
	{	
		$sqlinsertflag = 1;	
	}

	mysqli_close($conn);

	echo markuse2json($sqlinsertflag);
}

function callotmac2json($mac)
{
	$arr =array();

	if(17 == strlen($mac))
	{
		$arr["macinfo"]["mac"] = $mac;
		$arr["macinfo"]["stat"] = "success";
	}
	else
	{
    	$arr["macinfo"]["mac"] = "0";
    	$arr["macinfo"]["stat"] = "fail";
	}

	$json = json_encode($arr);	
	
	return $json;
}

function macallot()
{
	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$dbname = "mac_system";
 
	// 创建连接
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
    	die("连接失败: " . mysqli_connect_error());
	}
 
	$sql = "SELECT mac_id, mac, use_flag FROM mac_table WHERE use_flag=0;";
	$result = mysqli_query($conn, $sql);
 
	if (mysqli_num_rows($result) > 0) 
	{
    	// 输出数据
    	while($row = mysqli_fetch_assoc($result)) 
		{
        	//echo "mac_id: " . $row["mac_id"]. " - mac: " . $row["mac"]. " - use_flag" . $row["use_flag"]. "<br>";
			
			$myfile = fopen("/var/www/html/mac_system/mac.txt", "w") or die("Unable to open file!");
			$txt = $row["mac"];
			fwrite($myfile, $txt);
			fclose($myfile);

			echo callotmac2json($row["mac"]);

			break;
    	}
	}
	else 
	{
		echo callotmac2json(0);
	}
 
	mysqli_close($conn);
}

$q = isset($_GET["q"]) ? intval($_GET["q"]) : '';

if(empty($q)){
	//echo "exit 1....";
	exit;
}

//echo "<br>";
//echo $q;

$p = $_GET["pc_type"];

if(empty($p))
{
	//echo "exit 2....";
	exit;
}

//echo "<br>";
//echo $p;

if(1 == $q)
{
	//echo "<br>";	
	macallot();
}
else if(2 == $q)
{	
	//echo "<br>";
	markuse($p);
}

?>




















