<?php  session_start(); ?>
<html>

<head>

<title>����Ʊ</title>
</head>
<body>
<body background=1.jpg>
</br>

<?php 
if ( empty ( $_SESSION ) ) 
{    
  echo "���ȵ�¼��";
}
else
  {
  echo"��ǰ�û��ǣ�"; 
  echo $_SESSION["user"];
  echo "</br>";
 ?>
 
<form name="book" action="" method="post">
������վ: <input type="text" name="startstation" size=15 />
���ﳵվ: <input type="text" name="endstation" size=15/>
����: <input type="text" name="trainid" size=8/>
����������
<input type="text" name="num" size=5/>
<input type="radio" name="type" value="hseat" checked="checked" />
Ӳ��<input type="radio" name="type" value="sseat" />
Ӳ�� <input type="radio" name="type" value="ssseat" />
����<input type="submit" name="submit" value="ȷ��" />
</form>

<?php

if ( !empty( $_POST["submit"] ) ) 
{
	if (!$startstation||!$endstation||!$num||!$trainid) { 
		echo "��Ʊ��Ϣ����Ϊ�գ�";
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
	$sql="select train.passStation,station.stationName,station.train,train.time,station.leavetime,train.hseat,train.sseat,train.ssseat,train.id,station.id
			from station INNER JOIN train ON(station.train=train.trainNumber AND station.id>train.id)";

    $result=mysql_query($sql,$db_connect);
	
	
    echo "$startstation �� $endstation �ĳ������£�";
	echo "</br>";
	echo "</br>";
	
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
	echo "<th>&nbsp;��ʼվ&nbsp;</th>";
	echo "<td>&nbsp;����վ&nbsp;</td>";
	echo "<td>&nbsp;����&nbsp;</td>";
	echo "<td>&nbsp;����ʱ��&nbsp;</td>";
	echo "<td>&nbsp;����ʱ��&nbsp;</td>";
	echo "<td>&nbsp;Ӳ��ʣ��&nbsp;</td>";
	echo "<td>&nbsp;Ӳ��ʣ��&nbsp;</td>";
	echo "<td>&nbsp;����ʣ��&nbsp;</td>";
	echo"</tr>";
	
	while($rows = mysql_fetch_row($result))
	{
	 if($rows[0]==$startstation&&$rows[1]==$endstation&&$rows[2]==$trainid){
		echo "<tr>";
		for($i = 0; $i < 8; $i++)
			echo "<td>&nbsp;".$rows[$i]."</td>";
			break;}
	}
	echo "</tr></table>";
	echo "</br>";
	
	
	
	
	if($type=='hseat') //Ӳ��
	{  
	    if($rows[5]>=$num)
		{
		 $sql1="Update train
         Set hseat = hseat-$num
         Where id>=$rows[8] and id<$rows[9] and trainNumber='$rows[2]'";
         $result1=mysql_query($sql1,$db_connect);
		 
		 if(mysql_affected_rows($db_connect)>0)
		 { 	echo "</br>";
		    	echo "</br>";
	       echo "�ɹ�����Ӳ��Ʊ $num ��";
		   $uname=$_SESSION["user"];
		   for($j=0;$j<$num;$j++) 
		   {     
		         $tnum=250-($rows[5]-$num+$j);
		   		 $sql2 = "INSERT INTO bookform (userid,stationfrom,stationend,Tnumber,TrainID,type)
		         VALUES('$uname', '$rows[0]', '$rows[1]',$tnum,'$rows[2]','Ӳ��')";
                 $result2 = mysql_query($sql2,$db_connect);
		   }
		   
		 }
		 else
		 echo"Error!";
	    }
		else
		{
		 echo "��Ʊ���㣬����ʧ�ܣ�";
		}
	}
	
	if($type=='sseat')//Ӳ��
	{  
	    if($rows[5]>=$num)
		{
		 $sql3="Update train
         Set sseat = sseat-$num
         Where id>=$rows[8] and id<$rows[9] and trainNumber='$rows[2]'";
         $result3=mysql_query($sql3,$db_connect);
		 if(mysql_affected_rows($db_connect)>0)
	      { 	echo "</br>";
		    	echo "</br>";
	       echo "�ɹ�����Ӳ��Ʊ $num ��";
		  $uname=$_SESSION["user"];
		   for($k=0;$k<$num;$k++) 
		   {     
		         $tnum1=100-($rows[6]-$num+$k);
		   		 $sql4 = "INSERT INTO bookform (userid,stationfrom,stationend,Tnumber,TrainID,type)
		         VALUES('$uname', '$rows[0]', '$rows[1]',$tnum1,'$rows[2]','Ӳ��')";
                 $result4 = mysql_query($sql4,$db_connect);
		   }
		   }
		 else
		 echo"Error!";
	    }
		else
		{
		 echo "��Ʊ���㣬����ʧ�ܣ�";
		}
	}
		
	if($type=='ssseat')//����
	{  
	    if($rows[5]>=$num)
		{
		 $sql5="Update train
         Set ssseat = ssseat-$num
         Where id>=$rows[8] and id<$rows[9] and trainNumber='$rows[2]'";
         $result5=mysql_query($sql5,$db_connect);
		 if(mysql_affected_rows($db_connect)>0)
		 { 	echo "</br>";
		    	echo "</br>";
	       echo "�ɹ���������Ʊ $num ��";
		   $uname=$_SESSION["user"];
		   for($m=0;$m<$num;$m++) 
		   {     
		         $tnum2=50-($rows[7]-$num+$m);
		   		 $sql6 = "INSERT INTO bookform (userid,stationfrom,stationend,Tnumber,TrainID,type)
		         VALUES('$uname', '$rows[0]', '$rows[1]',$tnum2,'$rows[2]','����')";
                 $result6 = mysql_query($sql6,$db_connect);
		   }
		   
		 }
		 else
		 echo"Error!";
	    }
		else
		{
		 echo "��Ʊ���㣬����ʧ�ܣ�";
		}
	}
  }
  }
  }
?>

</body>
</html>