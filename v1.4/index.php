<?php  
	session_start();
	if (isset($_SESSION['name'])) {
		$name=$_SESSION['name'];
		$id=$_SESSION['id'];
	}else{
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Chat Room</title>
		<link rel="stylesheet" type="text/css" href="main.css">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-glyphicons.css">
	</head>
	<body>
		<div class="container">
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#conversations" data-toggle="tab">Chats</a></li>
					<li><a href="#main" id="msgTab" data-toggle="tab">Try</a></li>
					<li><a href="#new" data-toggle="tab">New</a></li>
					<li><a href="logout.php" class="pull-right">Logout</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active convs" id="conversations">
						<div class="thread-container"></div>
					</div>
					<div class="tab-pane chat" id="main">
						<div class="chat-messages" id="chat-messages"></div>
						<textarea id="message-text" placeholder="Type your message"></textarea>
						<button class="btn btn-primary" disabled id="send">Send</button>
					</div>
					<div class="tab-pane users" id="new">
						<div class="user-container"></div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="bootstrap.min.js"></script>
		<script type="text/javascript" src="newmain.js"></script>
		<script type="text/javascript" src="main.js"></script>
		<script type="text/javascript">
			userid=<?php echo $id; ?>;
		</script>
	</body>
</html>