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
  echo "成功退出，再见！";
  echo "<a href='leftcenter.php'>回到主页</a>";
  exit;
 }
?>


<?php
if ( empty( $_POST["submit"] )&&empty($_SESSION ) )
{
?>

<form name="input" action="" method="post">
用户: <input type="text" name="username" /></br>
密码：<input type="password" name="password" /></br>&nbsp;&nbsp;
<input type="submit" name="submit" value="登陆" />&nbsp;&nbsp;   
<a href="reg.php" target="mainFrame">注册</a>
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
		echo "欢迎你，$str!";
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<table border=0><tr>";
		echo "<td><a href='getinfo.php' target='mainFrame'>&nbsp;&nbsp;个人信息</a></td>";
	    echo"</tr>";
		 echo"<tr>";
		 echo "<td><a href='repass.php' target='mainFrame'>&nbsp;&nbsp;修改密码</a></td>";
		  echo"</tr>";
		  echo"<tr>";
		  echo "<td><a href='bookinfo.php' target='mainFrame'>&nbsp;&nbsp;购买记录</a></td>";
		echo"</tr>"; 
			echo"<tr>";
		   	echo"<td><a href='leftcenter.php?action=logout'>&nbsp;&nbsp;退出登录</a></td>";
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
			echo"数据库连接不成功!";
		}


		$seldb=mysql_select_db($dbname,$db_connect);


		//从数据库中检索用户名，密码是否匹配
		$sql = "SELECT * FROM  customer
			  WHERE name='$username' AND password='$password'";
		
		echo "<br>";
		$result = mysql_query($sql);
		$num_rows = mysql_num_rows($result);
		echo "<br>";

		if($num_rows == 1)
		{       
		   $_SESSION["user"] = $username;
		   
			echo "欢迎你，$username!";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<table border=0><tr>";
			echo "<td><a href='getinfo.php' target='mainFrame'>&nbsp;&nbsp;个人信息</a></td>";
			echo"</tr>";
			 echo"<tr>";
			 echo "<td><a href='repass.php' target='mainFrame'>&nbsp;&nbsp;修改密码</a></td>";
			  echo"</tr>";
			  echo"<tr>";
			  echo "<td><a href='bookinfo.php' target='mainFrame'>&nbsp;&nbsp;购买记录</a></td>";
			   echo"</tr>"; 
			   echo"<tr>";
				echo"<td><a href='leftcenter.php?action=logout'>&nbsp;&nbsp;退出登录</a></td>";
				 echo"</tr>"; 
		   
		}
		else 
		{
			echo "用户名或者密码错误！";
			echo '<br>';echo '<br>';echo '<br>';echo '<br>';
			echo '<a href="leftcenter.php" >回到主页</a>';
		}
	}
		
}  
?>
<br><br><br><br>
<a href="http://www.12306.cn" target=_black>正式的购票网站</a>

</body>
</html>