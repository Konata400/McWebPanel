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

    $("#login-form").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "function/login.php",
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

                if (data == "maxintentos") {
                    document.getElementById("textologincount").innerHTML = "<div class='alert alert-danger' role='alert'>Has superado el número de intentos no válidos.</div>";
                    document.getElementById("botoninisesion").disabled = true;
                } else if (data == "faltandatos") {
                    document.getElementById("textologinerror").innerHTML = "<div class='alert alert-danger' role='alert'>Error: Se necesita el usuario y contraseña.</div>";
                } else if (data == "novaliduser") {
                    document.getElementById("textologinerror").innerHTML = "<div class='alert alert-danger' role='alert'>Nombre de usuario o contraseña incorrecta.</div>";
                } else if (data == "userdesactivado") {
                    document.getElementById("textologinerror").innerHTML = "<div class='alert alert-danger' role='alert'>El usuario esta desactivado.</div>";
                } else if (data == "gotoeula") {
                    location.href = "eula.php";
                } else if (data == "gotostatus") {
                    location.href = "status.php";
                }

            },
            error: function(e) {
                alert("error");
            }
        });
    }));

});