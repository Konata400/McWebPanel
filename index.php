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
//require_once("template/session.php");
require_once("template/errorreport.php");
require_once("template/header.php");
?>

<!-- Estilo CSS -->
<link href="css/signin.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">

</head>

<body class="text-center">

  <form class="form-signin" action="function/login.php" method="POST" id="login-form">

    <?php

    $elerror = 0;
    $yainstall = 0;
    $showerrors = "";

    $iniverificarpraiz = getcwd();
    $iniverificarpraiz = trim($iniverificarpraiz);

    $iniverifirutatemplate = getcwd();
    $iniverifirutatemplate = trim($iniverifirutatemplate);
    $iniverifirutatemplate .= "/template";

    $iniverifirutaconfig = getcwd();
    $iniverifirutaconfig = trim($iniverifirutaconfig);
    $iniverifirutaconfig .= "/config";

    $iniverificonfuserjson = getcwd();
    $iniverificonfuserjson = trim($iniverificonfuserjson);
    $iniverificonfuserjson .= "/config/confuser.json";

    $iniverificonfopcionesphp = getcwd();
    $iniverificonfopcionesphp = trim($iniverificonfopcionesphp);
    $iniverificonfopcionesphp .= "/config/confopciones.php";

    $iniverificonfserverpropertiestxt = getcwd();
    $iniverificonfserverpropertiestxt = trim($iniverificonfserverpropertiestxt);
    $iniverificonfserverpropertiestxt .= "/config/serverproperties.txt";

    //VERIFICAR CARPETA RAIZ
    clearstatcache();
    if (!is_readable($iniverificarpraiz)) {
      $showerrors .= 'Error: No tienes permisos de lectura en la carpeta raiz, revisa los permisos de linux.<br><br>';
      $elerror = 1;
    }

    if (!is_writable($iniverificarpraiz)) {
      $showerrors .= 'Error: No tienes permisos de escritura en la carpeta raiz, revisa los permisos de linux.<br><br>';
      $elerror = 1;
    }

    if (!is_executable($iniverifirutatemplate)) {
      $showerrors .= 'Error: No tienes permisos de ejecucion en la carpeta raiz, revisa los permisos de linux.<br><br>';
      $elerror = 1;
    }

    //VERIFICAR TEMPLATE
    clearstatcache();
    if (!is_readable($iniverifirutatemplate)) {
      $showerrors .= 'Error: No tienes permisos de lectura en la carpeta template, revisa los permisos de linux.<br><br>';
      $elerror = 1;
    }

    clearstatcache();
    if (!is_writable($iniverifirutatemplate)) {
      $showerrors .= 'Error: No tienes permisos de escritura en la carpeta template, revisa los permisos de linux.<br><br>';
      $elerror = 1;
    }

    clearstatcache();
    if (!is_executable($iniverifirutatemplate)) {
      $showerrors .= 'Error: No tienes permisos de ejecucion en la carpeta template, revisa los permisos de linux.<br><br>';
      $elerror = 1;
    }

    //VERIFICAR CONFIG
    clearstatcache();
    if (file_exists($iniverifirutaconfig)) {
      clearstatcache();
      if (!is_readable($iniverifirutaconfig)) {
        $showerrors .= 'Error: No tienes permisos de lectura en la carpeta config, revisa los permisos de linux.<br><br>';
        $elerror = 1;
        $yainstall = 1;
      }
    } else {
      $yainstall = 1;
    }

    clearstatcache();
    if (file_exists($iniverifirutaconfig)) {
      clearstatcache();
      if (!is_writable($iniverifirutaconfig)) {
        $showerrors .= 'Error: No tienes permisos de escritura en la carpeta config, revisa los permisos de linux.<br><br>';
        $elerror = 1;
        $yainstall = 1;
      }
    } else {
      $yainstall = 1;
    }

    clearstatcache();
    if (file_exists($iniverifirutaconfig)) {
      clearstatcache();
      if (!is_executable($iniverifirutaconfig)) {
        $showerrors .= 'Error: No tienes permisos de ejecucion en la carpeta config, revisa los permisos de linux.<br><br>';
        $elerror = 1;
        $yainstall = 1;
      }
    } else {
      $yainstall = 1;
    }

    //VERIFICAR /config/confuser.json";
    clearstatcache();
    if (file_exists($iniverificonfuserjson)) {
      clearstatcache();
      if (!is_readable($iniverificonfuserjson)) {
        $showerrors .= 'Error: No tiene permisos de lectura en el archivo /config/confuser.json, revisa los permisos de linux.<br><br>';
        $elerror = 1;
        $yainstall = 1;
      }
    } else {
      $yainstall = 1;
    }

    clearstatcache();
    if (file_exists($iniverificonfuserjson)) {
      clearstatcache();
      if (!is_writable($iniverificonfuserjson)) {
        $showerrors .= 'Error: No tiene permisos de escritura en el archivo /config/confuser.json, revisa los permisos de linux.<br><br>';
        $elerror = 1;
        $yainstall = 1;
      }
    } else {
      $yainstall = 1;
    }

    //VERIFICAR /config/confopciones.php";
    clearstatcache();
    if (file_exists($iniverificonfopcionesphp)) {
      clearstatcache();
      if (!is_readable($iniverificonfopcionesphp)) {
        $showerrors .= 'Error: No tienes permisos de lectura en el archivo /config/confopciones.php, revisa los permisos de linux.<br><br>';
        $elerror = 1;
        $yainstall = 1;
      }
    } else {
      $yainstall = 1;
    }

    clearstatcache();
    if (file_exists($iniverificonfopcionesphp)) {
      clearstatcache();
      if (!is_writable($iniverificonfopcionesphp)) {
        $showerrors .= 'Error: No tienes permisos de escritura en el archivo /config/confopciones.php, revisa los permisos de linux.<br><br>';
        $elerror = 1;
        $yainstall = 1;
      }
    } else {
      $yainstall = 1;
    }


    if ($yainstall == 0 && $elerror == 0) {

      //VERIFICAR /config/serverproperties.txt";
      clearstatcache();
      if (!file_exists($iniverificonfserverpropertiestxt)) {
        $showerrors .= 'Error: El archivo serverproperties.txt no existe , vuelve a realizar el install.<br><br>';
        $elerror = 1;
      } else {

        clearstatcache();
        if (!is_readable($iniverificonfserverpropertiestxt)) {
          $showerrors .= 'Error: No tienes permisos de lectura en el archivo /config/serverproperties.txt, revisa los permisos de linux.<br><br>';
          $elerror = 1;
        }

        clearstatcache();
        if (!is_writable($iniverificonfserverpropertiestxt)) {
          $showerrors .= 'Error: No tienes permisos de escritura en el archivo /config/serverproperties.txt, revisa los permisos de linux.<br><br>';
          $elerror = 1;
        }
      }
    }

    if ($elerror == 1) {
      echo '<div class="alert alert-danger" role="alert">' .$showerrors .'</div>';
      exit;
    }



    //CARGA VARIABLES
    $sumaconfig = 0;
    $sumainstall = 0;
    $rutaarchivo = "";
    $rutainstall = "";

    //COMPROVAR SI EXISTE LA CONFIG
    $rutaarchivo = getcwd();
    $rutaarchivo = trim($rutaarchivo);
    $rutaarchivo .= "/config/confuser.json";

    clearstatcache();
    if (file_exists($rutaarchivo)) {
      $sumaconfig++;
    }

    $rutaarchivo = getcwd();
    $rutaarchivo = trim($rutaarchivo);
    $rutaarchivo .= "/config/confopciones.php";

    clearstatcache();
    if (file_exists($rutaarchivo)) {
      $sumaconfig++;
    }

    //COMPROVAR SI EXISTE INSTALL Y REDIRECCIONAR
    $rutainstall = getcwd();
    $rutainstall = trim($rutainstall);
    $rutainstall .= "/install";

    clearstatcache();
    if (file_exists($rutainstall)) {
      $sumainstall++;
    }

    //COMPROVAR RESULTADOS
    if ($sumaconfig == 2 && $sumainstall == 1) {
      echo '<div class="alert alert-danger" role="alert">Error: Borra la carpeta install.</div>';
      exit;
    } elseif ($sumaconfig == 0 && $sumainstall == 0) {
      echo '<div class="alert alert-danger" role="alert">Error: La configuración no existe, vuelve a instalar la carpeta install y realiza una instalación correcta.</div>';
      exit;
    } elseif ($sumaconfig == 1 && $sumainstall == 0) {
      echo '<div class="alert alert-danger" role="alert">Error: Faltan archivos de configuración, vuelve a instalar la carpeta install y realiza una instalación correcta.</div>';
      exit;
    } elseif ($sumaconfig == 1 && $sumainstall == 1) {
      echo '<div class="alert alert-danger" role="alert">Error: Faltan archivos de configuración, vuelve a realizar la instalación.<br><br><a href="/install/index.php">Pulsa para instalar</a></div>';
      exit;
    } elseif ($sumaconfig == 0 && $sumainstall == 1) {
      $laruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      header("location:" . $laruta . '/install/index.php');
      exit;
    } elseif ($sumaconfig == 2 && $sumainstall == 0) {
      //instalacion correcta
      require_once("template/session.php");

      if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
        $_SESSION['VALIDADO'] = "NO";
        $_SESSION['KEYSECRETA'] = "0";
      }
      
      if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {
        header("location:status.php");
        exit;
      }

      require_once("config/confopciones.php");
    }
    $recnombreserv = CONFIGNOMBRESERVER;
    ?>

    <img class="mb-4" src="img/icons/apple-icon-72x72.png" alt="LOGO" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal"><?php echo $recnombreserv; ?></h1>

    <p class="lead" id="textologincount"></p>
    <p class="lead" id="textologinerror"></p>

    <label for="inputUser" class="sr-only">Nombre de usuario</label>
    <input type="text" id="inputUser" name="eluser" class="form-control" placeholder="Nombre de usuario" required autofocus>

    <label for="inputPassword" class="sr-only">Contraseña</label>
    <input type="password" id="inputPassword" name="elpass" class="form-control" placeholder="Contraseña" required>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Recuérdame
      </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" id="botoninisesion" type="submit" value="Login">Iniciar sesión</button>

  </form>

  <script src="js/login.js"></script>

</body>

</html>