<html>
<body>
<body background=1.jpg>
<center>
</br></br></br></br></br></br>
<?php  

	$formdata=array();

	$mysqluser="root";
	$mysqlpass="fighting";
	$dbname="software4";
	$tablename="customer";

	$flag=1;



	
  $id	= $_POST['id'];
  $name	= $_POST['name'];
  $phone= $_POST['phone'];
  $pword= $_POST['pword'];
  $realname=$_POST['realname'];
  
  //检验数据的合法性
  if (!$name||!$id||!$phone||!$pword||!$realname)
  { 
	echo "信息不能为空，请输入完整的个人信息！";
	 $flag=0;
  }

$db_connect=mysql_connect('localhost',$mysqluser,$mysqlpass);
mysql_query("set names 'gbk'");

if(!$db_connect)
{
	echo "数据库连接失败！";
}

if($flag==1)  
{
$seldb=mysql_select_db($dbname,$db_connect);

  $sql1 = "SELECT * FROM $tablename WHERE id='$id'";
  $result1 = mysql_query($sql1);
  $num_rows1 = mysql_num_rows($result1);
  if ($num_rows1 > 0) {
	echo "该身份证已注册！";
	exit;
  }
   $sql2= "SELECT * FROM $tablename WHERE name='$name'";
  $result2 = mysql_query($sql2);
  $num_rows2= mysql_num_rows($result2);
  if ($num_rows2 > 0) {
	echo "该用户名已存在，请重新选择！";
	exit;
  }
  
  //创建用户
  $sql = "INSERT INTO $tablename (id,name,phone,password,realname)
		VALUES('$id', '$name', '$phone', '$pword','$realname')";
  $result = mysql_query($sql);
  if($result)
  {
	?><title>register</title>
	<p>注册成功！请点击<a href="index.php" target=self>这里</a>登录。</p>
	<?php
  }
  else {
	echo "注册失败！";
  }
}
?>
</center>
</body>
</html>