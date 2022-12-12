$(document).ready(function() {

    var idNivel = $("#idNivel").val();
    var creador = $("#creador").val();
    $("#tablaMultimedia").load(
        "tablaMultimedia.php?idNivel=" + idNivel + "&creador=" + creador
    );

    $("#btnGuardarArchivos").click(function() {
        agregarArchivosGestor();
    });

    $("#btnFinalizarCurso").click(function() {
        finalizarCurso();
    });

});

function agregarArchivosGestor() {
    var formData = new FormData(document.getElementById("frmArchivos"));
    $.ajax({
        url: "php/nivel/guardarArchivos.php",
        type: "POST",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            switch (r) {
                case "1":
                    $("#frmArchivos")[0].reset();
                    var idNivel = $("#idNivel").val();
                    var creador = $("#creador").val();
                    $("#tablaMultimedia").load(
                        "tablaMultimedia.php?idNivel=" + idNivel + "&creador=" + creador
                    );
                    swal("Agregado con éxito", ":D", "success");
                    break;
                case "2":
                    swal("Descripción vacía", "Favor de añadir una descripción", "error");
                    break;
                case "3":
                    swal("No hay archivo", "Favor de añadir un archivo", "error");
                    break;
                default:
                    swal("Error al agregar", ":(", "error");
                    break;
            }
        },
    });
}

function eiminarArchivo(idMulti) {
    swal({
        title: "¿Estás seguro de eliminar este archivo?",
        text: "Una vez eliminado no se podrá recuperar",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                data: "idMulti=" + idMulti,
                url: "php/nivel/eliminarArchivo.php",
                success: function(r) {
                    if (r == 1) {
                        var idNivel = $("#idNivel").val();
                        var creador = $("#creador").val();
                        $("#tablaMultimedia").load(
                            "tablaMultimedia.php?idNivel=" + idNivel + "&creador=" + creador
                        );
                        swal("Eliminado con éxito", {
                            icon: "success",
                        });
                    } else {
                        swal("Error al eliminar", {
                            icon: "error",
                        });
                    }
                },
            });
        }
    });
}

function finalizarCurso() {
    $.ajax({
        type: "POST",
        data: {
            idEstudianteCer: $("#idEstudianteCer").val(),
            idCursoCer: $("#idCursoCer").val(),
        },
        url: "php/certificado/crearCertificado.php",
        success: function(r) {
            switch (r) {
                case "1":
                    window.location = "certificado.php?Curso=" + $("#idCursoCer").val();
                    break;
                default:
                    swal("Algo salió mal", "Favor de intentarlo más tarde", "error");
                    break;
            }
        },
    });
    return false;
}