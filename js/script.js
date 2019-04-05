$(document).ready(function () {
    function refresh() {
        setTimeout(function () {
            location.reload();
        }, 100);
    }
    $(".cycle1").cycle({
        fx: 'slideX'
    });
    $("span").hide();

    //brisanje proizvoda
    var del = $(".userDelete");
    del.click(function(){
        var id = $(this).data("id");
        $.ajax({
            url: "https://nanosoftdelux.000webhostapp.com/php/userDel.php",
            method:"POST",
            data:{
                id:id,
                btn:"sent"
            },
            success:function(data, xhr){
                refresh();
                alert("Uspešno ste obrisali prozvod iz korpe");
            },
            error:function(xhr, status, error) {
                switch (xhr.status) {
                    case 404:
                        window.location.href = "https://nanosoftdelux.000webhostapp.com/404.php";
                        break;
                    case 500:
                        alert("Izvinjavamo se zbog tehničkih problema");
                        break;
                }
            }
        });
    });
    //kupovina
    var buy = $(".userBuy");
    buy.click(function () {
        var id = $(this).data("id");
        var p = $(this).data("p");
        $.ajax({
            url: "https://nanosoftdelux.000webhostapp.com/php/userBuy.php",
            method:"POST",
            data:{
                id:id,
                p:p,
                btn:"sent"
            },
            success:function(data, xhr){
                refresh();
                alert("Uspešno ste kupili proizvod");

            },
            error:function(xhr, status, error) {
                switch (xhr.status) {
                    case 404:
                        window.location.href = "https://nanosoftdelux.000webhostapp.com/404.php";
                        break;
                    case 500:
                        alert("Izvinjavamo se zbog tehničkih problema");
                        break;
                }
            }
        });
    });
    //korpa
    var card = $(".cart");
    card.click(function(){
        var id = $(this).data("id");
        var p = $(this).data("p");
        $.ajax({
            url: "https://nanosoftdelux.000webhostapp.com/php/userCard.php",
            method:"POST",
            data:{
                id:id,
                p:p,
                btn:"sent"
            },
            success:function(data, xhr){
                refresh();
                alert("Dodali ste proizvod u korpu!");

            },
            error:function (xhr, status, error) {
                switch (xhr.status) {
                    case 404:
                        window.location.href = "https://nanosoftdelux.000webhostapp.com/404.php";
                        break;
                    case 500:
                        alert("Izvinjavamo se zbog tehničkih problema");
                        break;
                }
            }
        });
    });

        var btn = $("#userFeedback");
        btn.click(function () {
            var firstname = $("#imeKontakt");
            var lastname = $("#prezimeKontakt");
            var email = $("#emailKontakt");
            var reFirstnameLastname = /^[A-ZŠĐČĆŽa-zšđžčć\s]{2,25}$/;
            var reEmail = /^[^@\s]{3,25}@[^@\s]{2,8}\.[^@\s]{2,6}$/;
            var errors = [];
            var content = $("#pitanje");
            if(!reFirstnameLastname.test(firstname.val())){
                firstname.css(
                    "border", "1px solid red"
                    );
                firstname.val("");
                errors.push("Ime mora početi velikim slovom");
            }
            else{
                firstname.css("border" ,"1px solid #14a1e2");
            }
            if(!reFirstnameLastname.test(lastname.val())){
                lastname.css({
                    border: "1px solid red"
                });
                lastname.val("");
                errors.push("Prezime mora početi velikim slovom");
            }
            else{
                lastname.css("border", "1px solid #14a1e2");
            }
            if(!reEmail.test(email.val())){
               email.css({
                    border: "1px solid red"
                });
                email.val("");
                errors.push("Email nije u dobrom formatu");
            }
            else{
                email.css("border", "1px solid #14a1e2");
            }
            if(content.val().length < 10){
                content.css({
                    border: "1px solid red"
                });
                content.val("");
                errors.push("Sadrzaj je prekratak ");
            }
            else{
                content.css("1px solid #14a1e2");
            }
            if(errors.length > 0)
                console.log("Greska");
            else {
                $.ajax({
                    url: "https://nanosoftdelux.000webhostapp.com/php/userFeedback.php",
                    method: "POST",
                    data: {
                        ime: firstname.val(),
                        prezime: lastname.val(),
                        email: email.val(),
                        content: content.val(),
                        btn:"sent"
                    },
                    success: function(data, xhr) {
                       $("#kontaktOk").css("display", "");
                    },
                    error: function(xhr, status, error){
                             alert("Izvinjavamo se, trenutno imamo tehničkih problema");
                        }
                });
            }
        });
    });