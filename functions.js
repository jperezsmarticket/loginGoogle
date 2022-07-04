var identpe = "N";

$(document).ready(() => {
// Funcion onChange del select tipo de identificacion para validar el limite de caracteres
var txtIdentificacion = document.querySelector("#identificacion");
const selectid_identificacion = document.querySelector("#id_identificacion");
txtIdentificacion.setAttribute("placeholder", "Consta de 9 dígitos numéricos");
txtIdentificacion.setAttribute("maxlength", "9");
txtIdentificacion.setAttribute("minlength", "9");
$("#identificacion").on({
    keydown: (e) => {
        return (e.key.length != 1 || 1 + e.key.search(/^[0-9]/)) ? true : false;
    },
    paste: function(e) {
        return false;
    }
});

selectid_identificacion.onchange = function(e) {
    txtIdentificacion.value = "";

    switch (selectid_identificacion.value) {
        case '1': //NACIONAL
            txtIdentificacion.setAttribute("placeholder", "Consta de 9 dígitos numéricos");
            txtIdentificacion.setAttribute("maxlength", "9");
            txtIdentificacion.setAttribute("minlength", "9");
            identpe = "N";
            $("#identificacion").unbind("keydown");
            $("#identificacion").on({
                keydown: (e) => {
                    return (e.key.length != 1 || 1 + e.key.search(/[0-9]/)) ? true : false;
                },
                paste: function(e) {
                    return false;
                }
            });
            break;

        case '2': //DIMEX
            txtIdentificacion.value = "";
            txtIdentificacion.setAttribute("placeholder", "Consta de 11/12 dígitos numéricos");
            txtIdentificacion.setAttribute("maxlength", "12");
            txtIdentificacion.setAttribute("minlength", "11");
            identpe = "N";
            break;

        case '3': //PASAPORTE
            txtIdentificacion.setAttribute("placeholder", "Digite únicamente alfanuméricos");
            txtIdentificacion.setAttribute("maxlength", "50");
            txtIdentificacion.setAttribute("minlength", "7");
            identpe = "A";
            $("#identificacion").unbind("keydown");
            $("#identificacion").on({
                keydown: (e) => {
                    return (e.key.length != 1 || 1 + e.key.search(/[a-zA-Z0-9]/)) ? true : false;
                },
                paste: function(e) {
                    return false;
                }
            });
            break;

        case '0': //DEFAULT
            txtIdentificacion.removeAttribute("placeholder");
            txtIdentificacion.value = "";
            break;
    }
}

function val() {
    var ok = true;

    // En caso de que el usuario no escoja algun tipo de identificación, envíe un error
    var id_identificacion = document.querySelector("#id_identificacion");
    if (id_identificacion.value === 0) {
        swal("Error", "Seleccione un tipo de identificación", "error");
        ok = false;
        return false;
    }

    if (jQuery("#identificacion").val().length > jQuery("#identificacion").attr("maxlength") || jQuery("#identificacion").val().length < jQuery("#identificacion").attr("minlength")) {
        swal("Error", "La identificación debe estar compuesta por mínimo " + jQuery("#identificacion").attr("minlength") + " y máximo " + jQuery("#identificacion").attr("maxlength") + " caracteres.", "error");
        ok = false;
        return false;
    }

    // if (jQuery("#correo").val() != jQuery("#correo2").val()) {
    //     swal("Error", "Los correos electrónicos no coinciden, por favor revise que ambos correos sean iguales", "error");
    //     ok = false;
    //     return false;
    // }

    if (jQuery("#clave").val() != jQuery("#clave2").val()) {
        swal("Error", "las claves/contraseñas no coinciden, por favor revise que ambas claves sean iguales", "error");
        ok = false;
        return false;
    }

    switch (identpe) {
        case "N":
            if (!jQuery.isNumeric($('#identificacion').val())) {
                swal("Error", "El valor ingresado en la identificación no cumple con el tipo de identificación especificado", "error");
                ok = false;
                return false;
            }
            break;
    }

    jQuery("#frmForm :input,#frmForm select").each(function() {
        if (jQuery(this).attr('type') == 'checkbox') {
            if (!jQuery(this).prop('checked')) {
                swal("Error", "Debe aceptar los términos y condiciones y la politica de privacidad", "error");
                ok = false;
                return false;
            }
        } else {
            if (jQuery(this).val() == "") {
                swal("Error", "Debe completar todos los campos antes de continuar", "error");
                ok = false;
                return false;
            }
        }
    });

    if (ok) {
        document.getElementById("frmUser").submit();
    }
}

})