<?php  session_start(); ?>
<html>
<head>

<title>查询车次</title>
</head>
<body>
<body background=1.jpg>
<br/>

<?php
	$mysqluser="root";
	$mysqlpass="fighting";
	$dbname="software4";

	$checkname=$_SESSION["user"];

	$db_connect=mysql_connect('localhost',$mysqluser,$mysqlpass);
	mysql_query("set names 'gbk'");

	if(!$db_connect)
	{
		echo "数据库连接失败！";
	}
	$seldb=mysql_select_db($dbname,$db_connect);

	$sql="select * from bookform where userid='$checkname'";
	$result=mysql_query($sql,$db_connect);
	$num_rows = mysql_num_rows($result);
	if($num_rows==0)
	{
		echo "Error！";
	}
	else
	{
    echo " $checkname 的订票记录：";
	echo "</br>";
	echo "</br>";
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
		echo "<td>&nbsp;用户名&nbsp;</td>";
		echo "<td>&nbsp;起始站&nbsp;</td>";
		echo "<td>&nbsp;到达站&nbsp;</td>";
		echo "<td>&nbsp;座位号&nbsp;</td>";
		echo "<td>&nbsp;车次&nbsp;</td>";
		echo "<td>&nbsp;车票类型&nbsp;</td>";
	echo"</tr>";
	
	while($rows = mysql_fetch_row($result))
	{
		//print_r $rows;
		echo "<tr>";
		for($i = 0; $i < count($rows); $i++)
			echo "<td>&nbsp;".$rows[$i]."</td>";
		echo "</tr>";
	}
	echo "</table>";
	}
?>
</body>
</html>