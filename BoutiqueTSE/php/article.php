<?php
ob_start();
if($_COOKIE['cookie']==null||$_COOKIE['cookie']=="out"){
	$url_signIn="../php/signIn.php";
	echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_signIn'</SCRIPT>";
}else{//之前要先验证是不是有保存正确的cookie 否则就要退出
	if($_GET[out]){
		setcookie("cookie", "out");
		echo "<script language=\"javascript\">location.href='signIn.php';</script>";
	}
	
	header("content-type:text/html;charset=utf-8");
	include("Link.php");
	include("../html/article.html");
	/**
	 * gestion_admin
	 */
	if($_COOKIE['cookie']=="admin"){
		//$gestioin_admin="<a class=\"page-scroll\" href=\"../php/admin.php\">admin</a>";
		$gestioin_admin="<a>ADMIN</a>";
		echo "<script language=\"javascript\">document.getElementById(\"gestion_admin\").innerHTML=\"$gestioin_admin\";</script>";
		?>
				<SCRIPT language = javascript>
				function gestion_admin(){
				$('#gestion_admin > a').attr('class',"page-scroll");
				$('#gestion_admin > a').attr('href',"../php/admin.php");
				}		
				</SCRIPT>
			<?php
				echo "<script language=\"javascript\">gestion_admin();</script>";
			}
	$username=$_COOKIE['cookie'];
	$label_username="Welcome: ".$username;
	echo "<script language=\"javascript\">document.getElementById(\"label_username\").innerHTML=\"$label_username\";</script>";
	
	/**
	 * 获取当前使用的数据库表格
	 * @param string $url
	 */
	function _PAGELIST($url = '') {
	
		global $list,$_SERVER,$produit_id;
	
		if($_GET[from_list]){//先要获得当前发送的page的值否则一直都为第一页
			$list=$_GET[from_list];
		}
		if (!$list){//如果没有规定page则限定到第一页
			$url_index="../php/index.php";
			echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_index'</SCRIPT>";
		}
		if($list=='bde')
			$list='Bde_produit_list';
		else 
			$list='Tse_produit_list';
		
		if($_GET[articleId]){//先要获得当前发送的page的值否则一直都为第一页
			$produit_id=$_GET[articleId];
		}
		if (!$produit_id){//如果没有规定page则限定到第一页
			$url_index="../php/index.php";
			echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_index'</SCRIPT>";
		}
	}
	
	/**
	 * 页面处理入口
	 */
	_PAGELIST();//get list
	$result=mysql_query("SELECT * FROM `$list` WHERE `id`= $produit_id;");
	$row=mysql_fetch_array($result);	
	echo "<script language=\"javascript\">document.getElementById(\"produit_name\").innerHTML=\"$row[name]\";</script>";
	echo "<script language=\"javascript\">document.getElementById(\"produit_price\").innerHTML=\"Price: $row[price]€\";</script>";
	
	

}
?>

<SCRIPT language = javascript>
function CheckUpload()
{
	//定义一个form表单其中名字为signiform 其中的变量名称为id取他的值 id优先级大于name
	
	if (Uploadform.name.value==""){
		alert("please fill in your name");
		Uploadform.name.focus();
		return false;		
	}

	if (Uploadform.price.value==""){
		alert("price can't be empty");
		Uploadform.price.focus();
		return false;		
	}
	if (Uploadform.description.value==""){
		alert("description can't be empty");
		Uploadform.description.focus();
		return false;		
	}
		
}
</SCRIPT>