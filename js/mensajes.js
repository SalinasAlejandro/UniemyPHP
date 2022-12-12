$(document).ready(function() {
    var idEstudiante = $("#idEstudiante").val();
    var idEscuela = $("#idEscuela").val();
    var emisor = $("#emisor").val();
    $("#mensajesMostrar").load("mensajesMostrar.php?idEstudiante=" + idEstudiante + "&idEscuela=" + idEscuela + "&emisor=" + emisor);
});

$("#submit").click(function() {
    var value = document.getElementById("mensaje").value;

    if (value === "") {} else {
        $.ajax({
            type: "POST",
            data: $("#frmMensaje").serialize(),
            url: "php/mensajes/enviarMensaje.php",
            success: function(r) {
                switch (r) {
                    case "1":
                        $("#frmMensaje")[0].reset();
                        var idEstudiante = $("#idEstudiante").val();
                        var idEscuela = $("#idEscuela").val();
                        var emisor = $("#emisor").val();
                        $("#mensajesMostrar").load("mensajesMostrar.php?idEstudiante=" + idEstudiante + "&idEscuela=" + idEscuela + "&emisor=" + emisor);
                        break;
                    default:
                        swal("Error al enviar", "Inténtelo de nuevo", "error");
                        break;
                }
            },
        });
        return false;
    }
    return false;
});