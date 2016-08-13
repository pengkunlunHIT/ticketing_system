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
 if (!$startstation||!$endstation) { 
	echo "车站不能为空！";
  }else{

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
$sql="select stationName,passStation,train,leavetime,time,hseat,sseat,ssseat
 from station 
INNER JOIN train ON(train=trainNumber AND station.id<train.id)";

$result=mysql_query($sql,$db_connect);
   
 echo "$startstation 到 $endstation 的车次如下：";
	echo "</br>";
	echo "</br>";
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
	echo "<td>&nbsp;起始站&nbsp;</td>";
	echo "<td>&nbsp;到达站&nbsp;</td>";
	echo "<td>&nbsp;车次&nbsp;</td>";
	echo "<td>&nbsp;出发时间&nbsp;</td>";
	echo "<td>&nbsp;到达时间&nbsp;</td>";
	echo "<td>&nbsp;硬座剩余&nbsp;</td>";
	echo "<td>&nbsp;硬卧剩余&nbsp;</td>";
	echo "<td>&nbsp;软卧剩余&nbsp;</td>";
	echo"</tr>";

	while($rows = mysql_fetch_row($result)){
	 if($rows[0]==$startstation&&$rows[1]==$endstation){
		echo "<tr>";
		for($i = 0; $i < count($rows); $i++)
			echo "<td>&nbsp;".$rows[$i]."</td>";}
	}
	echo "</tr></table>";
	}
}
?>
</body>
</html>