$(document).ready(function(){
	getMessages();
	setInterval(getMessages,2000);
	function getMessages () {
		var lastMessage=$('.chat-messages').children().last().attr('id');
		
		$.ajax({url:"getmessages.php",type:"POST",data:{last:lastMessage},success:function(result) {
			var messages=JSON.parse(result);
			for (var i = 0; i < messages.length; i++) {
				createMessageNode(messages[i].message,messages[i].sender,messages[i].time,messages[i].mid);
				var cont=document.getElementById('chat-messages');
				cont.scrollTop=cont.scrollHeight;
			};
		}});
		
	}
	function createMessageNode (msg,sender,time,mid) {
		var newMessage;
		if(sender=="1305394"){
			newMessage="<div class='message-sent' id='"+mid+"'>"+msg+"<span class='time'>"+time+"</span></div>";
		}else{
			newMessage="<div class='message-recv' id='"+mid+"'>"+msg+"<span class='time'>"+time+"</span></div>";
		}
		$('.chat-messages').append(newMessage);
	}

	$('#message-text').on('keyup focus',buttsonstate);
	function buttsonstate () {
		if($('#message-text')[0].value.length!=0){
			$('#send').removeAttr('disabled');
		}else{
			$('#send').attr('disabled','disabled');
		}
	}
	
});