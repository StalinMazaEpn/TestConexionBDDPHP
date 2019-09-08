function isJSON(str) {
    try {
        return (JSON.parse(str) && !!str);
    } catch (e) {
        return false;
    }
}

$(document).ready(function() {

    toastr.options.closeButton = true;
    toastr.options.preventDuplicates = true;
    toastr.options.progressBar = true;
    toastr.success('Have fun storming the castle!', 'Miracle Max Says')


    $("#tipoBDD").on("change", function(e) {
        console.log('cambio select')
        let tipoBDD = $("#tipoBDD").val();
        if (tipoBDD == "mysql") {
            $("#userBDD").val("root")
            $("#passBDD").val("")
        } else if (tipoBDD == "postgresql") {
            $("#userBDD").val("postgres")
            $("#passBDD").val("postgres")
        }
    });


    $('#formConexiones').on("submit", function(e) {


        let parametros = {
            "nameBDD": $("#nameBDD").val(),
            "hostBDD": $("#hostBDD").val(),
            "userBDD": $("#userBDD").val(),
            "passBDD": $("#passBDD").val(),
            "tipoBDD": $("#tipoBDD").val(),
            "test_conexion": true
        };

        e.preventDefault();

        $.ajax({
            type: "POST",
            /*dataType: "json",
            contentType: "application/json",*/
            url: "http://127.0.0.1/conexionSQL/conexion.php",
            data: parametros,
            beforeSend: function() {
                //console.log("Enviando parametros conexion bdd");
            },
            success: function(response) {
                // console.log('successR', response)
                // console.log('successR', typeof response)
                toastr.success(response.msg, 'Correcto')

            },
            error: function(error) {
               // console.log(error.responseText);
                let respuesta = JSON.parse(error.responseText);
                toastr.error(respuesta.msg, 'Error');
            }
        });
    });
});
