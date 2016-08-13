<html>
<head>
<title>查询车次</title>
<script language="javascipt">
<!--
	alert("欢迎你！");
-->
</script>
</head>

<body>
<body background=1.jpg>
<br/>

<form name="seekstation" action="" method="post">
请先输入要查询的车站: 
<input type="text" name="station" />
<input type="submit" name="submit" value="查询" />
</form>

<?php
if ( !empty( $_POST["submit"] ) )
{
$station=$_POST['station'];
 if (!$station) { 
	echo "请输入所要查询车站！";
  }
  else{

$mysqluser="root";
$mysqlpass="fighting";
$dbname="software4";
$tablename="station";

$db_connect=mysql_connect('localhost',$mysqluser,$mysqlpass);
mysql_query("set names 'gbk'");

if(!$db_connect)
{
	echo "数据库连接失败！";
}
$seldb=mysql_select_db($dbname,$db_connect);

$sql="select stationName,train,info,leavetime from `station` where `stationName`='$station'";
$result=mysql_query($sql,$db_connect);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
    echo "找不到车站信息，请重新输入！";
}
else{
echo "</br>";
	echo "</br>";
echo "</br>";
	echo "</br>";
    echo "经过 $station 火车站的车次如下：";
	echo "</br>";
	echo "</br>";
echo "</br>";
	echo "</br>";
echo "</br>";
	echo "</br>";
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
		echo "<td>&nbsp;站点&nbsp;</td>";
		echo "<td>&nbsp;车次&nbsp;</td>";
		echo "<td>&nbsp;车次信息&nbsp;</td>";
		echo "<td>&nbsp;出发时间&nbsp;</td>";
	echo"</tr>";
	
	while($rows = mysql_fetch_row($result))
	{
		echo "<tr>";
		for($i = 0; $i < count($rows); $i++)
			echo "<td>&nbsp;".$rows[$i]."</td>";
	}
	echo "</tr></table>";
	}
	}
	}
?>
</body>
</html>