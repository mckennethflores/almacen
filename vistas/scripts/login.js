$("#frmAcceso").on('submit',function(e)
{
    e.preventDefault();
    usu_us=$("#usu_us").val();
    cla_us=$("#cla_us").val();
    rol_id_us = $("#rol_id_us").val();
    /* console.log(rol_id_us); return; */
    $.post("../ajax/usuario.php?op=verificar",
    {
        "usu_us": usu_us,
        "cla_us": cla_us,
        "rol_id_us": rol_id_us
    },
    function (data)
    {
      /*   console.log(data);
        return; */
        if(data!="null")
        {
            $(location).attr("href","escritorio.php");
        }
        else
        {
            bootbox.alert("Usuario y contraseña son incorrectos");
        }
    });
});
function init() {

    $.post("../ajax/login.php?op=selectRol&opselected=selected", function (r) {
        //se cambio el id de login.html
        $("#rol_id_us").html(r);
    });

}
init();