$(document).ready(function() {

    $("#btnAñadirCate").click(function() {
        añadirCate();
    });

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

function añadirCate() {
    $.ajax({
        type: "POST",
        data: $("#frmAñadirCate").serialize(),
        url: "php/crearCurso/añadirCategoria.php",
        success: function(r) {
            switch (r) {
                case "1":
                    $("#frmAñadirCate")[0].reset();
                    $("#btnCerrarAct").trigger("click");
                    swal(
                        "Agregado con éxito",
                        "Nueva categoría agregada",
                        "success"
                    ).then((value) => {
                        window.location = "crearcurso.php";
                    });
                    break;
                case "2":
                    swal("Categoría ya existente", "Favor de ingresar con otro", "error");
                    break;
                case "3":
                    swal("Campos vacíos", "Favor de llenar todos los campos", "error");
                    break;
                default:
                    swal("Eror al añadir categoría", "Favor de intentarlo más tarde", "error");
                    break;
            }
        },
    });
}

function agregarCurso() {
    $.ajax({
        type: "POST",
        data: $("#frmCurso").serialize(),
        url: "php/crearCurso/crearCurso.php",
        success: function(r) {
            switch (r) {
                case "1":
                    $("#frmCurso")[0].reset();
                    swal("Curso creado", "Curso creado con éxito", "success").then(
                        () => {
                            window.location = "crearNivel.php";
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
                case "6":
                    swal("Imagen vacía", "Ingrese una imagen para el nuevo curso", "error");
                    break;
                default:
                    $("#frmCurso")[0].reset();
                    swal("Curso creado", "Curso creado con éxito", "success").then(
                        () => {
                            window.location = "crearNivel.php";
                        }
                    );
                    break;
            }
        },
    });
    return false;
}