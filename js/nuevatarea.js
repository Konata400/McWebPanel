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

    document.getElementById("elcomando").disabled = true;
    document.getElementById("creatarea").disabled = true;

    $("#laaccion").change(function() {
        if (document.getElementById("laaccion").value == "acc4") {
            document.getElementById("elcomando").disabled = false;
            if (document.getElementById("elcomando").value == "") {
                document.getElementById("creatarea").disabled = true;
            } else {
                document.getElementById("creatarea").disabled = false;
            }
        } else {
            document.getElementById("elcomando").disabled = true;
            document.getElementById("elcomando").value = "";
            if (document.getElementById("nombretarea").value == "") {
                document.getElementById("creatarea").disabled = true;
            } else {
                document.getElementById("creatarea").disabled = false;
            }
        }
    });

    $("#elcomando").keyup(function(e) {
        if (document.getElementById("elcomando").value == "") {
            document.getElementById("creatarea").disabled = true;
        } else {
            document.getElementById("creatarea").disabled = false;
        }

    });

    document.getElementById("elcomando").addEventListener('paste', function(event) {
        document.getElementById("creatarea").disabled = false;
    });

    $("#nombretarea").keyup(function(e) {
        if (document.getElementById("nombretarea").value == "") {
            document.getElementById("creatarea").disabled = true;
        } else {
            document.getElementById("creatarea").disabled = false;
        }

    });

    $("#creatarea").click(function() {
        var eldata = $("#formtarea :input").serializeArray();

        $.post($("#formtarea").attr("action"), eldata, function(data) {
            var getdebug = 0;
            if (getdebug == 1) {
                alert(data);
            }
            if (data == "errmes") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Tienes que seleccionar como mínimo un mes.</div>";
            } else if (data == "errsemana") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Tienes que seleccionar como mínimo una semana.</div>";
            } else if (data == "errhora") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Tienes que seleccionar como mínimo una hora.</div>";
            } else if (data == "errminuto") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Tienes que seleccionar como mínimo un minuto.</div>";
            } else if (data == "errarchnoconfig") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta config no existe.</div>";
            } else if (data == "errconfignoread") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta config no tiene permisos de lectura .</div>";
            } else if (data == "errconfignowrite") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: La carpeta config no tiene permisos de escritura.</div>";
            } else if (data == "errjsonnoread") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: El archivo json no tiene permisos de lectura.</div>";
            } else if (data == "errjsonnowrite") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Hay que introducir un comando.</div>";
            } else if (data == "nocomando") {
                document.getElementById("textotarearetorno").innerHTML = "<div class='alert alert-danger' role='alert'>Error: El archivo json no tiene permisos de escritura.</div>";
            } else if (data == "OK") {
                location.href = "tareas.php";
            }
        })

    });

    $("#formtarea").submit(function() {
        return false;

    });

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
