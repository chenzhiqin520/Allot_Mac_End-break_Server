<?php

$q = $_GET["q"];

if(empty($q)) {
    echo "输入的查询指定MAC使用情况的URL为空!";
    exit;
}

if(strlen($q) == 17){
	$con = mysqli_connect('localhost','root','123456');
	if (!$con)
	{
	    die('Could not connect: ' . mysqli_error($con));
	}
	// 选择数据库
	mysqli_select_db($con,"mac_system");
	// 设置编码，防止中文乱码
	mysqli_set_charset($con, "utf8");

	$sql="SELECT * FROM mac_table WHERE mac = \"$q\"";

	$result = mysqli_query($con,$sql);

	echo "<table border='1'>
	<tr>
	<th>MAC</th>
	<th>机型</th>
	<th>操作时间</th>
	</tr>";

	$count=0;

	while($row = mysqli_fetch_array($result))
	{
			$count++;

			echo "<tr>";
		    echo "<td>" . $row['mac'] . "</td>";

		    if($row['pc_type'] != NULL){
		    	echo "<td>" . $row['pc_type'] . "</td>";
		    }else{
		    	echo "<td>" . "NULL". "</td>";
		    }

		    if($row['handle_time'] == "0000-00-00 00:00:00")
		    {
		    	echo "<td>" . "NULL". "</td>";
		    }else{
		    	echo "<td>" . $row['handle_time'] . "</td>";
		    }
		    echo "</tr>";
	}

	if($count == 0)
	{
		echo "<tr>";
		echo "<td>" . "NULL". "</td>";
		echo "<td>" . "NULL". "</td>";
		echo "<td>" . "NULL". "</td>";
		echo "</tr>";
	}

	echo "</table>";

	mysqli_close($con);
}

?>