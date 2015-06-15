<?php  
	$id=$_POST['id'];
	require_once('config.php');
	$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$query_one='select cid,user_one from conversation where user_two = ' . $id;
	$result_one=$conn->query($query_one);
	$toparse=array();
	while ($row_one=$result_one->fetch_array(MYSQLI_ASSOC)) {
		$toparse[]=$row_one;
	}

	$query_two='select cid,user_two from conversation where user_one = ' . $id;
	$result_two=$conn->query($query_two);
	while ($row_two=$result_two->fetch_array(MYSQLI_ASSOC)) {
		$toparse[]=$row_two;
	}

	print json_encode($toparse);
?>