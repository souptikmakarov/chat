<?php  
	$id=htmlspecialchars($_POST['id']);
	require_once('config.php');
	$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$query="select userid,username from chat_user where userid != '" . $id . "'";
	$result=$conn->query($query);
	$toparse=array();
	while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
		$toparse[]=$row;
	}
	print json_encode($toparse);
?>