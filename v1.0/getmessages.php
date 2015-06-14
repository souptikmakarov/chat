<?php  
	require_once('config.php');
	$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if (isset($_POST['last'])) {
		$last_mid=$_POST['last'];
	}else {
		$last_mid=0;
	}
	
	$query='select * from messages where mid > ' . $last_mid;
	$result=$conn->query($query);
	$toparse=array();
	while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
		$toparse[]=$row;
	}
	print json_encode($toparse);
?>