<?php

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

require_once("template/session.php");
require_once("template/errorreport.php");
require_once("config/confopciones.php");
require_once("template/header.php");
?>
<!-- Custom styles for this template-->
<link href="css/test.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php

    $expulsar = 0;

    //COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
    if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
        $_SESSION['VALIDADO'] = "NO";
        $_SESSION['KEYSECRETA'] = "0";
        header("location:index.php");
        exit;
    }

    //COMPROVAR SI ES EL SUPERADMIN O ADMIN O USER CON PERMISOS
    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pprogtareascrear', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pprogtareascrear'] == 1) {
        $expulsar = 1;
    }

    if ($expulsar != 1) {
        header("location:index.php");
        exit;
    }

    //VALIDAMOS SESSION SINO ERROR
    if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {
    ?>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php
            require_once("template/menu.php");
            ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card-body">

                                    <!-- Page Heading -->
                                    <div class="py-5">
                                        <div class="container">
                                            <h1 class="">Añadir Tarea</h1>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form id="formtarea" action="function/creartarea.php" method="post">
                                                        <br>
                                                        <h4 class=""><u>Selecciona los meses en que la tarea será ejecutada.</u></h4>
                                                        <br>

                                                        <!-- CARD MES -->
                                                        <div class="card text-white bg-primary mb-3">
                                                            <div class="card-header text-white bg-primary">Mes</div>
                                                            <div class="card-body">
                                                                <input id="enero" name="mes[]" type="checkbox" value="1" checked>
                                                                <label class="mr-2" for="enero">Enero</label>

                                                                <input id="febrero" name="mes[]" type="checkbox" value="2" checked>
                                                                <label class="mr-2" for="febrero">Febrero</label>

                                                                <input id="marzo" name="mes[]" type="checkbox" value="3" checked>
                                                                <label class="mr-2" for="marzo">Marzo</label>

                                                                <input id="abril" name="mes[]" type="checkbox" value="4" checked>
                                                                <label class="mr-2" for="abril">Abril</label>

                                                                <input id="mayo" name="mes[]" type="checkbox" value="5" checked>
                                                                <label class="mr-2" for="mayo">Mayo</label>

                                                                <input id="junio" name="mes[]" type="checkbox" value="6" checked>
                                                                <label class="mr-2" for="junio">Junio</label>

                                                                <input id="julio" name="mes[]" type="checkbox" value="7" checked>
                                                                <label class="mr-2" for="julio">Julio</label>

                                                                <input id="agosto" name="mes[]" type="checkbox" value="8" checked>
                                                                <label class="mr-2" for="agosto">Agosto</label>

                                                                <input id="septiembre" name="mes[]" type="checkbox" value="9" checked>
                                                                <label class="mr-2" for="septiembre">Septiembre</label>

                                                                <input id="octubre" name="mes[]" type="checkbox" value="10" checked>
                                                                <label class="mr-2" for="octubre">Octubre</label>

                                                                <input id="noviembre" name="mes[]" type="checkbox" value="11" checked>
                                                                <label class="mr-2" for="noviembre">Noviembre</label>

                                                                <input id="diciembre" name="mes[]" type="checkbox" value="12" checked>
                                                                <label class="mr-2" for="diciembre">Diciembre</label>
                                                            </div>
                                                        </div>
                                                        <!-- FIN CARD MES -->



                                                        <hr>
                                                        <h4 class=""><u>Selecciona las semanas en que la tarea será ejecutada.</u></h4>
                                                        <br>

                                                        <!-- CARD SEMANA -->
                                                        <div class="card text-white bg-primary mb-3">
                                                            <div class="card-header text-white bg-primary">Semana:</div>
                                                            <div class="card-body">
                                                                <input id="lunes" name="semana[]" type="checkbox" value="1" checked>
                                                                <label class="mr-2" for="lunes">Lunes</label>

                                                                <input id="martes" name="semana[]" type="checkbox" value="2" checked>
                                                                <label class="mr-2" for="martes">Martes</label>

                                                                <input id="miercoles" name="semana[]" type="checkbox" value="3" checked>
                                                                <label class="mr-2" for="miercoles">Miércoles</label>

                                                                <input id="jueves" name="semana[]" type="checkbox" value="4" checked>
                                                                <label class="mr-2" for="jueves">Jueves</label>

                                                                <input id="viernes" name="semana[]" type="checkbox" value="5" checked>
                                                                <label class="mr-2" for="viernes">Viernes</label>

                                                                <input id="sabado" name="semana[]" type="checkbox" value="6" checked>
                                                                <label class="mr-2" for="sabado">Sábado</label>

                                                                <input id="domingo" name="semana[]" type="checkbox" value="7" checked>
                                                                <label class="mr-2" for="domingo">Domingo</label>
                                                            </div>
                                                        </div>
                                                        <!-- FIN CARD SEMANA -->

                                                        <hr>
                                                        <h4 class=""><u>Selecciona las horas en que la tarea será ejecutada.</u></h4>
                                                        <br>

                                                        <!-- CARD HORA -->
                                                        <div class="card text-white bg-primary mb-3">
                                                            <div class="card-header text-white bg-primary">Hora:</div>
                                                            <div class="card-body">
                                                                <input id="h0" name="hora[]" type="checkbox" value="0">
                                                                <label class="mr-2" for="h0">00:00</label>

                                                                <input id="h1" name="hora[]" type="checkbox" value="1">
                                                                <label class="mr-2" for="h1">01:00</label>

                                                                <input id="h2" name="hora[]" type="checkbox" value="2">
                                                                <label class="mr-2" for="h2">02:00</label>

                                                                <input id="h3" name="hora[]" type="checkbox" value="3">
                                                                <label class="mr-2" for="h3">03:00</label>

                                                                <input id="h4" name="hora[]" type="checkbox" value="4">
                                                                <label class="mr-2" for="h4">04:00</label>

                                                                <input id="h5" name="hora[]" type="checkbox" value="5">
                                                                <label class="mr-2" for="h5">05:00</label>

                                                                <input id="h6" name="hora[]" type="checkbox" value="6">
                                                                <label class="mr-2" for="h6">06:00</label>

                                                                <input id="h7" name="hora[]" type="checkbox" value="7">
                                                                <label class="mr-2" for="h7">07:00</label>

                                                                <input id="h8" name="hora[]" type="checkbox" value="8">
                                                                <label class="mr-2" for="h8">08:00</label>

                                                                <input id="h9" name="hora[]" type="checkbox" value="9">
                                                                <label class="mr-2" for="h9">09:00</label>

                                                                <input id="h10" name="hora[]" type="checkbox" value="10">
                                                                <label class="mr-2" for="h10">10:00</label>

                                                                <input id="h11" name="hora[]" type="checkbox" value="11">
                                                                <label class="mr-2" for="h11">11:00</label>

                                                                <br>
                                                                <input id="h12" name="hora[]" type="checkbox" value="12">
                                                                <label class="mr-2" for="h12">12:00</label>

                                                                <input id="h13" name="hora[]" type="checkbox" value="13">
                                                                <label class="mr-2" for="h13">13:00</label>

                                                                <input id="h14" name="hora[]" type="checkbox" value="14">
                                                                <label class="mr-2" for="h14">14:00</label>

                                                                <input id="h15" name="hora[]" type="checkbox" value="15">
                                                                <label class="mr-2" for="h15">15:00</label>

                                                                <input id="h16" name="hora[]" type="checkbox" value="16">
                                                                <label class="mr-2" for="h16">16:00</label>

                                                                <input id="h17" name="hora[]" type="checkbox" value="17">
                                                                <label class="mr-2" for="h17">17:00</label>

                                                                <input id="h18" name="hora[]" type="checkbox" value="18">
                                                                <label class="mr-2" for="h18">18:00</label>

                                                                <input id="h19" name="hora[]" type="checkbox" value="19">
                                                                <label class="mr-2" for="h19">19:00</label>

                                                                <input id="h20" name="hora[]" type="checkbox" value="20">
                                                                <label class="mr-2" for="h20">20:00</label>

                                                                <input id="h21" name="hora[]" type="checkbox" value="21">
                                                                <label class="mr-2" for="h21">21:00</label>

                                                                <input id="h22" name="hora[]" type="checkbox" value="22">
                                                                <label class="mr-2" for="h22">22:00</label>

                                                                <input id="h23" name="hora[]" type="checkbox" value="23">
                                                                <label class="mr-2" for="h23">23:00</label>
                                                            </div>
                                                        </div>
                                                        <!-- FIN CARD HORA -->

                                                        <hr>
                                                        <h4 class=""><u>Selecciona los minutos en que la tarea será ejecutada.</u></h4>
                                                        <br>

                                                        <!-- CARD MINUTO -->
                                                        <div class="card text-white bg-primary mb-3">
                                                            <div class="card-header text-white bg-primary">Minuto:</div>
                                                            <div class="card-body">
                                                                <input id="m0" name="minuto[]" type="checkbox" value="00">
                                                                <label class="mr-2" for="m0">00</label>

                                                                <input id="m1" name="minuto[]" type="checkbox" value="01">
                                                                <label class="mr-2" for="m1">01</label>

                                                                <input id="m2" name="minuto[]" type="checkbox" value="02">
                                                                <label class="mr-2" for="m2">02</label>

                                                                <input id="m3" name="minuto[]" type="checkbox" value="03">
                                                                <label class="mr-2" for="m3">03</label>

                                                                <input id="m4" name="minuto[]" type="checkbox" value="04">
                                                                <label class="mr-2" for="m4">04</label>

                                                                <input id="m5" name="minuto[]" type="checkbox" value="05">
                                                                <label class="mr-2" for="m5">05</label>

                                                                <input id="m6" name="minuto[]" type="checkbox" value="06">
                                                                <label class="mr-2" for="m6">06</label>

                                                                <input id="m7" name="minuto[]" type="checkbox" value="07">
                                                                <label class="mr-2" for="m7">07</label>

                                                                <input id="m8" name="minuto[]" type="checkbox" value="08">
                                                                <label class="mr-2" for="m8">08</label>

                                                                <input id="m9" name="minuto[]" type="checkbox" value="09">
                                                                <label class="mr-2" for="m9">09</label>

                                                                <input id="m10" name="minuto[]" type="checkbox" value="10">
                                                                <label class="mr-2" for="m10">10</label>

                                                                <input id="m11" name="minuto[]" type="checkbox" value="11">
                                                                <label class="mr-2" for="m11">11</label>

                                                                <input id="m12" name="minuto[]" type="checkbox" value="12">
                                                                <label class="mr-2" for="m12">12</label>

                                                                <input id="m13" name="minuto[]" type="checkbox" value="13">
                                                                <label class="mr-2" for="m13">13</label>

                                                                <input id="m14" name="minuto[]" type="checkbox" value="14">
                                                                <label class="mr-2" for="m14">14</label>

                                                                <input id="m15" name="minuto[]" type="checkbox" value="15">
                                                                <label class="mr-2" for="m15">15</label>

                                                                <input id="m16" name="minuto[]" type="checkbox" value="16">
                                                                <label class="mr-2" for="m16">16</label>

                                                                <input id="m17" name="minuto[]" type="checkbox" value="17">
                                                                <label class="mr-2" for="m17">17</label>

                                                                <input id="m18" name="minuto[]" type="checkbox" value="18">
                                                                <label class="mr-2" for="m18">18</label>

                                                                <input id="m19" name="minuto[]" type="checkbox" value="19">
                                                                <label class="mr-2" for="m19">19</label>

                                                                <br>
                                                                <input id="m20" name="minuto[]" type="checkbox" value="20">
                                                                <label class="mr-2" for="m20">20</label>

                                                                <input id="m21" name="minuto[]" type="checkbox" value="21">
                                                                <label class="mr-2" for="m21">21</label>

                                                                <input id="m22" name="minuto[]" type="checkbox" value="22">
                                                                <label class="mr-2" for="m22">22</label>

                                                                <input id="m23" name="minuto[]" type="checkbox" value="23">
                                                                <label class="mr-2" for="m23">23</label>

                                                                <input id="m24" name="minuto[]" type="checkbox" value="24">
                                                                <label class="mr-2" for="m24">24</label>

                                                                <input id="m25" name="minuto[]" type="checkbox" value="25">
                                                                <label class="mr-2" for="m25">25</label>

                                                                <input id="m26" name="minuto[]" type="checkbox" value="26">
                                                                <label class="mr-2" for="m26">26</label>

                                                                <input id="m27" name="minuto[]" type="checkbox" value="27">
                                                                <label class="mr-2" for="m27">27</label>

                                                                <input id="m28" name="minuto[]" type="checkbox" value="28">
                                                                <label class="mr-2" for="m28">28</label>

                                                                <input id="m29" name="minuto[]" type="checkbox" value="29">
                                                                <label class="mr-2" for="m29">29</label>

                                                                <input id="m30" name="minuto[]" type="checkbox" value="30">
                                                                <label class="mr-2" for="m30">30</label>

                                                                <input id="m31" name="minuto[]" type="checkbox" value="31">
                                                                <label class="mr-2" for="m31">31</label>

                                                                <input id="m32" name="minuto[]" type="checkbox" value="32">
                                                                <label class="mr-2" for="m32">32</label>

                                                                <input id="m33" name="minuto[]" type="checkbox" value="33">
                                                                <label class="mr-2" for="m33">33</label>

                                                                <input id="m34" name="minuto[]" type="checkbox" value="34">
                                                                <label class="mr-2" for="m34">34</label>

                                                                <input id="m35" name="minuto[]" type="checkbox" value="35">
                                                                <label class="mr-2" for="m35">35</label>

                                                                <input id="m36" name="minuto[]" type="checkbox" value="36">
                                                                <label class="mr-2" for="m36">36</label>

                                                                <input id="m37" name="minuto[]" type="checkbox" value="37">
                                                                <label class="mr-2" for="m37">37</label>

                                                                <input id="m38" name="minuto[]" type="checkbox" value="38">
                                                                <label class="mr-2" for="m38">38</label>

                                                                <input id="m39" name="minuto[]" type="checkbox" value="39">
                                                                <label class="mr-2" for="m39">39</label>

                                                                <br>
                                                                <input id="m40" name="minuto[]" type="checkbox" value="40">
                                                                <label class="mr-2" for="m40">40</label>

                                                                <input id="m41" name="minuto[]" type="checkbox" value="41">
                                                                <label class="mr-2" for="m41">41</label>

                                                                <input id="m42" name="minuto[]" type="checkbox" value="42">
                                                                <label class="mr-2" for="m42">42</label>

                                                                <input id="m43" name="minuto[]" type="checkbox" value="43">
                                                                <label class="mr-2" for="m43">43</label>

                                                                <input id="m44" name="minuto[]" type="checkbox" value="44">
                                                                <label class="mr-2" for="m44">44</label>

                                                                <input id="m45" name="minuto[]" type="checkbox" value="45">
                                                                <label class="mr-2" for="m45">45</label>

                                                                <input id="m46" name="minuto[]" type="checkbox" value="46">
                                                                <label class="mr-2" for="m46">46</label>

                                                                <input id="m47" name="minuto[]" type="checkbox" value="47">
                                                                <label class="mr-2" for="m47">47</label>

                                                                <input id="m48" name="minuto[]" type="checkbox" value="48">
                                                                <label class="mr-2" for="m48">48</label>

                                                                <input id="m49" name="minuto[]" type="checkbox" value="49">
                                                                <label class="mr-2" for="m49">49</label>

                                                                <input id="m50" name="minuto[]" type="checkbox" value="50">
                                                                <label class="mr-2" for="m50">50</label>

                                                                <input id="m51" name="minuto[]" type="checkbox" value="51">
                                                                <label class="mr-2" for="m51">51</label>

                                                                <input id="m52" name="minuto[]" type="checkbox" value="52">
                                                                <label class="mr-2" for="m52">52</label>

                                                                <input id="m53" name="minuto[]" type="checkbox" value="53">
                                                                <label class="mr-2" for="m53">53</label>

                                                                <input id="m54" name="minuto[]" type="checkbox" value="54">
                                                                <label class="mr-2" for="m54">54</label>

                                                                <input id="m55" name="minuto[]" type="checkbox" value="55">
                                                                <label class="mr-2" for="m55">55</label>

                                                                <input id="m56" name="minuto[]" type="checkbox" value="56">
                                                                <label class="mr-2" for="m56">56</label>

                                                                <input id="m57" name="minuto[]" type="checkbox" value="57">
                                                                <label class="mr-2" for="m57">57</label>

                                                                <input id="m58" name="minuto[]" type="checkbox" value="58">
                                                                <label class="mr-2" for="m58">58</label>

                                                                <input id="m59" name="minuto[]" type="checkbox" value="59">
                                                                <label class="mr-2" for="m59">59</label>
                                                            </div>
                                                        </div>
                                                        <!-- FIN CARD MINUTO -->

                                                        <hr>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="nombretarea">Nombre Tarea:</label>
                                                                <input type="text" id="nombretarea" name="nombretarea" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="laaccion">Acción</label> <select id="laaccion" name="laaccion" class="form-control" required="required">
                                                                    <option value="acc1">Apagar Servidor</option>
                                                                    <option value="acc2">Iniciar Servidor</option>
                                                                    <option value="acc3">Backup Servidor</option>
                                                                    <option value="acc4">Enviar Comando</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <label for="elcomando">Comando:</label>
                                                        <textarea class="form-control" id="elcomando" name="elcomando"></textarea>
                                                        <br>
                                                        <p class="lead" id="textotarearetorno"></p>
                                                        <hr>
                                                        <button class="btn btn-lg btn-primary btn-block" id="creatarea" name="creatarea" type="submit">Crear Tarea</button>
                                                        <input type="hidden" name="action" value="submit">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <script src="js/nuevatarea.js"></script>

    <?php
        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>


</body>

</html>