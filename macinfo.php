<?php
$q = isset($_GET["q"]) ? intval($_GET["q"]) : '';
 
if(empty($q)) {
    echo "输入的查询MAC使用情况的URL为空!";
    exit;
}

$con = mysqli_connect('localhost','root','123456');
if (!$con)
{
    die('Could not connect: ' . mysqli_error($con));
}
// 选择数据库
mysqli_select_db($con,"mac_system");
// 设置编码，防止中文乱码
mysqli_set_charset($con,"utf8");
 
$sql="SELECT * FROM mac_table";
 
$result = mysqli_query($con,$sql);
 
echo "<table border='1'>
<tr>
<th>已使用数</th>
<th>未使用数</th>
<th>总数</th>
</tr>";
 
$usencount=0;
$unusecount=0;
$count=0;

while($row = mysqli_fetch_array($result))
{
	$count++;

	if($row['use_flag'] == 1)
	{
		$usencount++;
	} 
}

echo "<tr>";
echo "<td>" . $usencount . "</td>";
echo "<td>" . ($count - $usencount) . "</td>";
echo "<td>" . $count . "</td>";
echo "</tr>";
echo "</table>";
 

mysqli_close($con);
?>











































<!--
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>MAC分配系统</title>
</head>
<body>

    <h1>mac分配系统</h1>
   	输入 MAC:
 <?php
 //echo $_POST["macinfo"];
 ?>
	<br>

</body>
</html>
-->
















































