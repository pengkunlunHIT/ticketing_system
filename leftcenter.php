<?php  session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

<title>top</title>
</head>

<body>
<body background=3.jpg>
<br/>

<?php
if ( !empty ( $_GET["action"] ) )
{
  session_unset();
  session_destroy();
  echo "�ɹ��˳����ټ���";
  echo "<a href='leftcenter.php'>�ص���ҳ</a>";
  exit;
 }
?>


<?php
if ( empty( $_POST["submit"] )&&empty($_SESSION ) )
{
?>

<form name="input" action="" method="post">
�û�: <input type="text" name="username" /></br>
���룺<input type="password" name="password" /></br>&nbsp;&nbsp;
<input type="submit" name="submit" value="��½" />&nbsp;&nbsp;   
<a href="reg.php" target="mainFrame">ע��</a>
</form>

<?php
} 
//target="mainFrame"
else 
{


	if ( !empty ( $_SESSION ) )
	{
		//print_r $_SESSION;
		echo $_SESSION["user"];
	//	echo "!empty ( $_SESSION )";
		
          
		 $str=$_SESSION["user"];
		echo "��ӭ�㣬$str!";
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<table border=0><tr>";
		echo "<td><a href='getinfo.php' target='mainFrame'>&nbsp;&nbsp;������Ϣ</a></td>";
	    echo"</tr>";
		 echo"<tr>";
		 echo "<td><a href='repass.php' target='mainFrame'>&nbsp;&nbsp;�޸�����</a></td>";
		  echo"</tr>";
		  echo"<tr>";
		  echo "<td><a href='bookinfo.php' target='mainFrame'>&nbsp;&nbsp;�����¼</a></td>";
		echo"</tr>"; 
			echo"<tr>";
		   	echo"<td><a href='leftcenter.php?action=logout'>&nbsp;&nbsp;�˳���¼</a></td>";
			 echo"</tr>"; 
	}
	else
//	if(empty)
	{
		$username=$_POST['username'];
		$password=$_POST['password'] ;

		$mysqluser="root";
		$mysqlpass="fighting";
		$dbname="software4";
		$tablename="customer";

		$db_connect=mysql_connect('localhost',$mysqluser,$mysqlpass);
		mysql_query("set names 'gbk'");

		if(!$db_connect)
		{
			echo"���ݿ����Ӳ��ɹ�!";
		}


		$seldb=mysql_select_db($dbname,$db_connect);


		//�����ݿ��м����û����������Ƿ�ƥ��
		$sql = "SELECT * FROM  customer
			  WHERE name='$username' AND password='$password'";
		
		echo "<br>";
		$result = mysql_query($sql);
		$num_rows = mysql_num_rows($result);
		echo "<br>";

		if($num_rows == 1)
		{       
		   $_SESSION["user"] = $username;
		   
			echo "��ӭ�㣬$username!";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<table border=0><tr>";
			echo "<td><a href='getinfo.php' target='mainFrame'>&nbsp;&nbsp;������Ϣ</a></td>";
			echo"</tr>";
			 echo"<tr>";
			 echo "<td><a href='repass.php' target='mainFrame'>&nbsp;&nbsp;�޸�����</a></td>";
			  echo"</tr>";
			  echo"<tr>";
			  echo "<td><a href='bookinfo.php' target='mainFrame'>&nbsp;&nbsp;�����¼</a></td>";
			   echo"</tr>"; 
			   echo"<tr>";
				echo"<td><a href='leftcenter.php?action=logout'>&nbsp;&nbsp;�˳���¼</a></td>";
				 echo"</tr>"; 
		   
		}
		else 
		{
			echo "�û��������������";
			echo '<br>';echo '<br>';echo '<br>';echo '<br>';
			echo '<a href="leftcenter.php" >�ص���ҳ</a>';
		}
	}
		
}  
?>
<br><br><br><br>
<a href="http://www.12306.cn" target=_black>��ʽ�Ĺ�Ʊ��վ</a>

</body>
</html>