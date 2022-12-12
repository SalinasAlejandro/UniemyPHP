$(document).ready(function() {
    var idEstudiante = $("#idEstudiante").val();
    var idCurso = $("#idCurso").val();
    var terminado = $("#terminado").val();
    $("#reseñas").load(
        "reseñas.php?idEstudiante=" +
        idEstudiante +
        "&idCurso=" +
        idCurso +
        "&terminado=" +
        terminado
    );

    $(".btnComprarN").click(function() {
        $("#idNivel").val($(this).attr("value"));
    });

    $("#btnComprarCurso").click(function() {
        comprarCurso();
    });

    $("#btnComprarNivel").click(function() {
        comprarNivel();
    });

    $("#btnAñadirReseña").click(function() {
        añadirReseña();
    });

    $("#btnEditarReseña").click(function() {
        editarReseña();
    });

    $("#btnBaja").click(function() {
        darBaja();
    });

    $("#btnFinalizarCurso").click(function() {
        finalizarCurso();
    });

});

function comprarCurso() {
    $.ajax({
        type: "POST",
        data: $("#frmComprarCurso").serialize(),
        url: "php/verCurso/comprarCurso.php",
        success: function(r) {
            console.log(r);
            if (r == "1") {
                var idCurso = $("#idCurso").val();
                window.location = "verCurso.php?curso=" + idCurso;
            } else {
                swal("Upsss", "Hubo un error, intentelo de nuevo", "error");
            }
        },
    });
}

function comprarNivel() {
    $.ajax({
        type: "POST",
        data: $("#frmComprarNivel").serialize(),
        url: "php/verCurso/comprarNivel.php",
        success: function(r) {
            if (r == "1") {
                var idCurso = $("#idCurso").val();
                window.location = "verCurso.php?curso=" + idCurso;
            } else {
                swal("Upsss", "Hubo un error, intentelo de nuevo", "error");
            }
        },
    });
}

function añadirReseña() {
    $.ajax({
        type: "POST",
        data: $("#frmAñadirReseña").serialize(),
        url: "php/verCurso/añadirReseña.php",
        success: function(r) {
            switch (r) {
                case "1":
                    swal("Agregado con éxito", "Gracias por tu reseña", "success").then(
                        (value) => {
                            window.location = "verCurso.php?curso=" + $("#idCurso").val();
                        }
                    );
                    break;
                default:
                    swal("Error al añadir reseña", "Favor de intentarlo más tarde", "error");
                    break;
            }
        },
    });
}

function editarReseña() {
    $.ajax({
        type: "POST",
        data: $("#frmEditarReseña").serialize(),
        url: "php/verCurso/editarReseña.php",
        success: function(r) {
            switch (r) {
                case "1":
                    swal("Editado con éxito", "Gracias por tu reseña", "success").then(
                        (value) => {
                            window.location = "verCurso.php?curso=" + $("#idCurso").val();
                        }
                    );
                    break;
                default:
                    swal(
                        "Error al añadir reseña",
                        "Favor de intentarlo más tarde",
                        "error"
                    );
                    break;
            }
        },
    });
}

function darBaja() {

    swal({
        title: "¿Está seguro de dar de baja el curso?",
        text: "Aún lo podrán ver las personas que lo han comprado",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                data: { "idCurso": $("#idCurso").val() },
                url: "php/verCurso/darBaja.php",
                success: function(r) {
                    console.log(r);
                    switch (r) {
                        case "1":
                            swal("Operación hecha con éxito", " ", "success").then(
                                (value) => {
                                    window.location = "perfil.php";
                                }
                            );
                            break;
                        default:
                            swal("Uppss...", "Hubo un error, intentelo más tarde", "error");
                            break;
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