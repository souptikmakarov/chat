<?php  
	session_start();
	if (isset($_POST['id']) && isset($_POST['pass'])) {
		$id=htmlspecialchars($_POST['id']);
		$pass=htmlspecialchars($_POST['pass']);
		require_once('config.php');
		$conn=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$query="select username from chat_user where userid='" . $id . "' and password='" . $pass . "'";
		$result=$conn->query($query);
		if($row=$result->fetch_array(MYSQLI_ASSOC)) {
			$_SESSION['name']=$row['username'];
			$_SESSION['id']=$id;
			header('Location: index.php');
		}else{
			echo "Wrong userid or password";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-glyphicons.css">
		<style type="text/css">
			body{
				margin: 50px;
			}
			.form-group{
				width: 500px;
			}
		</style>
	</head>
	<body>
		<form class="form" action="login.php" method="post" name="loginForm">
			<div class="form-group">
				<label for="id">Enter id</label>
				<input type="text" id="id" name="id" placeholder="Enter your id" class="form-control">
			</div>
			<div class="form-group">
				<label for="pass">Enter password</label>
				<input type="password" id="pass" name="pass" placeholder="Enter your password" class="form-control">
			</div>
			<input type="submit" id="login" class="btn btn-primary" value="Login">
		</form>
		<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var form=$(document)[0].forms[0];
				form.addEventListener('submit',check);
				function check(e){
					e.preventDefault();
					
					if(form.id.value.length==0){
						alert('Enter your id');
					}else if(form.pass.value.length==0){
						alert('Enter your password');
					}else{
						form.submit();
					}
				}
			});
		</script>
	</body>
</html>