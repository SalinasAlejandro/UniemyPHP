$(document).ready(function() {

    $image_crop = $("#image_demo").croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 200,
            type: "square", //circle
        },
        boundary: {
            width: 300,
            height: 300,
        },
    });

    $("#imagen").on("change", function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop
                .croppie("bind", {
                    url: event.target.result,
                })
                .then(function() {});
        };
        reader.readAsDataURL(this.files[0]);
        $("#uploadimageModal").modal("show");
    });

    $(".crop_image").click(function(event) {
        $image_crop
            .croppie("result", {
                type: "canvas",
                size: "viewport",
            })
            .then(function(response) {
                $("#cover").val("");
                $("#cover").val(response);
                $("#smlCheck").removeClass("invisible");
                $("#uploadimageModal").modal("hide");
            });
    });

    $(".cerrar").click(function() {
        $("#uploadimageModal").modal("hide");
    });

});

function editarCurso() {
    $.ajax({
        type: "POST",
        data: $("#frmCurso").serialize(),
        url: "php/editarCurso/editar.php",
        success: function(r) {
            console.log(r);
            switch (r) {
                case "1":
                    $("#frmCurso")[0].reset();
                    var idCurso = $("#idCurso").val();
                    swal("Curso editado", "Curso editado con éxito", "success").then(
                        () => {
                            window.location = "verCurso.php?curso=" + idCurso;
                        }
                    );
                    break;
                case "2":
                    swal("Categorías no seleccionadas", "Favor de seleccionar al menos una categoría", "error");
                    break;
                case "3":
                    swal("Faltan datos por llenar", "Favor de ingresar todos los datos", "error");
                    break;
                case "4":
                    swal("Costo no válido", "El costo debe de ser mayor o igual a 0", "error");
                    break;
                case "5":
                    swal("DATOS NO VALIDOS", "Por favor ingrese sólo números en el costo", "error");
                    break;
                default:
                    $("#frmCurso")[0].reset();
                    var idCurso = $("#idCurso").val();
                    swal("Curso editado", "Curso editado con éxito", "success").then(
                        () => {
                            window.location = "verCurso.php?curso=" + idCurso;
                        }
                    );
                    break;
            }
        },
    });
    return false;
}