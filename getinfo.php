<?php  session_start(); ?>
<html>
<head>
	<title>��ѯ����</title>
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
	echo "���ݿ�����ʧ�ܣ�";
}

$seldb=mysql_select_db($dbname,$db_connect);

$sql="select name,realname,id,phone from `customer` where `name`='$checkname'";
$result=mysql_query($sql,$db_connect);

$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
    echo "Error��";
}
else
{
    echo " $checkname �ĸ�����Ϣ��";
	echo "</br>";
	echo "</br>";echo "</br>";
	echo "</br>";echo "</br>";
	echo "</br>";
	
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
		echo "<td>&nbsp;�û���&nbsp;</td>";
		echo "<td>&nbsp;����&nbsp;</td>";
		echo "<td>&nbsp;���֤&nbsp;</td>";
		echo "<td>&nbsp;�绰&nbsp;</td>";
	echo"</tr>";
	
	while($rows = mysql_fetch_row($result))
	{
		echo "<tr>";
		for($i = 0; $i < count($rows); $i++)
			echo "<td>&nbsp;".$rows[$i]."</td>";
	}
	echo "</tr></table>";
	}
?>
</body>
</html>