$("#seccionPrecio2").hide();
$("#smlCheck").hide();

$(document).ready(function() {

    $("#ventaIndividual").change(function() {
        if ($("#ventaIndividual").val() == 1) {
            $("#seccionPrecio2").show();
        } else {
            $("#seccionPrecio2").hide();
        }
    });

    $("#videoCurso").on("change", function() {
        $("#smlCheck").show();
    });

});

function editarNivel() {
    var formData = new FormData(document.getElementById("frmNivel"));
    $.ajax({
        url: "php/editarNivel/editarNivel.php",
        type: "POST",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            console.log(r);
            switch (r) {
                case "1":
                    var numNivel = $("#numNivel").val();
                    var idCurso = $("#idCurso").val();
                    $("#frmNivel")[0].reset();
                    swal("Editado con éxito", "Nivel editado con éxito", "success").then(
                        () => {
                            window.location =
                                "nivel.php?curso=" + idCurso + "&numNivel=" + numNivel;
                        }
                    );
                    break;
                case "3":
                    swal("Campos vacíos", "Favor de llenar todos los campos", "error");
                    break;
                case "5":
                    swal("Formato no válido", "Favor de subir sólo vídeos .mp4", "error");
                    break;
                case "6":
                    swal("Costo no válido", "El costo debe de ser igual o mayor a 0.00", "error");
                    break;
                default:
                    swal("Error al agregar", "Inténtelo de nuevo", "error");
                    break;
            }
        },
    });
}