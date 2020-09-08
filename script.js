let uni;
var i,txt="",txtnew="",j,temp="";
$(document).ready(function(){
    // $('#msg').emojioneArea({
    //     pickerPosition:"top",
    //     toneStyle: "bullet"
    // });

    // $('#grpname').emojioneArea({
    //     pickerPosition:"top",
    //     toneStyle: "bullet"
    // });
    
   $("#member").keyup(function(){
        var text = $(this).val();
        if(text!=''){
            $.ajax({
                url:'action.php',
                method:'post',
                data:{data:text},
                success:function(response){
                    $("#show-member").html(response);
                }
            });
        }
        else{
            $("#show-member").html('');
        }
    });
    
    $(document).on('click','a',function(){
        $("#member").val($(this).text());
        $("#show-member").html('');
    });

    $("#participants").click(function(){
        var value_mem = $("#member").val();
        // $("#member").val(" ");
        var value_grp = $("#grpname").val();
        if(value_mem!=''){
            $.post('action.php',{
                vm:value_mem,
                vg:value_grp
            },function(response){
                if(response==-1){
                    document.getElementById('msg').innerHTML="<font color='red'>Already added";
                }else if(response==1){
                    alert("Member Added");
                    $("#grpname").text(value_grp);
                    $("#member").val("");
                }else{
                    alert("Failed");
                }
            });
        }
    });

    $("#new_name").click(function(){
        var new_name = $("#new_grpname").val();
        if(new_name!=''){
            $.post('action.php',{
                new_name:new_name
            },function(response){
                if(response==1)
                    alert("Group Name Changed");
                    window.location = "loggedin.php";
            });
        }
    });

    $("#delete").click(function(){
        var del_member = $("#del_member").val();

        if(del_member!=''){
            $.post('action.php',{
                del_member:del_member
            },function(response){
                if(response==1){
                    alert("Member Deleted");
                    window.location = "loggedin.php";
                }
                
            });
        }
    });

    $("#create_grp").click(function(){
        var value_mem = $("#member").val();
        $("#member").val(" ");
        var value_grp = $("#grpname").val();
        if(value_mem!=''){
            $.post('action.php',{
                cvm:value_mem,
                cvg:value_grp
            },function(response){
                if(response==-1){
                    document.getElementById('msg').innerHTML="<font color='red'>Already added";
                }else if(response==1){
                    alert("Group Created");
                    window.location = "loggedin.php";
                    
                    // $("#grpname").text(value_grp);
                }else{
                    alert("Failed");
                }
            });
        }
    });

    $("#done").click(function(){
        window.location = "loggedin.php";
    });

});