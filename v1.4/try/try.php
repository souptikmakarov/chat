<?php  
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'chatown');
	$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$id=$_POST['id'];
	$otherid=$_POST['otherid'];
	$query="select * from conversation where (user_one='".$id."' and user_two='".$otherid."') or (user_one='".$otherid."' and user_two='".$id."')";
	$result=$conn->query($query);
	$toparse=array();
	if ($result->num_rows==0) {
		$toparse["exists"]="no";
	}else{
		$toparse["exists"]="yes";
	}
	while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
		$toparse[]=$row;
	}	
	print json_encode($toparse);
?>