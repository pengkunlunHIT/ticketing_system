<html>
<head>

<title>��ѯ����</title>
</head>
<body>
<body background=1.jpg>
</br>

<form name="seektrain" action="" method="post">
������Ҫ��ѯ�ĳ���: 
<input type="text" name="TrainID" />
<input type="submit" name="submit" value="��ѯ" />
</form>

<?php
 if ( !empty($_POST["submit"]) ) 
{
  $Tid=$_POST["TrainID"];
  if (!$Tid) 
  { 
	echo "��������Ҫ��ѯ���Σ�";
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
		echo "���ݿ�����ʧ�ܣ�";
	}

	$seldb=mysql_select_db($dbname,$db_connect);
	$sql="select trainNumber,id,passStation,time,distance from `train` where `trainNumber`='$Tid' ORDER by id";

	$result=mysql_query($sql,$db_connect);
	$num_rows = mysql_num_rows($result);

	if($num_rows==0)
	{
		echo "�Ҳ���������Ϣ�����������룡";
	}
	else
	{
	
		echo "</br>";
		echo "$Tid ���г��������ĳ�վ���£�";
		echo "</br>";

		echo "</br>";
		echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
			echo "<td>&nbsp;����&nbsp;</td>";
			echo "<td>&nbsp;վ�����&nbsp;</td>";
			echo "<td>&nbsp;;��վ��&nbsp;</td>";
			echo "<td>&nbsp;����ʱ��&nbsp;</td>";
			echo "<td>&nbsp;���&nbsp;</td>";
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