function logear() {
    $.ajax({
        type: "POST",
        data: $("#frmLogin").serialize(),
        url: "php/ingresar.php",
        success: function(r) {
            if (r == 1) {
                window.location = "perfil.php";
            } else {
                swal("Error al entrar", "Verifique el usuario y la contraseña", "error");
            }
        },
    });

    return false;
}