$(document).ready(function () {
    var delPro = $(".adminDelete");
    delPro.click(function () {
        var id = $(this).data("id");
        $.ajax({
            url:"php/deleteProduct.php",
            method:"post",
            data:{
                id:id,
                btn:"sent"
            },
            success : function (data) {
                location.reload();
                alert("Uspešno obrisan proizvod iz prodaje");
            },
            error:function () {
                alert("Greška prilikom brisanja iz baze");
            }
        })
    });
});