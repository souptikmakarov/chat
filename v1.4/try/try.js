$.ajax({
    url:"try.php",
    type:"POST",
    data:{
        id:'1305394',
        otherid:'1304071'
    },
    success:function(result){
        var checked_result=JSON.parse(result);
        console.log(checked_result);
        if(checked_result.exists=="yes"){
            console.log("exists");
            console.log(checked_result[0]);
        }else{
            console.log("does not exist");
        }
    }
});