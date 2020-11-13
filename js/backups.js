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

    if (document.getElementById('crearbackup') != null) {
        document.getElementById("crearbackup").disabled = true;
    }

    if (document.getElementById('gifloading') != null) {
        document.getElementById("gifloading").style.visibility = "hidden";
    }

    if (document.getElementById('inputbackup') != null) {
        $("#inputbackup").keypress(function(e) {
            if (e.keyCode == 32) {
                return false;
            } else {
                if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 65 && e.keyCode <= 90 || e.keyCode >= 97 && e.keyCode <= 122 || e.keyCode == 45 || e.keyCode == 95 || e.keyCode == 13) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    }

    if (document.getElementsByClassName('descargar') != null) {
        var descargarbuttons = document.getElementsByClassName('descargar');
        for (var i = 0; i < descargarbuttons.length; i++) {
            descargarbuttons[i].addEventListener("click", function() {
                window.open('function/backupdownfile.php?action=' + this.value, '_blank', 'noopener noreferrer', "toolbar=no,scrollbars=yes,resizable=yes,top=400,left=500,width=400,height=100");
            })
        }
    }

    if (document.getElementsByClassName('restaurar') != null) {
        var restaurarbuttons = document.getElementsByClassName('restaurar');
        for (var i = 0; i < restaurarbuttons.length; i++) {
            restaurarbuttons[i].addEventListener("click", function() {
                var eleccion = confirm("¡ATENCIÓN!\n\nAl Restaurar se borrarán todos los archivos del servidor minecraft.\n\n¿Seguro que quieres continuar?");
                if (eleccion == true) {
                    document.getElementById("gifloading").style.visibility = "visible";
                    $.ajax({
                        type: "POST",
                        url: "function/backuprestorefile.php",
                        data: {
                            action: this.value
                        },
                        success: function(data) {
                            var getdebug = 0;
                            if (getdebug == 1) {
                                alert(data);
                            }
                            document.getElementById("gifloading").style.visibility = "hidden";

                            if (data == "nowriteraiz") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta raíz no tiene permisos de escritura.</div>";
                            } else if (data == "nominexiste") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta del servidor minecraft no existe.</div>";
                            } else if (data == "minenowrite") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta del servidor minecraft no tiene permisos de escritura.</div>";
                            } else if (data == "tarnoexiste") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-success' role='alert'>Error: El backup seleccionado no existe.</div>";
                            } else if (data == "tarnolectura") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-success' role='alert'>Error: El backup seleccionado no se puede leer.</div>";
                            } else if (data == "noborrado") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-success' role='alert'>Error: La carpeta del servidor minecraft no se pudo borrar.</div>";
                            } else if (data == "okrestore") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-success' role='alert'>Servidor Minecraft restaurado correctamente.</div>";
                            } else if (data == "norestore") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: No se ha podido restaurar el servidor.</div>";
                            }
                        }
                    });
                }
            })
        }
    }

    if (document.getElementsByClassName('borrar') != null) {
        var borrarbuttons = document.getElementsByClassName('borrar');
        for (var i = 0; i < borrarbuttons.length; i++) {
            borrarbuttons[i].addEventListener("click", function() {
                var eleccion = confirm("¡ATENCIÓN!\n\n¿Estás seguro de eliminar el backup: " + this.value + " ?");
                if (eleccion == true) {
                    var guardanombre = this.value;
                    document.getElementById("gifloading").style.visibility = "visible";
                    $.ajax({
                        type: "POST",
                        url: "function/backupborrarfile.php",
                        data: {
                            action: this.value
                        },
                        success: function(data) {
                            document.getElementById("gifloading").style.visibility = "hidden";

                            var getdebug = 0;
                            if (getdebug == 1) {
                                alert(data);
                            }

                            if (data == "1") {
                                document.getElementById(guardanombre).closest("tr").remove();
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-success' role='alert'>Archivo borrado correctamente.</div>";
                            } else if (data == "nowritable") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: No hay permisos de escritura.</div>";
                            } else if (data == "noexiste") {
                                document.getElementById("textoretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: El archivo no existe.</div>";
                            }
                        }
                    });
                }
            })
        }
    }

    if (document.getElementById('inputbackup') != null) {
        $("#inputbackup").keyup(function(e) {
            if (document.getElementById("inputbackup").value == "") {
                document.getElementById("crearbackup").disabled = true;
            } else {
                document.getElementById("crearbackup").disabled = false;
            }
        });

        document.getElementById("inputbackup").addEventListener('paste', function(event) {
            document.getElementById("crearbackup").disabled = false;
        });
    }

    if (document.getElementById('crearbackup') != null) {
        $("#crearbackup").click(function() {
            document.getElementById("gifloading").style.visibility = "visible";
            var eltexto = document.getElementById("inputbackup").value;
            $.ajax({
                type: "POST",
                url: "function/backupcreate.php",
                data: {
                    action: eltexto
                },
                success: function(data) {
                    var getdebug = 0;
                    if (getdebug == 1) {
                        alert(data);
                    }
                    document.getElementById("gifloading").style.visibility = "hidden";

                    if (data == "okbackup") {
                        location.reload();
                    } else if (data == "nobackup") {
                        document.getElementById("textobackupretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error al crear el backup.</div>";
                    } else if (data == "nowritable") {
                        document.getElementById("textobackupretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta no tiene permisos de escritura.</div>";
                    } else if (data == "noexiste") {
                        document.getElementById("textobackupretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta backups no existe.</div>";
                    } else if (data == "nolectura") {
                        document.getElementById("textobackupretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta del servidor minecraft no se puede leer.</div>";
                    } else if (data == "novalidoname") {
                        document.getElementById("textobackupretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Nombre no válido.</div>";
                    } else if (data == "noejecutable") {
                        document.getElementById("textobackupretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta del servidor minecraft no tiene permisos de ejecución.</div>";
                    }
                }
            });
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