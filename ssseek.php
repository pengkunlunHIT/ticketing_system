<html>
<head>
<title>查询车次</title>
</head>

<body>
<body background=1.jpg>
<br/>

<form name="seekstation" action="" method="post">
 起始车站: 
<input type="text" name="startstation" />
到达车站： 
<input type="text" name="endstation" /><input type="submit" name="submit" value="查询" />
</form>

<?php
 if ( !empty( $_POST["submit"] ) ) 
{
$station=$_POST['station'];
 if (!$startstation||!$endstation) 
{ 
	echo "车站不能为空！";
 }
else
{

$mysqluser="root";
$mysqlpass="fighting";
$dbname="software4";
$db_connect=mysql_connect('localhost',$mysqluser,$mysqlpass);
mysql_query("set names 'gbk'");

if(!$db_connect)
{
	echo "数据库连接失败！";
}

$seldb=mysql_select_db($dbname,$db_connect);
$sql=
"select stationName,passStation,train,leavetime,train.time,info,station.distance,train.distance from station INNER JOIN train ON(station.train=train.trainNumber AND station.id<train.id)";

$result=mysql_query($sql,$db_connect);
echo "</br>";
	
	
	echo "</br>";
 echo " $startstation 到 $endstation 的车次如下</font>：";
	
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
	echo "<td> 起始站 </td>";
	echo "<td> 到达站&nbsp;</td>";
	echo "<td> 车次 </td>";
	echo "<td>出发时间</td>";
	echo "<td>到达时间</td>";
	echo "<td>里程数&nbsp;</td>";
	echo "<td>车次信息</td>";
	
	echo"</tr>";
	while($rows = mysql_fetch_row($result)){
	$lenth=$rows[7]-$rows[6];
	if($rows[0]==$startstation&&$rows[1]==$endstation){
		echo "<tr>";
		for($i = 0; $i<5; $i++)
			echo "<td>".$rows[$i]."</td>";
			echo "<td>".$lenth."</td>";
			echo "<td>".$rows[5]."</td>";
	}
	}
	echo "</tr></table>";
	}
}
?>
</body>
</html>