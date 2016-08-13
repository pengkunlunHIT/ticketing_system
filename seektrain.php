<html>
<head>

<title>查询车次</title>
</head>
<body>
<body background=1.jpg>
</br>

<form name="seektrain" action="" method="post">
请输入要查询的车次: 
<input type="text" name="TrainID" />
<input type="submit" name="submit" value="查询" />
</form>

<?php
 if ( !empty($_POST["submit"]) ) 
{
  $Tid=$_POST["TrainID"];
  if (!$Tid) 
  { 
	echo "请输入所要查询车次！";
  }
  else
  {

	$mysqluser="root";
	$mysqlpass="fighting";
	$dbname="software4";
	$tablename="train";

	$db_connect=mysql_connect('localhost',$mysqluser,$mysqlpass);
	mysql_query("set names 'gbk'");

	if(!$db_connect)
	{
		echo "数据库连接失败！";
	}

	$seldb=mysql_select_db($dbname,$db_connect);
	$sql="select trainNumber,id,passStation,time,distance from `train` where `trainNumber`='$Tid' ORDER by id";

	$result=mysql_query($sql,$db_connect);
	$num_rows = mysql_num_rows($result);

	if($num_rows==0)
	{
		echo "找不到车次信息，请重新输入！";
	}
	else
	{
	
		echo "</br>";
		echo "$Tid 次列车所经过的车站如下：";
		echo "</br>";

		echo "</br>";
		echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
			echo "<td>&nbsp;车次&nbsp;</td>";
			echo "<td>&nbsp;站点序号&nbsp;</td>";
			echo "<td>&nbsp;途经站点&nbsp;</td>";
			echo "<td>&nbsp;到达时间&nbsp;</td>";
			echo "<td>&nbsp;里程&nbsp;</td>";
			echo"</tr>";

			while($rows = mysql_fetch_row($result)){
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