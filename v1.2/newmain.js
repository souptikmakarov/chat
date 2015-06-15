function conversation (userid,cid,last_mid,friend) {

	$('#send').on('click',this.sendMessage);
	this.userid=userid;
	this.cid=cid;
	this.last_mid=last_mid;
	this.friend=friend;
	this.messageLoader=setInterval(this.getMessages,2000);

	this.getMessages=function(){
		if(this.last_mid==null){
			this.last_mid=0;
		}
		$.ajax({url:"getmessages.php",type:"POST",data:{last:this.last_mid,cid:this.cid},success:function(result) {
			var messages=JSON.parse(result);
			for (var i = 0; i < messages.length; i++) {
				createMessageNode(messages[i].message,messages[i].sender,messages[i].time,messages[i].mid);
				var cont=document.getElementById('chat-messages');
				cont.scrollTop=cont.scrollHeight;
			};
		}});
	}

	this.createMessageNode=function(msg,sender,time,mid){
		var newMessage;
		if(sender==this.userid){
			newMessage="<div class='message-sent' id='"+mid+"'>"+msg+"<span class='time'>"+time+"</span></div>";
		}else{
			newMessage="<div class='message-recv' id='"+mid+"'>"+msg+"<span class='time'>"+time+"</span></div>";
		}
		this.last_mid=mid;
		$('.chat-messages').append(newMessage);
	}

	this.sendMessage=function(){
		var messageText=$('#message-text')[0].value;
		$('#message-text')[0].value="";
		$.ajax({url:"sendmessage.php",type:"POST",data:{sender:userid,cid:cid,message:messageText},success:function(result){
			$('#send').attr('disabled','disabled');
			getMessages();
		}});
	}
}