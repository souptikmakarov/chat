<?php
	require_once('config.php');
	$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$user_one=htmlspecialchars($_POST['user_one']);
	$user_two=htmlspecialchars($_POST['user_two']);
	$insert="insert into conversation values('',?,?);";
	$stmt=$conn->prepare($insert);
	$stmt->bind_param("ss",$user_one,$user_two);
	$stmt->execute();
	$stmt->close();

	$query="select cid,user_two from conversation where user_one='".$user_one."' and user_two='".$user_two."'";
	$result=$conn->query($query);
	$toparse=array();	
	while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
		$toparse[]=$row;
	}
	print json_encode($toparse);
?>