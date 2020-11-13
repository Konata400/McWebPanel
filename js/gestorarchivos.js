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

    if (document.getElementsByClassName('entrar') != null) {
        var entrarbuttons = document.getElementsByClassName('entrar');
        for (var i = 0; i < entrarbuttons.length; i++) {
            entrarbuttons[i].addEventListener("click", function() {
                $.ajax({
                    type: "POST",
                    url: "function/carpetaentrar.php",
                    data: {
                        action: this.value
                    },
                    success: function(data) {
                        var getdebug = 0;
                        if (getdebug == 1) {
                            alert(data);
                        }

                        if (data == "OK") {
                            location.reload();
                        } else if (data == "nopermenter") {
                            alert("No tienes permiso de ejecucion/enter en la carpeta");
                        }


                    }
                });

            })
        }
    }

    if (document.getElementsByClassName('atras') != null) {
        var atrasbuttons = document.getElementsByClassName('atras');
        for (var i = 0; i < atrasbuttons.length; i++) {
            atrasbuttons[i].addEventListener("click", function() {
                $.ajax({
                    type: "POST",
                    url: "function/carpetatras.php",
                    data: {
                        action: this.value
                    },
                    success: function(data) {
                        var getdebug = 0;
                        if (getdebug == 1) {
                            alert(data);
                        }

                        if (data == "OK") {
                            location.reload();
                        } else if (data == "noatras") {
                            alert("No puedes salir de la carpeta del servidor minecraft");
                        }


                    }
                });

            })
        }
    }

    if (document.getElementsByClassName('borrarfile') != null) {
        var borrarfilebuttons = document.getElementsByClassName('borrarfile');
        for (var i = 0; i < borrarfilebuttons.length; i++) {
            borrarfilebuttons[i].addEventListener("click", function() {
                var eleccion = confirm("¡ATENCIÓN!\n\n¿Estás seguro de eliminar el archivo: " + this.id + " ?");
                if (eleccion == true) {
                    $.ajax({
                        type: "POST",
                        url: "function/gestorborrarfile.php",
                        data: {
                            action: this.value
                        },
                        success: function(data) {
                            var getdebug = 0;
                            if (getdebug == 1) {
                                alert(data);
                            }

                            if (data == "1") {
                                location.reload();
                            } else if (data == "noexiste") {
                                alert("El archivo no existe");
                                location.reload();
                            } else if (data == "nada") {
                                alert("No hay ruta a borrar");
                            } else if (data == "rutacambiada") {
                                alert("Ruta no válida");
                            } else if (data == "novalido") {
                                alert("Ruta no válida");
                            } else if (data == "nowrite") {
                                alert("El archivo no tiene permisos de escritura");
                            }


                        }
                    });
                }
            })
        }
    }

    if (document.getElementsByClassName('borrarcarpeta') != null) {
        var borrarcarpetabuttons = document.getElementsByClassName('borrarcarpeta');
        for (var i = 0; i < borrarcarpetabuttons.length; i++) {
            borrarcarpetabuttons[i].addEventListener("click", function() {
                var eleccion = confirm("¡ATENCIÓN!\n\n¿Estás seguro de eliminar la carpeta: " + this.id + " ?");
                if (eleccion == true) {
                    $.ajax({
                        type: "POST",
                        url: "function/gestorborrarcarpeta.php",
                        data: {
                            action: this.value
                        },
                        success: function(data) {
                            var getdebug = 0;
                            if (getdebug == 1) {
                                alert(data);
                            }

                            if (data == "1") {
                                location.reload();
                            } else if (data == "nada") {
                                alert("No hay ruta");
                            } else if (data == "rutacambiada") {
                                alert("Ruta no válida");
                            } else if (data == "novalido") {
                                alert("Ruta no válida");
                            } else if (data == "noexiste") {
                                alert("La carpeta no existe");
                                location.reload();
                            } else if (data == "nowrite") {
                                alert("La carpeta no tiene permisos de escritura");
                            } else if (data == "nopermenter") {
                                alert("No tienes permiso de ejecucion/enter en la carpeta");
                            } else if (data == "noborrado") {
                                alert("Error: La carpeta no se pudo borrar");
                            }


                        }
                    });
                }
            })
        }
    }

    if (document.getElementsByClassName('renamefile') != null) {
        var renamefilebuttons = document.getElementsByClassName('renamefile');
        for (var i = 0; i < renamefilebuttons.length; i++) {
            renamefilebuttons[i].addEventListener("click", function() {
                var renombrado = prompt("Renombrar fichero:", this.id);
                if (renombrado != null) {
                    $.ajax({
                        type: "POST",
                        url: "function/gestorenamefile.php",
                        data: {
                            action: this.value,
                            renombre: renombrado
                        },
                        success: function(data) {
                            var getdebug = 0;
                            if (getdebug == 1) {
                                alert(data);
                            }

                            if (data == "1") {
                                location.reload();
                            } else if (data == "revacio") {
                                alert("El renombre esta vacío");
                            } else if (data == "archvacio") {
                                alert("La ruta esta vacía");
                            } else if (data == "rutacambiada") {
                                alert("Ruta no válida");
                            } else if (data == "novalido") {
                                alert("Ruta no válida");
                            } else if (data == "renomnovalido") {
                                alert("Renombre no válido");
                            } else if (data == "noexiste") {
                                alert("El archivo no existe");
                                location.reload();
                            } else if (data == "yaexiste") {
                                alert("Ya existe un archivo con ese nombre");
                            } else if (data == "nowrite") {
                                alert("El archivo no tiene permisos de escritura");
                            }

                        }
                    });
                }
            })
        }
    }

    if (document.getElementsByClassName('renamefolder') != null) {
        var renamefolderbuttons = document.getElementsByClassName('renamefolder');
        for (var i = 0; i < renamefolderbuttons.length; i++) {
            renamefolderbuttons[i].addEventListener("click", function() {
                var renombrado = prompt("Renombrar carpeta:", this.id);
                if (renombrado != null) {
                    $.ajax({
                        type: "POST",
                        url: "function/gestorrenamefolder.php",
                        data: {
                            action: this.value,
                            renombre: renombrado
                        },
                        success: function(data) {
                            var getdebug = 0;
                            if (getdebug == 1) {
                                alert(data);
                            }

                            if (data == "1") {
                                location.reload();
                            } else if (data == "revacio") {
                                alert("El renombre esta vacío");
                            } else if (data == "archvacio") {
                                alert("La ruta esta vacía");
                            } else if (data == "rutacambiada") {
                                alert("Ruta no valida");
                            } else if (data == "novalido") {
                                alert("Ruta no valida");
                            } else if (data == "renomnovalido") {
                                alert("Renombre no válido");
                            } else if (data == "noexiste") {
                                alert("El archivo no existe");
                                location.reload();
                            } else if (data == "yaexiste") {
                                alert("Ya existe una carpeta con ese nombre");
                            } else if (data == "nowrite") {
                                alert("La carpeta no tiene permisos de escritura");
                            }

                        }
                    });
                }
            })
        }
    }

    if (document.getElementsByClassName('editarfile') != null) {
        var editarbuttons = document.getElementsByClassName('editarfile');
        for (var i = 0; i < editarbuttons.length; i++) {
            editarbuttons[i].addEventListener("click", function() {
                $.ajax({
                    type: "POST",
                    url: "function/gestoreditarfile.php",
                    data: {
                        action: this.value
                    },
                    success: function(data) {
                        var getdebug = 0;
                        if (getdebug == 1) {
                            alert(data);
                        }

                        if (data == "OK") {
                            location.href = "editararchivo.php";
                        } else if (data == "noruta") {
                            alert("No se ha pasado ningún archivo a editar");
                        } else if (data == "nowrite") {
                            alert("El archivo no tiene permisos de escritura");
                        } else if (data == "noexiste") {
                            alert("El archivo no existe");
                            location.reload();
                        }


                    }
                });

            })
        }
    }

    if (document.getElementsByClassName('descargarfile') != null) {
        var descargarbuttons = document.getElementsByClassName('descargarfile');
        for (var i = 0; i < descargarbuttons.length; i++) {
            descargarbuttons[i].addEventListener("click", function() {
                window.open('function/gestordownfile.php?action=' + this.value, '_blank', 'noopener noreferrer', "toolbar=no,scrollbars=yes,resizable=yes,top=400,left=500,width=400,height=100");
            })
        }
    }

    if (document.getElementsByClassName('descomprimirtar') != null) {
        var descomprimirtarbuttons = document.getElementsByClassName('descomprimirtar');
        for (var i = 0; i < descomprimirtarbuttons.length; i++) {
            descomprimirtarbuttons[i].addEventListener("click", function() {
                if (document.getElementById('gifloading') != null) {
                    document.getElementById("gifloading").style.visibility = "visible";
                }
                var tqxhr = $.ajax({
                    url: 'function/gestordescomprimirtar.php',
                    data: {
                        action: this.value
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (document.getElementById('gifloading') != null) {
                            document.getElementById("gifloading").style.visibility = "hidden";
                        }

                        if (data.eserror == "nada") {
                            alert("No se ha pasado ningún archivo a descomprimir");
                        } else if (data.eserror == "notargz") {
                            alert("El archivo no es .tag.gz");
                        } else if (data.eserror == "notarbz2") {
                            alert("El archivo no es .tag.bz2");
                        } else if (data.eserror == "notar") {
                            alert("El archivo no es .tar");
                        } else if (data.eserror == "noexiste") {
                            alert("El archivo tar a descomprimir no existe");
                            location.reload();
                        } else if (data.eserror == "carpyaexiste") {
                            alert("No se puede descomprimir, la carpeta: " + data.carpeta + " ya existe");
                        } else if (data.eserror == "no") {
                            alert("Error al descomprimir");
                        } else if (data.eserror == "ok") {
                            alert("Descomprimido en la carpeta: " + data.carpeta);
                            location.reload();
                        }

                    }
                });
            })
        }
    }

    if (document.getElementsByClassName('descomprimirzip') != null) {
        var descomprimirzipbuttons = document.getElementsByClassName('descomprimirzip');
        for (var i = 0; i < descomprimirzipbuttons.length; i++) {
            descomprimirzipbuttons[i].addEventListener("click", function() {
                if (document.getElementById('gifloading') != null) {
                    document.getElementById("gifloading").style.visibility = "visible";
                }
                var tqxhr = $.ajax({
                    url: 'function/gestordescomprimirzip.php',
                    data: {
                        action: this.value
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (document.getElementById('gifloading') != null) {
                            document.getElementById("gifloading").style.visibility = "hidden";
                        }

                        if (data.eserror == "nada") {
                            alert("No se ha pasado ningún archivo a descomprimir");
                        } else if (data.eserror == "noexiste") {
                            alert("El archivo a descomprimir no existe");
                            location.reload();
                        } else if (data.eserror == "nozip") {
                            alert("El archivo no es .zip");
                        } else if (data.eserror == "carpyaexiste") {
                            alert("No se puede descomprimir, la carpeta: " + data.carpeta + " ya existe");
                        } else if (data.eserror == "fallo") {
                            alert("Error al descomprimir");
                        } else if (data.eserror == "ok") {
                            alert("Zip descomprimido en la carpeta: " + data.carpeta);
                            location.reload();
                        }

                    }
                });
            })
        }
    }

    if (document.getElementsByClassName('comprimirzipfolder') != null) {
        var comprimircarpetazipbuttons = document.getElementsByClassName('comprimirzipfolder');
        for (var i = 0; i < comprimircarpetazipbuttons.length; i++) {
            comprimircarpetazipbuttons[i].addEventListener("click", function() {
                if (document.getElementById('gifloading') != null) {
                    document.getElementById("gifloading").style.visibility = "visible";
                }
                var tqxhr = $.ajax({
                    url: 'function/gestorcomprimircarpetazip.php',
                    data: {
                        action: this.value
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (document.getElementById('gifloading') != null) {
                            document.getElementById("gifloading").style.visibility = "hidden";
                        }

                        if (data.eserror == "nada") {
                            alert("No se ha pasado ningún archivo a descomprimir");
                        } else if (data.eserror == "noexiste") {
                            alert("La carpeta a comprimir no existe");
                            location.reload();
                        } else if (data.eserror == "carpyaexiste") {
                            alert("No se puede comprimir, la carpeta: " + data.carpeta + " ya existe");
                        } else if (data.eserror == "fallo") {
                            alert("Error al comprimir");
                        } else if (data.eserror == "nopermenter") {
                            alert("No tienes permiso de ejecucion/enter en la carpeta");
                        } else if (data.eserror == "ok") {
                            alert("Zip comprimido en archivo: " + data.carpeta);
                            location.reload();
                        }

                    }
                });
            })
        }
    }

    if (document.getElementById('botonsubir') != null) {
        document.getElementById("botonsubir").disabled = true;
    }

    if (document.getElementById('gifloading') != null) {
        document.getElementById("gifloading").style.visibility = "hidden";
    }

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();

        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        if (document.getElementById('botonsubir') != null) {
            document.getElementById("botonsubir").disabled = false;
        }

    });

    if (document.getElementById('bnactualizar') != null) {
        $("#bnactualizar").click(function() {
            location.reload();
        });
    }

    if (document.getElementById('bnnuevacarpeta') != null) {
        $("#bnnuevacarpeta").click(function() {
            var renombrado = prompt("Nombre nueva carpeta:");
            if (renombrado != null) {
                var tqxhr = $.ajax({
                    url: 'function/gestorcrearcarpeta.php',
                    data: {
                        action: renombrado
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data == "nowrite") {
                            alert("No hay permisos de escritura");
                        } else if (data == "carpyaexiste") {
                            alert("La carpeta ya existe");
                        } else if (data == "norenom") {
                            alert("Renombre no válido");
                        } else if (data == "novalido") {
                            alert("Nombre no válido");
                        } else if (data == "OK") {
                            location.reload();
                        }
                    }
                });
            }
        });
    }

    if (document.getElementById('bcopiar') != null) {
        $("#bcopiar").click(function() {
            var arrayseleccion = new Array();
            var elindice = 0;
            var checkseleccionados = document.getElementsByClassName('laseleccion');
            for (var i = 0; i < checkseleccionados.length; i++) {
                if (checkseleccionados[i].checked == true) {
                    arrayseleccion[elindice] = checkseleccionados[i].value;
                    elindice = elindice + 1;
                }
            }

            if (arrayseleccion == "") {
                alert("No has seleccionado ningún elemento");
            } else {
                var tqxhr = $.ajax({
                    url: 'function/gestorcopiarfiles.php',
                    data: {
                        action: arrayseleccion
                    },
                    type: 'POST',
                    success: function(data) {
                        if (data == "nocopy") {
                            alert("Nada que copiar");
                        } else if (data == "noexiste") {
                            alert("Hay archivos que no existen");
                            location.reload();
                        } else if (data == "nopermenter") {
                            alert("Hay carpetas que no tienen permiso de ejecucion/enter");
                        } else if (data == "OK") {
                            location.reload();
                        }

                    }
                });
            }
        });
    }

    if (document.getElementById('bpegar') != null) {
        $("#bpegar").click(function() {
            var eleccion = confirm("¡CONFIRMAR ACCION!\n\nEn caso de existir un archivo con el mismo nombre se sobrescribirá.\n\n¿Seguro que quieres continuar?");
            if (eleccion == true) {
                if (document.getElementById('gifloading') != null) {
                    document.getElementById("gifloading").style.visibility = "visible";
                }
                var tqxhr = $.ajax({
                    url: 'function/gestorpegarfiles.php',
                    data: {
                        action: 'ok'
                    },
                    type: 'POST',
                    success: function(data) {
                        if (document.getElementById('gifloading') != null) {
                            document.getElementById("gifloading").style.visibility = "hidden";
                        }

                        if (data == "nocopy") {
                            alert("Nada que pegar");
                        } else if (data == "noexiste") {
                            alert("Se cancela el pegado, el archivo no existe");
                        } else if (data == "nowrite") {
                            alert("La ruta a pegar no tiene permisos de escritura");
                        } else if (data == "OK") {
                            location.reload();
                        }
                    }
                });
            }
        });
    }

    if (document.getElementById('beliminarseleccion') != null) {
        $("#beliminarseleccion").click(function() {
            var arrayseleccion = new Array();
            var elindice = 0;
            var checkseleccionados = document.getElementsByClassName('laseleccion');

            for (var i = 0; i < checkseleccionados.length; i++) {
                if (checkseleccionados[i].checked == true) {
                    arrayseleccion[elindice] = checkseleccionados[i].value;
                    elindice = elindice + 1;
                }
            }

            if (arrayseleccion == "") {
                alert("No has seleccionado ningún elemento");
            } else {
                var eleccion = confirm("¡ELIMINAR CONFIRMAR ACCIÓN!\n\n¡Vas a eliminar las carpetas o archivos seleccionados!\n\n¿Seguro que quieres continuar?");
                if (eleccion == true) {
                    var tqxhr = $.ajax({
                        url: 'function/gestorborrarmultiple.php',
                        data: {
                            action: arrayseleccion
                        },
                        type: 'POST',
                        success: function(data) {
                            if (data == "nocopy") {
                                alert("Nada que borrar");
                            } else if (data == "rutacambiada") {
                                alert("Ruta no válida");
                            } else if (data == "novalido") {
                                alert("Ruta no válida");
                            } else if (data == "noexiste") {
                                alert("Hay archivos que no existen");
                                location.reload();
                            } else if (data == "nowrite") {
                                alert("Hay archivos sin permisos de escritura");
                            } else if (data == "nopermenter") {
                                alert("Hay carpetas sin permiso de ejecucion/enter en la carpeta");
                            } else if (data == "OK") {
                                location.reload();
                            }

                        }
                    });
                }
            }
        });
    }

    if (document.getElementById('bselectall') != null) {
        $("#bselectall").click(function() {
            var checkseleccionados = document.getElementsByClassName('laseleccion');
            for (var i = 0; i < checkseleccionados.length; i++) {
                checkseleccionados[i].checked = true;
            }
        });
    }

    if (document.getElementById('bunselectall') != null) {
        $("#bunselectall").click(function() {
            var checkseleccionados = document.getElementsByClassName('laseleccion');
            for (var i = 0; i < checkseleccionados.length; i++) {
                checkseleccionados[i].checked = false;
            }
        });
    }

    $("#form").on('submit', (function(e) {
        if (document.getElementById('gifloading') != null) {
            document.getElementById("gifloading").style.visibility = "visible";
        }
        e.preventDefault();
        $.ajax({
            url: "function/gestoruploadfile.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var getdebug = 0;
                if (getdebug == 1) {
                    alert(data);
                }

                if (document.getElementById('gifloading') != null) {
                    document.getElementById("gifloading").style.visibility = "hidden";
                }

                if (data == "nowrite") {
                    document.getElementById("textouploadretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta no tiene permisos de escritura.</div>";
                } else if (data == "yaexiste") {
                    document.getElementById("textouploadretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: El archivo ya existe.</div>";
                } else if (data == "novalido") {
                    document.getElementById("textouploadretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: No se acepta ese tipo de archivo.</div>";
                } else if (data == "novaltipe") {
                    document.getElementById("textouploadretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: No se acepta ese tipo de archivo.</div>";
                } else if (data == "novalidoname") {
                    document.getElementById("textouploadretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Nombre archivo no válido.</div>";
                } else if (data == "errprocess") {
                    document.getElementById("textouploadretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Errores en el proceso de subida del archivo.</div>";
                } else if (data == "errorupload") {
                    document.getElementById("textouploadretorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Ha habido un error subiendo el archivo.</div>";
                } else if (data == "subidook") {
                    location.reload();
                }

            },
            error: function(e) {
                alert("error");
            }
        });
    }));

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