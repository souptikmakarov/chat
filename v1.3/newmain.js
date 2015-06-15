var that;
function Controller() {
	$('#send').on('click',this.sendMessage);
	var messageLoader;
	that=this;
}

Controller.prototype.startLoading=function(){
	messageLoader=setInterval(this.getMessages,2000);
}

Controller.prototype.stopLoading=function(){
	clearInterval(messageLoader);
}

Controller.prototype.createMessageNode=function(msg,sender,time,mid){
	var newMessage;
	if(sender==sessionStorage.getItem('userid')){
		newMessage="<div class='message-sent' id='"+mid+"'>"+msg+"<span class='time'>"+time+"</span></div>";
	}else{
		newMessage="<div class='message-recv' id='"+mid+"'>"+msg+"<span class='time'>"+time+"</span></div>";
	}
	sessionStorage.setItem('lastMessage',mid);
	$('.chat-messages').append(newMessage);
}
Controller.prototype.getMessages=function(){
	
	if(sessionStorage.getItem('lastMessage')==null){
		sessionStorage.setItem('lastMessage',0);
	}
	
	$.ajax({
		url:"getmessages.php",
		type:"POST",
		data:{
			last:sessionStorage.getItem('lastMessage'),
			cid:sessionStorage.getItem('conversationid')
		},
		success:function(result) {
			// console.log();
			var messages=JSON.parse(result);
			for (var i = 0; i < messages.length; i++) {
				that.createMessageNode(messages[i].message,messages[i].sender,messages[i].time,messages[i].mid);
				var cont=document.getElementById('chat-messages');
				cont.scrollTop=cont.scrollHeight;
			};
		}
	});
}

Controller.prototype.sendMessage=function(){
	var messageText=$('#message-text')[0].value;
	$('#message-text')[0].value="";
	$.ajax({
		url:"sendmessage.php",
		type:"POST",
		data:{
			sender:sessionStorage.getItem('userid'),
			cid:sessionStorage.getItem('conversationid'),
			message:messageText
		},
		success:function(result){
			$('#send').attr('disabled','disabled');
			getMessages();
		}
	});
}
