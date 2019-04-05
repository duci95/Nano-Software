$(document).ready(function () {

    $('span').hide();

});

let dugme = $("#btn");

dugme.click(function(){
    let firstLast = $("#firstLast");
    let ID = $("#hidden");
    let username = $("#username");
    let email = $("#email");
    let address = $("#address");
    let reFirstLast = /^([A-ZŠĐČĆŽ][a-zšđčćž]{3,15})(\s[A-ZŠĐČĆŽ][a-zšđčćž]{3,20})+$/;
    let reUsername = /^[a-zšđčćž]{4,10}[0-9]{1,4}$/;
    let reAddress = /^([A-ZŠĐČĆŽ][a-zšđčćž]{3,15})+(\s[A-ZŠĐČĆŽ][a-zšđčćž]{3,20})*(\s([0-9]{1,4}([a-z])?)|(bb))$/;
    let reEmail = /^[^@\s]{3,25}@[^@\s]{2,8}\.[^@\s]{2,6}$/;
    let nizGreske = [];
    let firstLastSpan = $("#firstLastError");
    let usernameSpan = $("#usernameError");
    let addressSpan = $("#addressError");
    let emailSpan = $("#emailError");

    if(!reFirstLast.test(firstLast.val())){
        nizGreske.push("Ime i prezime moraju početi velikim slovom");
        firstLast.css("border" ,"1px solid red");
        console.log("Nije");
        firstLastSpan.css("display", "block");
    }
    else {
        firstLastSpan.css("display", "none");
        console.log("jeste");
        firstLast.css("border", "1px solid rgb(74, 225, 240)");
    }
    if(!reAddress.test(address.val())){
        nizGreske.push("Ime i prezime moraju početi velikim slovom");
        address.css("border" ,"1px solid red");
        console.log("Nije");
        addressSpan.css("display", "block");
    }
    else{
        addressSpan.css("display", "none");
        console.log("jeste");
        address.css("border", "1px solid rgb(74, 225, 240)");
    }
    if(!reUsername.test(username.val())){
        nizGreske.push("Korisničko ime nije u dobrom formatu");
        username.css("border", "1px solid red");
        console.log("Nije");
        usernameSpan.css("display", "block");
    }
    else{
        username.css("border" ,"1px solid rgb(74, 225, 240)");
        usernameSpan.css("display", "none");
        console.log("jeste");
    }
    if(!reEmail.test(email.val())){
        nizGreske.push("Email nije u dobrom formatu");
        email.css("border", "1px solid red");
        console.log("Nije");
        emailSpan.css("display", "block");
    }
    else{
        emailSpan.css("display", "none");
        console.log("jeste");
        email.css("border", "1px solid rgb(74, 225, 240)");
    }
    if(nizGreske.length > 0){
        console.log("Nesto ne valja");
    }
    else{
        $.ajax({
            url:"https://nanosoftdelux.000webhostapp.com/php/userUpdate.php",
            method:"POST",
            data:{
                firstLastName:firstLast.val(),
                address:address.val(),
                usernameName:username.val(),
                emailName:email.val(),
                ID:ID.val(),
                send:"sent"
            },
            success: function(data, xhr){
                $("#feedback201").css("display", "");
                $("#feedback409").css("display", "none");
                $("#feedback500").css("display", "none");
                $("#feedback422").css("display", "none");
            },
            error: function (xhr, status, error) {
                switch(xhr.status) {
                    case 404 :
                        window.location.href="https://nanosoftdelux.000webhostapp.com/404.php";
                        break;
                    case 409:
                        $("#feedback409").css("display", "");
                        username.css("border","1px solid red");
                        break;
                    case 422:
                        $("#feedback422").css("display", "");
                        break;
                    case 500:
                        $("#feedback500").css("display", "");
                        break;
                }
            }
        });
    }
});