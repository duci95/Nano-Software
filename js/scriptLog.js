$(document).ready(function () {
    $("span").hide();
});
var username = $("#usernameLog");
var password = $("#passwordLog");
var btn = $("#btn");
btn.click(function(){
    var reUsername = /^[a-zšđčćž]{4,10}[0-9]{1,4}$/;
    var rePassword =  /^[A-ZŠĐČĆŽ][a-zšđčćž]{3,10}[0-9]{1,4}$/;
    var errors = [];
    if(!reUsername.test(username.val())){
            errors.push("Korisničko ime nije u dobrom formatu");
            username.css("border", "1px solid red");
            console.log("nijeime");
    }
    else{
        username.css("border" ,"");
    }
    if(!rePassword.test(password.val())){
        console.log("nit je lozinka");
        errors.push("Lozinka nije u dobrom formatu");
        password.css("border", "1px solid red");
    }
    else{
        password.css("border" ,"");
    }
    if(errors.length > 0){
        console.log("");
    }
    else{
        $.ajax({
           url: "https://nanosoftdelux.000webhostapp.com/php/login.php",
           method : "post",
           data:{
               username : username.val(),
               password : password.val(),
               btn : "sent"
           } ,
            success: function(data,xhr){
                $("#feedback200L").css("display", "");
                $("#feedbackError").css("display", "none");
                $("#feedback500L").css("display", "none");
                setTimeout(function () {
                       window.location.href = "https://nanosoftdelux.000webhostapp.com/index.php?page=pocetna";
                   }, 700);
               },
            error:function(xhr,status,error){
                switch(xhr.status){
                    case 404 :
                        $("#feedbackError").css("display", "");
                        break;
                    case 409 :
                        $("#feedbackError").css("display", "");
                        break;
                    case 422 :
                        $("#feedbackError").css("display", "");
                        break;
                    case 403:
                        $("#feedbackError").css("display", "");
                        break;
                    case 500:
                        $("#feedback500L").css("display", "");
                        break;
                    }
            }
        });
    }

});