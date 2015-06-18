<?php  
	require_once('config.php');
	$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	date_default_timezone_set('Asia/Kolkata');
	$time=date("g:i A");
	if (isset($_POST['sender']) && isset($_POST['cid']) && isset($_POST['message']) && $_POST['message']!="") {
		$sender=htmlspecialchars($_POST['sender']);
		$cid=htmlspecialchars($_POST['cid']);
		$msg=htmlspecialchars($_POST['message']);
		$insert="insert into messages values('',?,?,?,?);";
		$stmt=$conn->prepare($insert);
		$stmt->bind_param("isss",$cid,$msg,$sender,$time);
		$stmt->execute();
		$stmt->close();
	}
?>