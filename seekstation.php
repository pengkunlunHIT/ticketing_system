<html>
<head>
<title>��ѯ����</title>
<script language="javascipt">
<!--
	alert("��ӭ�㣡");
-->
</script>
</head>

<body>
<body background=1.jpg>
<br/>

<form name="seekstation" action="" method="post">
��������Ҫ��ѯ�ĳ�վ: 
<input type="text" name="station" />
<input type="submit" name="submit" value="��ѯ" />
</form>

<?php
if ( !empty( $_POST["submit"] ) )
{
$station=$_POST['station'];
 if (!$station) { 
	echo "��������Ҫ��ѯ��վ��";
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
	echo "���ݿ�����ʧ�ܣ�";
}
$seldb=mysql_select_db($dbname,$db_connect);

$sql="select stationName,train,info,leavetime from `station` where `stationName`='$station'";
$result=mysql_query($sql,$db_connect);
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
    echo "�Ҳ�����վ��Ϣ�����������룡";
}
else{
echo "</br>";
	echo "</br>";
echo "</br>";
	echo "</br>";
    echo "���� $station ��վ�ĳ������£�";
	echo "</br>";
	echo "</br>";
echo "</br>";
	echo "</br>";
echo "</br>";
	echo "</br>";
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
		echo "<td>&nbsp;վ��&nbsp;</td>";
		echo "<td>&nbsp;����&nbsp;</td>";
		echo "<td>&nbsp;������Ϣ&nbsp;</td>";
		echo "<td>&nbsp;����ʱ��&nbsp;</td>";
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