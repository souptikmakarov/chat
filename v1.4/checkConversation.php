<?php  
	require_once 'config.php';
	$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$id=htmlspecialchars($_POST['id']);
	$otherid=htmlspecialchars($_POST['otherid']);
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