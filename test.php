	


<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title> just test </title>
		<link rel="stylesheet" href="css/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/main.js"></script>		
	</head>
	
<?php
	
	require_once("scripts/db.php");
	$dbh = new PDO('mysql:host='.host.';dbname='.dbname.';charset=UTF8', user, password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	require_once("scripts/functions.php");
?>

	<form name = "newcomment">
		<textarea id = "textAreaNewComment"></textarea>
		<button onClick="NewPost()" id="btnPost">New Post</button>
	</form>
	
	<?php		
		getcomments(-1, $dbh);
	?>


</html>