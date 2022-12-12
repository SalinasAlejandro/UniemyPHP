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

function agregarUsuarioNuevo() {
    var special = /[\W]{1,}/;
    special = special.test(document.getElementById("password").value);
    document.getElementById("especial").value = special;
    $.ajax({
        method: "POST",
        data: $("#frmRegistro").serialize(),
        url: "php/registrar.php",
        success: function(r) {
            console.log(r);
            switch (r) {
                case "1":
                    swal("Campos vacíos", "Favor de llenar todos los campos obligarotios*", "error");
                    break;
                case "2":
                    swal("Correo inválido", "Favor de ingresar un correo válido", "error");
                    break;
                case "3":
                    swal("Contraseña inválida", "La contraseña debe tener mínimo 8 caracteres, una mayúscula, una minúscula, 1 caracter especial y un número", "error");
                    break;
                case "4":
                    swal("Bienvenido", "Registrado con éxito", "success").then(
                        () => {
                            window.location = "iniSesion.php";
                        }
                    );
                    break;
                case "5":
                    swal("No hay foto", "Favor de cargar una imagen", "error");
                    break;
                default:
                    swal("Error al agregar", "El Usuario o Correo ya están registrados", "error");
                    break;
            }
        },
    });

    return false;
}