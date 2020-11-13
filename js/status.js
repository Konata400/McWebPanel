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

    $("#binicio").click(function() {
        var jqxhr = $.ajax({
            url: 'function/startserver.php',
            data: {
                action: 'eltexto'
            },
            type: 'POST',
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
                if (data == "ok") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-success' role='alert'>Servidor iniciado correctamente.</div>";
                } else if (data == "noexistecarpetaminecraft") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: No existe la carpeta del servidor minecraft.</div>";
                } else if (data == "noeula") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: No has aceptado el eula de minecraft.</div>";
                } else if (data == "noconfjar") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: No has seleccionado un servidor .jar.</div>";
                } else if (data == "noexistejar") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: El servidor .jar seleccionado no existe.</div>";
                } else if (data == "noescritura") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Carpeta Servidor Minecraft no tiene permisos de escritura.</div>";
                } else if (data == "puertoenuso") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Puerto en uso.</div>";
                } else if (data == "fallofgets") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Hubo un error al escribir las propiedades del servidor.</div>";
                } else if (data == "noserverpropertiestxt") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: El archivo de configuración /config/serverproperties.txt no existe.</div>";
                } else if (data == "nolecturamine") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta del servidor minecraft no tiene permisos de lectura.</div>";
                } else if (data == "noejecutable") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta del servidor minecraft no tiene permisos de ejecución.</div>";
                } else if (data == "noconfigwrite") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta raiz config no tiene permisos de escritura.</div>";
                } else if (data == "noconfservpropergwrite") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: El archivo serverproperties.txt de la carpeta config no tiene permisos de lectura.</div>";
                } else if (data == "eulanowrite") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: El archivo eula.txt del servidor minecraft no tiene permisos de escritura.</div>";
                }
            },
            error: function(errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $("#bparar").click(function() {
        var jqxhr = $.ajax({
            url: 'function/stopserver.php',
            data: {
                action: 'eltexto'
            },
            type: 'POST',
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
                if (data == "ok") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-success' role='alert'>Servidor apagado correctamente.</div>";
                }
            },
            error: function(errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $("#bkill").click(function() {
        var jqxhr = $.ajax({
            url: 'function/killserver.php',
            data: {
                action: 'eltexto'
            },
            type: 'POST',
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }
                if (data == "ok") {
                    document.getElementById("textoretorno").innerHTML = "<div class='alert alert-success' role='alert'>El servidor fue matado correctamente.</div>";
                }
            },
            error: function(errorThrown) {
                alert(errorThrown);
            }
        });
    });

    if (document.getElementById('binicio') != null) {
        document.getElementById("binicio").disabled = true;
    }

    if (document.getElementById('bparar') != null) {
        document.getElementById("bparar").disabled = true;
    }

    if (document.getElementById('bkill') != null) {
        document.getElementById("bkill").disabled = true;
    }

    var myVar = setInterval(myTimer, 1000);

    function myTimer() {
        var jqxhr = $.ajax({
            url: 'function/funciones.php',
            data: {
                action: 'status'
            },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                document.getElementById("textoservidor").innerHTML = "Servidor: " + data.encendido;
                document.getElementById("horaserver").innerHTML = "Hora Servidor: " + data.hora;

                if (data.encendido == "Apagado") {

                    if (document.getElementById('binicio') != null) {
                        document.getElementById("binicio").disabled = false;
                    }

                    if (document.getElementById('bparar') != null) {
                        document.getElementById("bparar").disabled = true;
                    }

                    if (document.getElementById('bkill') != null) {
                        document.getElementById("bkill").disabled = true;
                    }

                    document.getElementById("textocpu").innerHTML = "Cpu:";
                    document.getElementById("textoram").innerHTML = "Ram:";
                } else if (data.encendido == "Encendido") {
                    document.getElementById("textocpu").innerHTML = "Cpu: " + data.cpu + "%";
                    if (data.memoria != "") {
                        document.getElementById("textoram").innerHTML = "Ram: " + data.memoria + " / Total: " + data.ramconfig + " GB";
                    }

                    if (document.getElementById('binicio') != null) {
                        document.getElementById("binicio").disabled = true;
                    }

                    if (document.getElementById('bparar') != null) {
                        document.getElementById("bparar").disabled = false;
                    }

                    if (document.getElementById('bkill') != null) {
                        document.getElementById("bkill").disabled = false;
                    }
                }
            }
        });
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