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
 if (!$startstation||!$endstation) { 
	echo "��վ����Ϊ�գ�";
  }else{

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
$sql="select stationName,passStation,train,leavetime,time,hseat,sseat,ssseat
 from station 
INNER JOIN train ON(train=trainNumber AND station.id<train.id)";

$result=mysql_query($sql,$db_connect);
   
 echo "$startstation �� $endstation �ĳ������£�";
	echo "</br>";
	echo "</br>";
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
	echo "<td>&nbsp;��ʼվ&nbsp;</td>";
	echo "<td>&nbsp;����վ&nbsp;</td>";
	echo "<td>&nbsp;����&nbsp;</td>";
	echo "<td>&nbsp;����ʱ��&nbsp;</td>";
	echo "<td>&nbsp;����ʱ��&nbsp;</td>";
	echo "<td>&nbsp;Ӳ��ʣ��&nbsp;</td>";
	echo "<td>&nbsp;Ӳ��ʣ��&nbsp;</td>";
	echo "<td>&nbsp;����ʣ��&nbsp;</td>";
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