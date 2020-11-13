/*
This file is part of McWebPanel.
Copyright (C) 2020 Cristina Ibañez, Konata400

    McWebPanel is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    McWebPanel is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with McWebPanel.  If not, see <https://www.gnu.org/licenses/>.
*/

$(document).ready(function() {

    $("#crearadmin").click(function() {
        location.href = "gestadmincreate.php";
    });

    $("#crearuser").click(function() {
        location.href = "gestusercreate.php";
    });

    var actdesuserbuttons = document.getElementsByClassName('actdesuser');
    for (var i = 0; i < actdesuserbuttons.length; i++) {
        actdesuserbuttons[i].addEventListener("click", function() {
            var indexarray = String(this.value);
            var jqxhr = $.ajax({
                url: 'function/gestuseractdesusuario.php',
                data: {
                    action: indexarray
                },
                type: 'POST',
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }

                    if (data == "nohayusuario") {
                        alert("No has introducido ningun usuario");
                    } else if (data == "errarchnoconfig") {
                        alert("Carpeta Config no existe");
                    } else if (data == "errconfignoread") {
                        alert("Carpeta Config no tiene permisos de lectura");
                    } else if (data == "errconfignowrite") {
                        alert("Carpeta Config no tiene permisos de escritura");
                    } else if (data == "errjsonnoexist") {
                        alert("El archivo de usuarios no existe");
                    } else if (data == "errjsonnoread") {
                        alert("El archivo de usuarios no tiene permisos de lectura");
                    } else if (data == "errjsonnowrite") {
                        alert("El archivo de usuarios no tiene permisos de escritura");
                    } else if (data == "OK") {
                        location.href = "gestorusers.php";
                    }


                },
                error: function(errorThrown) {
                    alert(errorThrown);
                }
            });
        })
    }

    var edituserbuttons = document.getElementsByClassName('edituser');
    for (var i = 0; i < edituserbuttons.length; i++) {
        edituserbuttons[i].addEventListener("click", function() {
            var indexarray = String(this.value);
            var jqxhr = $.ajax({
                url: 'function/gestusercalleditaruser.php',
                data: {
                    action: indexarray
                },
                type: 'POST',
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }

                    if (data == "nohayusuario") {
                        alert("No has introducido ningun usuario");
                    } else if (data == "errarchnoconfig") {
                        alert("Carpeta Config no existe");
                    } else if (data == "errconfignoread") {
                        alert("Carpeta Config no tiene permisos de lectura");
                    } else if (data == "errconfignowrite") {
                        alert("Carpeta Config no tiene permisos de escritura");
                    } else if (data == "errjsonnoexist") {
                        alert("El archivo de usuarios no existe");
                    } else if (data == "errjsonnoread") {
                        alert("El archivo de usuarios no tiene permisos de lectura");
                    } else if (data == "errjsonnowrite") {
                        alert("El archivo de usuarios no tiene permisos de escritura");
                    } else if (data == "usernoexiste") {
                        alert("El usuario no existe");
                    } else if (data == "OKSUPER") {
                        location.href = "gestadmineditar.php";
                    } else if (data == "OKADMIN") {
                        location.href = "gestusereditar.php";
                    }


                },
                error: function(errorThrown) {
                    alert(errorThrown);
                }
            });
        })
    }

    var deluserbuttons = document.getElementsByClassName('deluser');
    for (var i = 0; i < deluserbuttons.length; i++) {
        deluserbuttons[i].addEventListener("click", function() {
            var indexarray = String(this.value);
            var jqxhr = $.ajax({
                url: 'function/gestusereliminarusuario.php',
                data: {
                    action: indexarray
                },
                type: 'POST',
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }

                    if (data == "nohayusuario") {
                        alert("No has introducido ningun usuario");
                    } else if (data == "errarchnoconfig") {
                        alert("Carpeta Config no existe");
                    } else if (data == "errconfignoread") {
                        alert("Carpeta Config no tiene permisos de lectura");
                    } else if (data == "errconfignowrite") {
                        alert("Carpeta Config no tiene permisos de escritura");
                    } else if (data == "errjsonnoexist") {
                        alert("El archivo de usuarios no existe");
                    } else if (data == "errjsonnoread") {
                        alert("El archivo de usuarios no tiene permisos de lectura");
                    } else if (data == "errjsonnowrite") {
                        alert("El archivo de usuarios no tiene permisos de escritura");
                    } else if (data == "OK") {
                        location.href = "gestorusers.php";
                    }


                },
                error: function(errorThrown) {
                    alert(errorThrown);
                }
            });
        })
    }

    var mySessionTimer = setInterval(sessionTimer, 1000);

    function sessionTimer() {

        var tqxhr = $.ajax({
            url: 'function/salirsession.php',
            data: {
                action: 'status'
            },
            type: 'POST',
            success: function(data) {
                if (data == "SALIR") {
                    location.href = "index.php";
                }


            }
        });
    }

});