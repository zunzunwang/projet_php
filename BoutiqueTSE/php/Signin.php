<?php
ob_start();
include("Link.php");
if($_COOKIE['cookie']!='ok'){
	include("../html/Signin.html");
if($_GET[out]){
	setcookie("cookie", "out");
	echo "<script language=\"javascript\">location.href='Signin.php';</script>";
}
if($_POST[user]!=null){
	$user_query=mysql_query("SELECT * FROM `UserList` WHERE `uid`= '$_POST[user]'",$link);
	$array_result=mysql_fetch_array($user_query);
 	if($_POST[user]==$array_result['uid']&&$_POST[mdp]==$array_result['mdp']){
 		if ($_POST[remember]=="on"){
 			setcookie("cookie", "ok",time()+3600*24*7);
 			echo "<script language=\"javascript\">location.href='./Signin.php';</script>";
 		}else{
 			setcookie("cookie", "ok");
 			echo "<script language=\"javascript\">location.href='Signin.php';</script>";			
 		}
	}
}
?>
<SCRIPT language = javascript>
function CheckSignin()
{
	//定义一个form表单其中名字为signiform 其中的变量名称为user取他的值
	
	if (signinform.user.value==""){
		alert("please fill in your name");
		signinform.user.focus();
		return false;		
	}

	if (signinform.mdp.value==""){
		alert("password can't be empty");
		signinform.mdp.focus();
		return false;		
	}
		
}
</SCRIPT>
<?php
}else{
?>	
<?php
include("../html/index.html");
}
?>