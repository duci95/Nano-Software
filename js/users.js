$(document).ready(function ()
{
    var adminDel = $(".adminDeleteUser");

    adminDel.click(function ()
    {
        var id = $(this).data("id");
        $.ajax({
           url:"https://nanosoftdelux.000webhostapp.com/php/adminDelUser.php",
            method: "post",
            data:{
               id:id,
                btn:"sent"
            },
            success: function (data) {
                
        setTimeout(function () {
            location.reload();
        }, 100);
                alert("Korisnik obrisan");
            },
            error:function () {
                alert("Trenutno ne mozete obrisati korisnika");
            }
        });
    });
});