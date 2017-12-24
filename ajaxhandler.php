	<?php	
	file_put_contents("1", "1");
	if(!isset($_POST['type'])) die();
	require_once("scripts/db.php");
	require_once("scripts/functions.php");
	$dbh = new PDO('mysql:host='.host.';dbname='.dbname.';charset=UTF8', user, password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	switch($_POST['type'])
	{
		case "del":
		{
			$query = "DELETE FROM `comments` WHERE `id` = ".$_POST['id']." OR `parent` = ".$_POST['id'];
			
			echo $dbh->exec($query);
		}
		
		case "post":
		{
			$data = json_decode($_POST['data']);
			$query = 'INSERT INTO `comments`(`lvl`, `date`, `text`) VALUES (?, ?, ?)';
			
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array(1, date('Y-m-d H:i:s'), $data)) == false) echo 0;		
			$result = getcomments(-1, $dbh);
			
		}
		
		case "comment":
		{
			$data = json_decode($_POST['data']);
			$query = 'INSERT INTO `comments`(`lvl`, `date`, `text`, `parent`) VALUES (?, ?, ?, ?)';			
			$stmt = $dbh->prepare($query);
			if($stmt->execute(array($_POST['lvl'], date('Y-m-d H:i:s'), $data, $_POST['parent'])) == false) echo 0;		
			$result = getcomments(-1, $dbh);
			
		}
	}
	
		?>