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

        var body = {
            body: {
                titulo: document.getElementsByName("titulo").value,
                detalles: document.getElementsByName("detalles").value,
                prioridad: document.getElementsByName("prioridad").value,
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