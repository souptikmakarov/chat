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
						<div class="chat-messages" id="chat-messages">
							<!-- <div class="message-recv">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
								<span class="time">10:00 PM</span>
							</div>
							<div class="message-sent">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
								<span class="time">10:02 PM</span>
							</div>
							<div class="message-recv">
								Hey Bro!
								<span class="time">10:04 PM</span>
							</div>
							<div id="0" class="message-sent">
								Yo homie
								<span class="time">10:06 PM</span>
							</div> -->
						</div>
						<textarea id="message-text" placeholder="Type your message"></textarea>
						<button class="btn btn-primary" disabled id="send">Send</button>
					</div>
					<div class="tab-pane" id="new">
						
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