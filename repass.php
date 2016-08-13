<?php  session_start(); ?>
<html>
<head>

<title>查询车次</title>
</head>
<body>
<body background=1.jpg>
<br/>

<form name="reg" action="" method="post">
新的密码: <input type="password" name="pass1" size=20/></br></br></br></br></br>
重复一次: <input type="password" name="pass2" size=20/></br></br></br></br></br>
<input type="submit" name="submit" value="确定"/>
<input type="reset" name="reset" value="重置">
</form>

<?php
 if ( !empty( $_POST["submit"] ) ) 
{
 if ($pass1!=$pass2) { 
	echo "俩次输入的密码不一致，请重新输入！";
  }
  else{

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

$sql="update customer set password='$pass1'where name='$checkname'";
$result=mysql_query($sql,$db_connect);
 		 if(mysql_affected_rows($db_connect)>0)
		 {
	       echo "密码修改成功！";
		   
		 }
	}
	}
?>
</body>
</html>