<?php

$q = $_GET["q"];

if(empty($q)) {
    echo "输入的添加MAC的URL为空!";
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

	$count=0;

	while($row = mysqli_fetch_array($result))
	{
		$count++;
	}

	echo "<table border='1'>
	<tr>
	<th>MAC地址添加执行结果</th>
	</tr>";

	echo "<tr>";
	if($count == 0)
	{
		$sql="INSERT INTO mac_table (mac) VALUES (\"$q\")";

		if(mysqli_query($con,$sql)){
			echo "<td>"."MAC地址 : ".$q."添加成功 !"."</td>";
		}else{
			echo "<td>"."MAC地址 : ".$q."添加失败,已存在,请勿重复添加 !"."</td>";
		}
	}
	else{
		echo "<td>"."MAC地址 : ".$q."添加失败,已存在,请勿重复添加 !"."</td>";
	}

	echo "</tr>";
	echo "</table>";

	mysqli_close($con);
}

?>










