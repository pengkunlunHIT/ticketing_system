<?php  session_start(); ?>
<html>
<head>

<title>��ѯ����</title>
</head>
<body>
<body background=1.jpg>
<br/>

<form name="reg" action="" method="post">
�µ�����: <input type="password" name="pass1" size=20/></br></br></br></br></br>
�ظ�һ��: <input type="password" name="pass2" size=20/></br></br></br></br></br>
<input type="submit" name="submit" value="ȷ��"/>
<input type="reset" name="reset" value="����">
</form>

<?php
 if ( !empty( $_POST["submit"] ) ) 
{
 if ($pass1!=$pass2) { 
	echo "������������벻һ�£����������룡";
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
	echo "���ݿ�����ʧ�ܣ�";
}
$seldb=mysql_select_db($dbname,$db_connect);

$sql="update customer set password='$pass1'where name='$checkname'";
$result=mysql_query($sql,$db_connect);
 		 if(mysql_affected_rows($db_connect)>0)
		 {
	       echo "�����޸ĳɹ���";
		   
		 }
	}
	}
?>
</body>
</html>