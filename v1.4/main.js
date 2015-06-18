$(document).ready(function(){
	var id=window.parent.userid;
	var friendToCid=[];
	var instance;

	setInterval(showConversations,5000);

	function getLastMessageId (cid) {
		cid = cid || 0;
		if (cid==0) {
			$('.chat-messages').append("<h4>Please select a conversation</h4>");
		}else{
			var lastMessage=$('.chat-messages').children().last().attr('id');
			if(lastMessage==null){
				lastMessage=0;
			}
			return lastMessage;
		}
	}

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var target = $(e.target).attr("href");
		if ((target == '#main')) {
			var cont=document.getElementById('chat-messages');
			cont.scrollTop=cont.scrollHeight;
		}else if((target == "#conversations")){
			$('.chat-messages').empty();
			sessionStorage.clear();
			instance.stopLoading();
			showConversations();
		}else if((target == "#new")){
			$('.chat-messages').empty();
			sessionStorage.clear();
			instance.stopLoading();
		}
	});

	$('#message-text').on('keyup focus',buttsonstate);
	function buttsonstate () {
		if($('#message-text')[0].value.length!=0){
			$('#send').removeAttr('disabled');
		}else{
			$('#send').attr('disabled','disabled');
		}
	}


	$('.thread-container').on('click',showThread);
	function showThread (e) {
		var element=e.target;
		if(element.getAttribute('class')=="thread-container"){
			return;
		}else if (element.getAttribute('id')==null) {
			var thread=element.parentElement;
		}else{
			var thread=element;
		}
		var friendId=thread.children[1].textContent;
		var cid;
		for (var i = 0; i < friendToCid.length; i++) {
			if(friendToCid[i].friend_id==friendId){
				cid=friendToCid[i].thread_cid;
			}
		};
		var lastMessage= getLastMessageId(cid);
		$('.chat-messages').empty();
		sessionStorage.clear();
		sessionStorage.setItem('userid',id);
		sessionStorage.setItem('conversationid',cid);
		sessionStorage.setItem('lastMessage',lastMessage);
		sessionStorage.setItem('friendId',friendId);
		instance=new Controller();
		instance.getMessages();
		instance.startLoading();
		$('#msgTab').click();
	}
	

	//Lists all the conversations
	showConversations();
	function showConversations(){
		$('.thread-container').empty();
		var friend;
		$.ajax({url:"showConversations.php",type:"POST",data:{id:id},success:function(result){
			var threads=JSON.parse(result);
			for (var i = 0; i < threads.length; i++) {
				if(threads[i].user_one==null){
					friend=threads[i].user_two;
				}else if(threads[i].user_two==null){
					friend=threads[i].user_one;
				}
				friendToCid.push({friend_id:friend,thread_cid:threads[i].cid});
				// console.log(friend);
				$.ajax({url:"getname.php",type:"POST",data:{id:friend},success:function(result_name){
					var org=JSON.parse(result_name);
					var friend_name=org[0].username
					friend=org[0].userid;
					createThreadNode(friend,friend_name);
				}});
			};
		}});
	}
	var threadCount=1
	function createThreadNode (id,name) {
		var newThread="<div class='thread' id='thread"+threadCount+"'><span class='name pull-left'>"+name+"</span>";
		newThread+="<span class='id pull-right'>"+id+"</span></div>";
		$('.thread-container').append(newThread);
		threadCount++;
	}

	//Lists all users
	showUsers();
	function showUsers(){
		var chat_user;
		$.ajax({url:"showUsers.php",type:"POST",data:{id:id},success:function(result){
			var chat_user=JSON.parse(result);
			for (var i = 0; i < chat_user.length; i++) {
				createUserNode(chat_user[i].userid,chat_user[i].username);
			};
		}});
	}
	var userCount=1;
	function createUserNode (id,name) {
		var newUser="<div class='user' id='user"+userCount+"'><span class='name pull-left'>"+name+"</span>";
		newUser+="<span class='id pull-right'>"+id+"</span></div>";
		$('.user-container').append(newUser);
		userCount++;
	}


	//on click of a new user
	$('.user-container').on('click',createNewChat);
	function createNewChat (e) {
		var element=e.target;
		if(element.getAttribute('class')=="user-container"){
			return;
		}else if (element.getAttribute('id')==null) {
			var chat_user=element.parentElement;
		}else{
			var chat_user=element;
		}
		var newFriendId=chat_user.children[1].textContent;
		$.ajax({
			url:"checkConversation.php",
			type:"POST",
			data:{
				id:id,
				otherid:newFriendId
			},
			success:function(result){
				var checked_result=JSON.parse(result);
		        if(checked_result.exists=="yes"){
		            var cid=checked_result[0].cid;
		            var lastMessage= getLastMessageId(cid);
					$('.chat-messages').empty();
					sessionStorage.clear();
					sessionStorage.setItem('userid',id);
					sessionStorage.setItem('conversationid',cid);
					sessionStorage.setItem('lastMessage',lastMessage);
					sessionStorage.setItem('friendId',newFriendId);
					instance=new Controller();
					instance.getMessages();
					instance.startLoading();
					$('#msgTab').click();
		        }else{
		            console.log("does not exist");
		            $.ajax({
		            	url:"createconversation.php",
		            	type:"POST",
		            	data:{
		            		user_one:id,
		            		user_two:newFriendId
		            	},
		            	success:function(result){
		            		var returned_result=JSON.parse(result);
		            		var cid=returned_result[0].cid;
		            		var newFriendId=returned_result[0].user_two;
		            		var lastMessage=getLastMessageId(cid);
		            		$('.chat-messages').empty();
							sessionStorage.clear();
							sessionStorage.setItem('userid',id);
							sessionStorage.setItem('conversationid',cid);
							sessionStorage.setItem('lastMessage',lastMessage);
							sessionStorage.setItem('friendId',newFriendId);
							instance=new Controller();
							instance.getMessages();
							instance.startLoading();
							$('#msgTab').click();
		            	}
		            });
		        }
			}
		});
	}
});