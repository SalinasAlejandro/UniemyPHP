$("#seccionPrecio1").hide();
$("#seccionPrecio2").hide();
$("#smlCheck").hide();
$(document).ready(function() {

    $("#idCurso").change(function() {
        $("#seccionPrecio1").hide();
        $("#seccionPrecio2").hide();
        $("#ventaIndividual").val(0);
        $("#numNivel").val(0);
        if ($("#idCurso").val() >= 0) {
            var formData = new FormData(document.getElementById("frmNivel"));
            $.ajax({
                type: "POST",
                dataType: "html",
                data: formData,
                url: "php/crearNivel/verPrecioCurso.php",
                cache: false,
                contentType: false,
                processData: false,
                success: function(r) {
                    if (r > 0) {
                        $("#seccionPrecio1").show();
                        $("#esCursoGratis").val(0);
                    } else {
                        $("#esCursoGratis").val(1);
                    }
                },
            });
            $.ajax({
                type: "POST",
                dataType: "html",
                data: formData,
                url: "php/crearNivel/verNumNivel.php",
                cache: false,
                contentType: false,
                processData: false,
                success: function(r) {
                    $("#numNivel").val(r);
                    $("#nNivel").val(r);
                },
            });
        }
    });

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

function agregarNivel() {
    var formData = new FormData(document.getElementById("frmNivel"));
    $.ajax({
        url: "php/crearNivel/crearNivel.php",
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
                    swal("Agregado con éxito", "Nivel añadido con éxito", "success").then(
                        () => {
                            window.location =
                                "nivel.php?curso=" + idCurso + "&numNivel=" + numNivel;
                        }
                    );
                    break;
                case "2":
                    swal("Sin curso", "No se ha seleccionado algún curso", "error");
                    break;
                case "3":
                    swal("Campos vacíos", "Favor de llenar todos los campos", "error");
                    break;
                case "4":
                    swal("Sin vídeo", "No se ha cargado ningún vídeo", "error");
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