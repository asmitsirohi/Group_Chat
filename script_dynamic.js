let uni;
var i,txt="",txtnew="",j,temp="";
$(document).ready(function(){

    // $('#msg').emojioneArea({
    //     pickerPosition:"right",
    //     toneStyle: "bullet"
    // });

    setTimeout(function(){
        $.post('name.php',function(response){
            var name = JSON.parse(response);
        
        $.post('message.php',function(response){
            var obj = JSON.parse(response);
            for(i=0;i<obj.length;i++)
            {
                if(obj[i].You!=null){
                    txt += "<b class='text-success'>You</b><br>"+obj[i].You+"<br>"; 
                }else{
                    for(j=0;j<name.length;j++){
                            temp = name[j].nme;
                            if(obj[i][temp] != null){
                                txt += "<b class='text-danger'>"+temp+"</b><br>"+obj[i][temp]+"<br>";
                            }
                            temp="";
                        }
                }
            }
            $("#txtmsg").html(txt);
            
        });
    });
    },1000);

    setTimeout(function(){
        setInterval(function(){
            $.post('name.php',function(response){
                var name1 = JSON.parse(response);
            
            $.post('message.php',function(response){
                var obj = JSON.parse(response);

                for(i=0;i<obj.length;i++)
                {
                    if(obj[i].You!=null){
                        txtnew += "<b class='text-success'>You</b><br>"+obj[i].You+"<br>"; 
                    }else{
                        
                        for(j=0;j<name1.length;j++){
                            temp = name1[j].nme;
                
                            if(obj[i][temp] != null){
                                txtnew += "<b class='text-danger'>"+temp+"</b><br>"+obj[i][temp]+"<br>";
                            }
                            temp="";
                        }
                    }
                }
                if(txtnew.length!=txt.length){
                    $("#txtmsg").html(txtnew);
                }
                txtnew="";
                
            });
        });
        },1000);
        
    },2000);

    $("#clear_chat").click(function(){
        if(confirm("Clear Chat History?")){
            $.post('clear_chat.php',function(response){
                if(response==1){
                    alert("Chat History Cleared");
                    location.reload();
                }else{
                    alert("Chat History Not Cleared");
                }
            });
        }
        
    });

    $("#send").click(function(){
        var msg = $("#msg").val();
        $("#msg").val(" ");
        // var element = $('#msg').emojioneArea();
        // element[0].emojioneArea.setText('');
       
        if(msg.length>0){
            $.post('action.php',{
                msg:msg
            },function(response){
                // if(response==1) {
                //     alert("Message Sent!");
                // }else{
                //     console.log(response);
                // }
                // var x;
                // var myobj1 = JSON.parse(response); 
                // uni=myobj1;
                // console.log(myobj1);
                // $("#textbox").html(response);
                // for(x in myobj.msg){
                //     $("#textbox").html(x);
                // }
                  
                
    
            });
        }
    });

});

