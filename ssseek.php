<html>
<head>
<title>��ѯ����</title>
</head>

<body>
<body background=1.jpg>
<br/>

<form name="seekstation" action="" method="post">
 ��ʼ��վ: 
<input type="text" name="startstation" />
���ﳵվ�� 
<input type="text" name="endstation" /><input type="submit" name="submit" value="��ѯ" />
</form>

<?php
 if ( !empty( $_POST["submit"] ) ) 
{
$station=$_POST['station'];
 if (!$startstation||!$endstation) 
{ 
	echo "��վ����Ϊ�գ�";
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
	echo "���ݿ�����ʧ�ܣ�";
}

$seldb=mysql_select_db($dbname,$db_connect);
$sql=
"select stationName,passStation,train,leavetime,train.time,info,station.distance,train.distance from station INNER JOIN train ON(station.train=train.trainNumber AND station.id<train.id)";

$result=mysql_query($sql,$db_connect);
echo "</br>";
	
	
	echo "</br>";
 echo " $startstation �� $endstation �ĳ�������</font>��";
	
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
	echo "<td> ��ʼվ </td>";
	echo "<td> ����վ&nbsp;</td>";
	echo "<td> ���� </td>";
	echo "<td>����ʱ��</td>";
	echo "<td>����ʱ��</td>";
	echo "<td>�����&nbsp;</td>";
	echo "<td>������Ϣ</td>";
	
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