<?php

//set_time_limit(3000);   //0为无限制

function macaddone($str)
{
    $b = explode(':',$str); 
    $c = implode("", $b);
    $d = trim(strrchr($c, '0'),'0');
    $e = hexdec($d); 
    $e++;
    $f = dechex($e);
    $macadd=str_pad($f,12,"0",STR_PAD_LEFT);   
    $macadd = substr_replace($macadd,":",2,0);
    $macadd = substr_replace($macadd,":",5,0);
    $macadd = substr_replace($macadd,":",8,0);
    $macadd = substr_replace($macadd,":",11,0);
    $macadd = substr_replace($macadd,":",14,0);

    return $macadd;
}

$q = $_GET["q"];
$p = $_GET["p"];

if(empty($q)) {
    echo "输入的添加MAC的URL为空!";
    exit;
}

if(empty($p)) {
    echo "输入的添加MAC的URL为空!";
    exit;
}

echo "<table border='1'>
	<tr>
	<th>MAC段添加执行结果</th>
	<th>MAC段添加成功数量</th>
	<th>MAC段已存在数量</th>
	<th>MAC段添加失败数量</th>
	<th>MAC段添加总数量</th>
	</tr>";

$maccount=0;
$macaddsuccess=0;
$macaddfail=0;
$macaddexist=0;

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

	$p = macaddone($p);

	while($q != $p)
	{
		$maccount++;

		$sql="SELECT * FROM mac_table WHERE mac = \"$q\"";

		$result = mysqli_query($con,$sql);

		$count=0;

		while($row = mysqli_fetch_array($result))
		{
			$count++;
		}

		if($count == 0)
		{
			$sql="INSERT INTO mac_table (mac) VALUES (\"$q\")";

			if(mysqli_query($con,$sql)){
				$macaddsuccess++;
			}else{
				$macaddfail++;
			}
		}
		else{
			$macaddexist++;
		}

		$q = macaddone($q);
	}

	mysqli_close($con);
}

echo "<tr>";
if($macaddsuccess == $maccount)
{
	echo "<td>"."MAC段全部添加成功 !"."</td>";
}
else if($macaddexist == $maccount)
{
	echo "<td>"."MAC段全部已经存在 !"."</td>";
}
else if((0 < $macaddexist) && ($macaddexist < $maccount))
{
	echo "<td>"."MAC段部分添加成功,部分已存在 !"."</td>";
}

echo "<td>".$macaddsuccess."</td>";
echo "<td>".$macaddexist."</td>";
echo "<td>".$macaddfail."</td>";
echo "<td>".$maccount."</td>";
echo "</tr>";
echo "</table>";

?>