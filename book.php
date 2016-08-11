<?php  session_start(); ?>
<html>

<head>

<title>购买车票</title>
</head>
<body>
<body background=1.jpg>
</br>

<?php 
if ( empty ( $_SESSION ) ) 
{    
  echo "请先登录！";
}
else
  {
  echo"当前用户是："; 
  echo $_SESSION["user"];
  echo "</br>";
 ?>
 
<form name="book" action="" method="post">
出发车站: <input type="text" name="startstation" size=15 />
到达车站: <input type="text" name="endstation" size=15/>
车次: <input type="text" name="trainid" size=8/>
订购张数：
<input type="text" name="num" size=5/>
<input type="radio" name="type" value="hseat" checked="checked" />
硬座<input type="radio" name="type" value="sseat" />
硬卧 <input type="radio" name="type" value="ssseat" />
软卧<input type="submit" name="submit" value="确定" />
</form>

<?php

if ( !empty( $_POST["submit"] ) ) 
{
	if (!$startstation||!$endstation||!$num||!$trainid) { 
		echo "订票信息不能为空！";
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
		echo "数据库连接失败！";
	}
	$seldb=mysql_select_db($dbname,$db_connect);
	$sql="select train.passStation,station.stationName,station.train,train.time,station.leavetime,train.hseat,train.sseat,train.ssseat,train.id,station.id
			from station INNER JOIN train ON(station.train=train.trainNumber AND station.id>train.id)";

    $result=mysql_query($sql,$db_connect);
	
	
    echo "$startstation 到 $endstation 的车次如下：";
	echo "</br>";
	echo "</br>";
	
	echo "<table border=5 cellspacing=8 cellpadding=4  bordercolor=blue bgcolor=white><tr>";
	echo "<th>&nbsp;起始站&nbsp;</th>";
	echo "<td>&nbsp;到达站&nbsp;</td>";
	echo "<td>&nbsp;车次&nbsp;</td>";
	echo "<td>&nbsp;出发时间&nbsp;</td>";
	echo "<td>&nbsp;到达时间&nbsp;</td>";
	echo "<td>&nbsp;硬座剩余&nbsp;</td>";
	echo "<td>&nbsp;硬卧剩余&nbsp;</td>";
	echo "<td>&nbsp;软卧剩余&nbsp;</td>";
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
	
	
	
	
	if($type=='hseat') //硬座
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
	       echo "成功订购硬座票 $num 张";
		   $uname=$_SESSION["user"];
		   for($j=0;$j<$num;$j++) 
		   {     
		         $tnum=250-($rows[5]-$num+$j);
		   		 $sql2 = "INSERT INTO bookform (userid,stationfrom,stationend,Tnumber,TrainID,type)
		         VALUES('$uname', '$rows[0]', '$rows[1]',$tnum,'$rows[2]','硬座')";
                 $result2 = mysql_query($sql2,$db_connect);
		   }
		   
		 }
		 else
		 echo"Error!";
	    }
		else
		{
		 echo "余票不足，订购失败！";
		}
	}
	
	if($type=='sseat')//硬卧
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
	       echo "成功订购硬卧票 $num 张";
		  $uname=$_SESSION["user"];
		   for($k=0;$k<$num;$k++) 
		   {     
		         $tnum1=100-($rows[6]-$num+$k);
		   		 $sql4 = "INSERT INTO bookform (userid,stationfrom,stationend,Tnumber,TrainID,type)
		         VALUES('$uname', '$rows[0]', '$rows[1]',$tnum1,'$rows[2]','硬卧')";
                 $result4 = mysql_query($sql4,$db_connect);
		   }
		   }
		 else
		 echo"Error!";
	    }
		else
		{
		 echo "余票不足，订购失败！";
		}
	}
		
	if($type=='ssseat')//软卧
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
	       echo "成功订购软卧票 $num 张";
		   $uname=$_SESSION["user"];
		   for($m=0;$m<$num;$m++) 
		   {     
		         $tnum2=50-($rows[7]-$num+$m);
		   		 $sql6 = "INSERT INTO bookform (userid,stationfrom,stationend,Tnumber,TrainID,type)
		         VALUES('$uname', '$rows[0]', '$rows[1]',$tnum2,'$rows[2]','软卧')";
                 $result6 = mysql_query($sql6,$db_connect);
		   }
		   
		 }
		 else
		 echo"Error!";
	    }
		else
		{
		 echo "余票不足，订购失败！";
		}
	}
  }
  }
  }
?>

</body>
</html>