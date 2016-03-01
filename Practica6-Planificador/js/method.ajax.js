window.onload = function() {

    (function() {
        var _usuario = "";
        /* 
            Variables necesarias para iniciar sesión y cerrarla 
        */
        var user = "",
            password = "",
            btLogin, divLogin, mensaje, divRespuesta, divOperaciones;

        divLogin = document.getElementById("divLogin")
        user = document.getElementById("email");
        password = document.getElementById("clave");
        btLogin = document.getElementById("btLogin");
        mensaje = document.getElementById("mensajeError");
        divRespuesta = document.getElementById("divRespuesta");
        divOperaciones = document.getElementById("divOperaciones");

        /* *********************************************************************************************** */
        (function refresco() {
            // Comprobar la sesión cuando se refresca la página
            var procesarRefresco = function(respuesta) {
                if (respuesta.email !== null) {
                    if (respuesta.email) {
                        var emailProfesor = respuesta.emailProfesor;
                        var nombreProfesor = respuesta.nombreProfesor;
                        _usuario = nombreProfesor;

                        document.getElementById("nom_user_login").textContent = nombreProfesor;
                        document.getElementById("emailHidden").value = emailProfesor;
                        document.getElementById("nombreHidden").value = nombreProfesor;

                        divLogin.classList.add("ocultar");
                        divRespuesta.classList.remove("ocultar");
                        divOperaciones.classList.remove("ocultar");
                    }
                }
            };

            var ajax = new Ajax();

            ajax.setUrl("ajax/ajaxLogueado.php");
            ajax.setRespuesta(procesarRefresco);
            ajax.doPeticion();
        })();

        /* *********************************************************************************************** */
        // Cargar el horario desde la base de datos
        var obtenerHorario = function(respuesta) {
            if (respuesta.updateHorario) {
                var idReserva, idDia, idHora, nombreProfesor, idCelda = "",
                    celda = "";

                for (var i = 0; i < respuesta.updateHorario.length; i++) {
                    idReserva = respuesta.updateHorario[i]['id_reserva'];

                    idDia = respuesta.updateHorario[i]['dia'];
                    idHora = respuesta.updateHorario[i]['hora'];
                    nombreProfesor = respuesta.updateHorario[i]['nombre'];

                    idCelda = idDia + idHora;

                    idCelda[i] = idDia[i] + idHora[i];

                    celda = document.getElementById(idCelda);
                    celda.setAttribute("id_reserva", idReserva);

                    celda.textContent = nombreProfesor;
                    celda.removeEventListener("dblclick");
                    celda.addEventListener("dblclick", function addEvento(e) {
                        var id = this.id;
                        var idReserva = this.getAttribute("id_reserva");
                        var userEvent = this.textContent;

                        if (userEvent == _usuario) {
                            /*var bandera = confirm("Are you sure you want to delete it?");
                            if (bandera) {
                                celda.removeEventListener("dblclick", addEvento, false);
                                borrar(idReserva, id);
                            }*/
                            swal({
                                title: 'Are you sure?',
                                text: 'You will not be able to recover this imaginary file!',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel plx!',
                                confirmButtonClass: 'confirm-class',
                                cancelButtonClass: 'cancel-class',
                                closeOnConfirm: false,
                                closeOnCancel: false
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    celda.removeEventListener("dblclick", addEvento, false);
                                    borrar(idReserva, id);
                                    swal('Deleted!', 'Your file has been deleted.', 'success');

                                }
                                else {
                                    swal('Cancelled', 'Your imaginary file is safe :)', 'error');
                                }
                            });
                        }
                        else {
                            sweetAlert('Oops...', 'You do not have permission to delete this planning.', 'error');
                            //alert("You do not have permission to delete this planning.");
                        }
                    }, false);
                }
            }
        };

        var ajax = new Ajax();

        ajax.setUrl("ajax/ajaxGetEvents.php");
        ajax.setRespuesta(obtenerHorario);
        ajax.doPeticion();

        /* *********************************************************************************************** */

        // Iniciar sesión
        btLogin.addEventListener("click", function() {
            var procesarLogin = function(respuesta) {
                if (respuesta.email) {
                    var emailProfesor = respuesta.emailProfesor;
                    var nombreProfesor = respuesta.nombreProfesor;
                    _usuario = nombreProfesor;

                    document.getElementById("nom_user_login").textContent = nombreProfesor;
                    document.getElementById("emailHidden").value = emailProfesor;
                    document.getElementById("nombreHidden").value = nombreProfesor;

                    divLogin.classList.add("ocultar");
                    divRespuesta.classList.remove("ocultar");
                    divOperaciones.classList.remove("ocultar");
                }
                else {
                    mensaje.classList.remove("ocultar");
                }
            };
            var ajax = new Ajax();
            var datoUser = encodeURI(user.value);
            var datoPassword = encodeURI(password.value);

            ajax.setUrl("ajax/ajaxLogin.php?email=" + datoUser + "&clave=" + datoPassword);
            ajax.setRespuesta(procesarLogin);
            ajax.doPeticion();

        }, false);

        /* *********************************************************************************************** */

        // Cerrar sesión
        var btLogout;
        btLogout = document.getElementById("btLogout");
        btLogout.addEventListener("click", function() {
            var procesarLogout = function(respuesta) {
                if (!respuesta.email) {
                    _usuario = "";
                    document.getElementById("nom_user_login").textContent = "";
                    document.getElementById("emailHidden").value = "";
                    document.getElementById("nombreHidden").value = "";
                    divLogin.classList.remove("ocultar");
                    divRespuesta.classList.add("ocultar");
                    mensaje.classList.add("ocultar");
                    divOperaciones.classList.add("ocultar");
                }
            };
            var ajax = new Ajax();

            ajax.setUrl("ajax/ajaxLogout.php");
            ajax.setRespuesta(procesarLogout);
            ajax.doPeticion();
        }, false);

        /* *********************************************************************************************** */

        /*
            Funcionalidades como añadir, eliminar y comprobar existencia de eventos
        */

        var btAdd, selectDia, selectHora, emailHidden, nombreHidden;

        btAdd = document.getElementById("btAdd");
        selectDia = document.getElementById("select_dia");
        selectHora = document.getElementById("select_hora");
        emailHidden = document.getElementById("emailHidden");
        nombreHidden = document.getElementById("nombreHidden");

        btAdd.addEventListener("click", function addEvento() {
            var procesarInsert = function(respuesta) {
                if (respuesta.insert > 0) {
                    var idDia, idHora, nombreProfesor, celdaId, celda, idReserva;
                    idReserva = respuesta.insert;

                    idDia = selectDia.options[selectDia.selectedIndex].getAttribute('id');
                    idHora = selectHora.options[selectHora.selectedIndex].getAttribute('id');
                    nombreProfesor = nombreHidden.value;

                    celdaId = idDia + idHora;

                    celda = document.getElementById(celdaId);


                    celda.setAttribute("id_reserva", idReserva);
                    celda.textContent = nombreProfesor;

                    // Doble click para borrar
                    celda.addEventListener("dblclick", function addEvento(e) {
                        var id = this.id;
                        var idReserva = this.getAttribute("id_reserva");
                        var userEvent = this.textContent;



                        if (userEvent == _usuario) {
                            swal({
                                title: 'Are you sure?',
                                text: 'You will not be able to recover this imaginary file!',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel plx!',
                                confirmButtonClass: 'confirm-class',
                                cancelButtonClass: 'cancel-class',
                                closeOnConfirm: false,
                                closeOnCancel: false
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    celda.removeEventListener("dblclick", addEvento, false);
                                    borrar(idReserva, id);
                                    swal('Deleted!', 'Your file has been deleted.', 'success');
                                }
                                else {
                                    swal('Cancelled', 'Your imaginary file is safe :)', 'error');
                                }
                            });
                        }
                        else {
                            sweetAlert('Oops...', 'You do not have permission to delete this planning.', 'error');
                            //alert("You do not have permission to delete this planning.");
                        }
                    }, false);
                }
                else {
                    sweetAlert('Oops...', 'That time is already taken, choose another.', 'error');
                    //alert("That time is already taken, choose another.");
                }
            };

            var ajax = new Ajax();
            var datoDia = encodeURI(selectDia.options[selectDia.selectedIndex].getAttribute('id'));
            var datoHora = encodeURI(selectHora.options[selectHora.selectedIndex].getAttribute('id'));
            var datoEmail = encodeURI(emailHidden.value);
            var datoNombre = encodeURI(nombreHidden.value);

            ajax.setUrl("ajax/ajaxAddEvento.php?dia=" + datoDia + "&hora=" + datoHora +
                "&email=" + datoEmail + "&nombre=" + datoNombre);
            ajax.setRespuesta(procesarInsert);
            ajax.doPeticion();
        });

        function borrar(idReserva, idCelda) {
            var procesarBorrado = function(respuesta) {
                if (respuesta.delete > 0) {
                    var celda = document.getElementById(idCelda);
                    celda.textContent = "";
                    celda.removeAttribute("id_reserva");
                }
            }
            var ajax = new Ajax();

            ajax.setUrl("ajax/ajaxDeleteEvento.php?id_reserva=" + idReserva);
            ajax.setRespuesta(procesarBorrado);
            ajax.doPeticion();
        };



    })();
};