<?php
include("Link.php");

if($_POST['submit']){
	$add_query="INSERT INTO `ForumList` (`id`, `uid`, `title`, `content`, `lastdate`, `link`) VALUES ('$_POST[id]','$_POST[user]','$_POST[title]','$_POST[content]',now(),'$_POST[link]')";
	mysql_query($add_query);
	echo "<script language=\"javascript\">alert('you have added a new comment');location.href='Affiche_forum.php';</script>";
}
?>

<SCRIPT language=javascript>
function CheckPost()
{
	if (myform.user.value=="")
	{
		alert("please write your username");
		myform.user.focus();
		return false;
	}
	if (myform.title.value.length<5)
	{
		alert("the title can't less than 5 words");
		myform.title.focus();
		return false;
	}
	if (myform.content.value=="")
	{
		alert("the content can't be empty");
		myform.content.focus();
		return false;
	}
}
</SCRIPT>