create table conversation(
	cid int(10) not null primary key auto_increment,
	user_one varchar(20) not null,
	user_two varchar(20) not null,
	foreign key (user_one) references chat_user(userid),
	foreign key (user_two) references chat_user(userid)
)

create table messages(
	mid int(10) not null primary key auto_increment,
	cid int(10) not null,
	message text,
	sender varchar(20) not null,
	time int(11) not null,
	foreign key (cid) references conversation(cid),
	foreign key (sender) references chat_user(userid)
)