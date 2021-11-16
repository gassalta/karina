$(document).ready(function () {
    // Logear usuario
    $('#logear').on("click", function (e) {
        // Evitar doble envio de formulario
        e.preventDefault();

        var body = {
            body: {
                email: document.getElementById("email").value,
                password: document.getElementById("password").value,
            }
        };

        fetch('class/funciones.php?login=true', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(body),
        })
            .then(res => res.json())
            .catch(function (error) {
                console.error('Error:', error);
            })
            .then(function (response) {
                console.log(response);
                const msgs = response;
                if (msgs.status == 'success') {
                    $('#alert').hide();
                    $('#success').show();

                    setInterval(realoader, 3000);
                    function realoader() {
                        location.reload('./')
                    }
                } else if (msgs.status == 'error') {
                    $('#alert').hide();
                    $('#error').show();
                }
            });



        return false;
    });

    // Grabar incidencia
    $('#grabar').on("click", function (e) {
        e.preventDefault();
        console.log('Llego');
        var Titulo = $("#titulo").val(),
            Detalles = $("#detalles").val(),
            Prioridad = $('input:radio[name=prioridad]:checked').val();

        // Titulo con mas de 5 caracteres
        $('.alert-danger, .alert-info').hide();
        if (!Titulo) {
           $('.alert-danger').empty().show().html('Debe ingresar el titulo');
        } else if (!Detalles) {
            $('.alert-danger').empty().show().html('Debe ingresar los detalles');
        } else if (!Prioridad) {
            $('.alert-danger').empty().show().html('Debe seleccionar una prioridad');
        } else {

            var body = {
                body: {
                    titulo: Titulo,
                    detalles: Detalles,
                    prioridad: Prioridad,
                }
            };

            fetch('class/funciones.php?incidencia=true', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(body),
            })
                .then(res => res.json())
                .catch(function (error) {
                    console.error('Error:', error);
                })
                .then(function (response) {
                    console.log(response);
                    const msgs = response;
                    if (msgs.status == 'success') {
                        $('.alert-success').show();

                        setInterval(realoader, 3000);
                        function realoader() {
                            location.reload()
                        }
                    } 
                });

        }

        return false;
    });
});


//OCULTAR EL DIV EN CASO DE SER FALSO EL BOMBERO
function OCULTAR_DIV(dato) {
    if (dato == "comision") {
        $("#div-geras").css('display', 'none').fadeOut(200);
    }
    if (dato == "socio") {
        $("#div-geras").css('display', 'none').fadeOut(200);
    }
    if (dato == "civil") {
        $("#div-geras").css('display', 'none').fadeOut(200);
    }
    if (dato == "profesional") {
        $("#div-geras").css('display', 'none').fadeOut(200);
    }
    if (dato == "otro") {
        $("#div-geras").css('display', 'none').fadeOut(200);
    }
    if (dato == "bombero") {
        $("#div-geras").css('display', 'none').fadeIn(200);
    };
};