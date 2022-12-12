$(document).ready(function() {

    $image_crop = $("#image_demo").croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: "circle", //square
        },
        boundary: {
            width: 300,
            height: 300,
        },
    });

    $("#avatar").on("change", function() {
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
                $.ajax({
                    url: "php/perfil/cambiarAvatar.php",
                    type: "POST",
                    data: {
                        image: response,
                    },
                    success: function(data) {
                        window.location = "perfil.php";
                    },
                });
            });
    });

    $(".cerrar").click(function() {
        $("#uploadimageModal").modal("hide");
    });

    $("#btnActualizarPerfil").click(function() {
        actualizarPerfil();
    });

    $("#btnBorrar").click(function() {
        swal({
            title: "¿Está seguro de eliminar su cuenta?",
            text: "Se perderá todos los cursos, diplomas y progesos que haya hecho",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "php/perfil/borrarPerfil.php",
                    success: function(r) {
                        switch (r) {
                            case "1":
                                swal("Borrado con exito", "Le extrañaremos", "success").then(
                                    () => {
                                        window.location = "iniSesion.php";
                                    }
                                );
                                break;
                            default:
                                swal("Error al borrar", "Inténtelo más tarde", "error");
                                break;
                        }
                    },
                });
            }
        });
    });

    $(".detallesIngresos").click(function() {
        var id = $(this).next().val();
        $.ajax({
            type: "POST",
            data: { "idCurso": id },
            url: "php/perfil/ingresosCurso.php",
            success: function(r) {
                var array = JSON.parse(r);
                var myNumeral = numeral(array["total"]);
                var currencyString = myNumeral.format('$0,0.00');


                $("#tituloIngresos").text(array["titulo"]);
                $("#ventasCurso").text(array["ventas"]);
                $("#tIngresos").text(currencyString);
                $("#vEfectivo").text(array["efectivo"]);
                $("#vCredito").text(array["credito"]);
                $("#vDebito").text(array["debito"]);
            },
        });
    });

});

function actualizarPerfil() {
    $.ajax({
        type: "POST",
        data: $("#frmActualizarPerfil").serialize(),
        url: "php/perfil/actualizarPerfil.php",
        success: function(r) {
            switch (r) {
                case "1":
                    $("#frmActualizarPerfil")[0].reset();
                    $("#btnCerrarAct").trigger("click");
                    swal("Editado con éxito", "Sus datos han sido modificado con éxito",
                            "success")
                        .then((value) => {
                            window.location = "perfil.php";
                        });
                    break;
                case "3":
                    swal("Campos vacíos", "Favor de llenar todos los campos", "error");
                    break;
                default:
                    swal("Error al editar", "Algo falló, intente más tarde", "error");
                    break;
            }
        },
    });
}