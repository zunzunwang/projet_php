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
	include("../html/admin.html");
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
	 * 分页功能
	 */
	function _PAGEFT($totle, $displaypg = 10, $url = '') {
	
		global $page, $firstcount, $pagenav, $_SERVER;
	
		$GLOBALS["displaypg"] = $displaypg;//获得每页显示的数量
	
		if($_GET[page]){//先要获得当前发送的page的值否则一直都为第一页
			$page=$_GET[page];
		}
		if (!$page)//如果没有规定page则限定到第一页
			$page = 1;
	
		if (!$url) {
			$url = $_SERVER["REQUEST_URI"];//初始化到默认的地址
		}
	
		//URL分析：
		$parse_url = parse_url($url);//使用parse_url进行数据的分析
		$url_query = $parse_url["query"]; //单独取出URL的查询字串
		if ($url_query) {
			$url_query = ereg_replace("(^|&)page=$page", "", $url_query);
			$url = str_replace($parse_url["query"], $url_query, $url);
			if ($url_query){
				$url .= "&page";
			}
			else{
				$url .= "page";
			}
		} else {
			$url .= "?page";//给url加上page的标签 实际是给后来用get来获取的
		}
		$lastpg = ceil($totle / $displaypg); //最后页，也是总页数
		$page = min($lastpg, $page);//页数要取到是当前也和总页数中最小的一个
		$prepg = $page -1; //上一页
		$nextpg = ($page == $lastpg ? 0 : $page +1); //下一页
		$firstcount = ($page -1) * $displaypg;//分页公式
	
		//开始分页导航条代码：
		$pagenav = "Page $page, Display <B>" . ($totle ? ($firstcount +1) : 0) . "</B>-<B>" . min($firstcount + $displaypg, $totle) . "</B> records, Total $totle records. ";
		echo "<script language=\"javascript\">document.getElementById(\"pager_records\").innerHTML=\"$pagenav\";</script>";
	
		//如果只有一页则跳出函数：
		if ($lastpg <= 1)
			return false;
	
		$pageselect .= " <a href='$url=1'>Home</a> ";
		if ($prepg)
			$pageselect .= " <a href='$url=$prepg'>Previous</a> ";
		else
			$pageselect .= " Previous ";
		if ($nextpg)
			$pageselect .= " <a href='$url=$nextpg'>Next</a> ";
		else
			$pageselect .= " Next ";
		$pageselect .= " <a href='$url=$lastpg'>Last page</a> ";
		echo "<script language=\"javascript\">document.getElementById(\"page\").innerHTML=\"$pageselect\";</script>";
	
	}

	
	
	$result=mysql_query("SELECT * FROM `UserList`");
	$total = mysql_num_rows($result);
	_PAGEFT($total, 10);
	$result = mysql_query("SELECT * FROM `UserList` limit $firstcount, $displaypg ");
	$index=1;
	// 	$result=mysql_query("SELECT `username` FROM `UserList`");
	while($row = mysql_fetch_array($result))
	{
		//  		echo "<script language=\"javascript\">document.getElementById(\"user\").innerHTML=\"$row[username]\";</script>";
		//  		echo $row['username'];
		//  		echo "<br />";
		$user_name = "user$index";
		$user_email = "email$index";
		//  		$user_name=$div_name."_name";
		echo "<script language=\"javascript\">document.getElementById(\"$user_name\").innerHTML=\"$row[username]\";</script>";
		echo "<script language=\"javascript\">document.getElementById(\"$user_email\").innerHTML=\"$row[email]\";</script>";
		//  		echo "<script language=\"javascript\">document.getElementById(\"user\").innerHTML=\"$row[username]\";</script>";
		$index+=1;
	}
	}
?>
	
<SCRIPT language = javascript>
function CheckUpload()
{
	//瀹氫箟涓�釜form琛ㄥ崟鍏朵腑鍚嶅瓧涓簊igniform 鍏朵腑鐨勫彉閲忓悕绉颁负id鍙栦粬鐨勫� id浼樺厛绾уぇ浜巒ame
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