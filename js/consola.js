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

    function redimensionar() {
        var tamano = window.innerHeight;
        tamano = tamano - 150;
        document.getElementById("laconsola").style.height = tamano + "px";
    }

    redimensionar();

    window.addEventListener("resize", redimensionar);

    var myVar = setInterval(myTimer, 500);

    function myTimer() {

        var jqxhr = $.ajax({
            url: 'function/enviarconsola.php',
            data: {
                action: 'status'
            },
            type: 'POST',
            success: function(data) {
                var textoantiguo = document.getElementById("laconsola").value

                document.getElementById("laconsola").value = data;

                if (data != textoantiguo) {
                    document.getElementById("laconsola").scrollTop = document.getElementById("laconsola").scrollHeight;
                }

            }
        });
    }

    function enviarcomando() {
        var eltexto = "";

        if (document.getElementById("elcomando").value != "") {

            eltexto = document.getElementById("elcomando").value;

            var jqxhr = $.ajax({
                url: 'function/enviarcomando.php',
                data: {
                    action: eltexto
                },
                type: 'POST',
                success: function(data) {
                    document.getElementById("elcomando").value = "";
                },
                error: function(errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    }

    if (document.getElementById('botonconsola') != null) {
        $("#botonconsola").click(function() {
            enviarcomando();
        });
    }

    if (document.getElementById('elcomando') != null) {
        $("#elcomando").keypress(function(e) {
            if (e.keyCode == 13) {
                enviarcomando();
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