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

<link href="css/eula.css" rel="stylesheet">

</head>

<body>

    <?php

    //COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
    if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
        $_SESSION['VALIDADO'] = "NO";
        $_SESSION['KEYSECRETA'] = "0";
        header("location:index.php");
        exit;
    }

    //VALIDAMOS SESSION SINO ERROR
    if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {

        $receulaminecraft = CONFIGEULAMINECRAFT;

        if($receulaminecraft == 1){
            header("location:status.php");
            exit;
        }

    ?>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center" >Mojang EULA</h1>
                    </div>
                    <div class="col-md-12 border terms-text">
                        <p>Updated: 25 septiembre 2017 09:02</p>
                        <h1 id="contrato-de-licencia-del-usuario-final-de-minecraft">CONTRATO DE LICENCIA DEL USUARIO FINAL DE MINECRAFT</h1>
                        <p>Con el fin de proteger Minecraft (nuestro "Juego") y los miembros de nuestra comunidad, debemos establecer algunas reglas en estos términos de licencia para el usuario final para la descarga y el uso del juego. Esta licencia constituye un contrato legal entre usted y nosotros (Mojang AB) y describe los términos y condiciones para utilizar el Juego. Al igual que a usted, no nos gusta leer documentos de licencias, por lo tanto, hemos intentado hacerlos lo más cortos posible. Si no cumple estas reglas, podemos impedirle que utilice nuestro Juego. Si consideramos que es necesario, incluso podemos solicitar ayuda a nuestros abogados. Lea, imprima y guarde una copia de estos términos y condiciones para sus registros porque no se le guardará ninguna.</p>
                        <p>Al comprar, descargar, utilizar o jugar a nuestro Juego, acepta cumplir las reglas de estos términos del contrato de licencia para el usuario final ("CLUF"). Si no desea o no puede aceptar estas reglas, no puede comprar, descargar, utilizar o jugar a nuestro Juego. Este CLUF incorpora <a href="https://account.mojang.com/terms#website">las condiciones de uso para el sitio web de mojang.com ("Términos de la cuenta")</a>, nuestras <a href="https://account.mojang.com/terms#brand">instrucciones de uso de la marca y los activos</a> y <a href="https://account.mojang.com/terms#privacy">nuestra política de privacidad</a>. Al aceptar este CLUF, también acepta todos los términos de los documentos anteriores, por lo tanto, léalos detenidamente.</p>
                        <h2 id="regla-principal">REGLA PRINCIPAL</h2>
                        <p>La regla principal es que no debe distribuir nada de lo que hemos hecho, salvo que lo aceptemos específicamente. Con "distribuir nada de lo que hemos hecho" nos referimos a:</p>
                        <ul>
                            <li>dar copias de nuestro Juego a otras personas;</li>
                            <li>realizar un uso comercial de algo que hayamos hecho;</li>
                            <li>intentar ganar dinero con algo que hayamos hecho; o</li>
                            <li>permitir que otras personas obtengan acceso a cosas que hayamos hecho de una forma que sea injusta o no razonable;</li>
                        </ul>
                        <p>salvo que lo aceptemos específicamente. Asimismo, para que quede bien claro, "el Juego" o "lo que hemos hecho" incluye entre otros, el software de servidor o cliente de nuestro Juego e incluye Minecraft y Minecraft: Java Edition en todas las plataformas. Además, también incluye las actualizaciones, las revisiones, el contenido descargable, los complementos o las versiones modificadas de un Juego, partes de estas cosas o cualquier otra cosa que hayamos hecho.</p>
                        <p>De lo contrario, estamos bastante tranquilos con lo que hace, de hecho, realmente le animamos a hacer cosas interesantes (simplemente no haga las cosas que decimos que no puede hacer).</p>
                        <h2 id="uso-del-juego">USO DEL JUEGO</h2>
                        <p>Se le ha concedido una licencia para el Juego para que pueda jugar con él y utilizarlo, usted mismo, en sus dispositivos.</p>
                        <p>A continuación, también le concedemos derechos limitados para realizar otras cosas. Sin embargo, tenemos que restringirlos de alguna forma porque la gente no sobrepase el límite. Si desea realizar algo que pertenece a algo que hemos hecho, nos sentiremos honrados, pero asegúrese de que no se pueda interpretar como oficial y que cumpla este CLUF, así como las instrucciones de uso de la marca y los activos, y sobre todo no haga uso comercial de nada que hayamos hecho.</p>
                        <p>La licencia y el permiso que le concedemos para utilizar y jugar a nuestro Juego pueden revocarse si no cumple algún término de este CLUF.</p>
                        <p>Cuando compra nuestro Juego, recibe una licencia que le concede permiso para instalar el Juego en su dispositivo y para utilizar y jugar al juego en ese dispositivo según se describe en este CLUF. Este permiso es personal, por lo tanto, no puede distribuir el Juego (ni ninguna parte de él) a nadie. Esto también significa que no puede vender ni alquilar el Juego o ponerlo a disposición para que otras personas accedan a él y tampoco puede transmitir ni revender ninguna clave de licencia. Sin embargo, puede dar códigos de regalo que haya comprado a través de nuestro sistema de códigos de regalo oficial. Esto es importante para ayudarnos a detener la piratería y el fraude y para proteger nuestro Juego. También es importante para evitar que los miembros de nuestra comunidad compren versiones pirateadas de nuestro Juego o claves de licencia fraudulentas, que puede que cancelemos, por ejemplo, en caso de fraude.</p>
                        <p>Si ha comprado el Juego, puede hacer pruebas con él y modificarlo agregando cambios, herramientas o complementos, a los cuales haremos referencia en conjunto como "Modificaciones". Con "Modificaciones" nos referimos a algo original que usted u otra persona hayan creado que no contenga una parte substancial de nuestro contenido o código de propiedad intelectual. Cuando combine su Modificación con el software de Minecraft, denominaremos esa combinación "Versión modificada" del Juego. Nos reservamos la última palabra sobre lo que constituye una Modificación y lo que no. No puede distribuir ninguna Versión modificada de nuestro Juego o software y agradeceríamos que no utilizara las Modificaciones para molestar a otras personas. Básicamente, puede distribuir las Modificaciones pero no las versiones pirateadas o las Versiones modificadas del software de servidor o cliente.</p>
                        <p>Dentro de los límites razonables, puede hacer lo que quiera con las capturas de pantalla y los vídeos del Juego. Con "dentro de los límites razonables" nos referimos a que no puede hacer uso comercial de ellos ni realizar acciones que sean injustas o afecten negativamente nuestros derechos, salvo que lo autoricemos específicamente en este CLUF, que lo permitan las Instrucciones de uso de la Marca y los Activos o que se le proporcionen para esto en un contracto específico para usted. Sin embargo, si carga vídeos del juego a sitios de streaming y de uso compartido de vídeos, tiene permiso para poner anuncios en ellos. En ese caso, no se dedique simplemente a copiar recursos de arte y a transmitirlos, eso no tiene nada de divertido.</p>
                        <p>Básicamente, la regla simple es que no debe hacer uso comercial de nada que hayamos hecho, salvo que lo indiquemos específicamente. En caso de que la legislación lo permita expresamente como, por ejemplo, en virtud de una doctrina de "trato justo" o "uso leal", también tendrá permiso, pero solo en la medida en que la legislación que se le aplica indique dicha circunstancia.</p>
                        <p>Con el fin de garantizar la integridad del Juego, necesitamos que todas las descargas y actualizaciones del Juego procedan de un origen autorizado. También es importante para nosotros que los servicios o herramientas de terceros no parezcan "oficiales", dado que no podemos garantizar su calidad. Esto forma parte de la responsabilidad que tenemos con los clientes de Minecraft. Asegúrese también de que ha leído nuestras instrucciones de uso de la marca y los activos.</p>
                        <h2 id="titularidad-de-nuestro-juego-y-otras-cosas">TITULARIDAD DE NUESTRO JUEGO Y OTRAS COSAS</h2>
                        <p>Aunque le licenciamos su permiso para instalar nuestro Juego en el dispositivo y jugar con él, nosotros seguimos siendo los propietarios. También somos los propietarios de nuestras marcas y de cualquier contenido que incluya el Juego. Por lo tanto, cuando adquiere nuestro Juego, también adquiere una licencia para utilizar o jugar a nuestro Juego de acuerdo con este CLUF: no compra el juego en sí. Los únicos permisos que tiene en relación con el Juego y su instalación son los permisos que se describen en este CLUF.</p>
                        <p>Cualquier Modificación que cree del Juego desde cero pertenecerá a usted (incluidas las Modificaciones de ejecución previa y las Modificaciones en memoria) y puede hacer lo que quiera con ellas, siempre que no las venda o trate de ganar dinero con ellas y siempre que no distribuya Versiones modificadas del Juego. Recuerde que una Modificación hace referencia a un trabajo original creado por usted y que no contiene una parte substancial de nuestro contenido o código. Usted solo es propietario de lo que creó y no es propietario de nuestro código ni contenido.</p>
                        <h2 id="contenido">CONTENIDO</h2>
                        <p>Si pone a disposición cualquier contenido en o a través de nuestro Juego, acepta darnos permiso para utilizar, copiar, modificar, adaptar, distribuir y mostrar públicamente dicho contenido. Este permiso es irrevocable y también acepta que demos permiso a otras personas para utilizar, copiar, modificar, adaptar, distribuir y mostrar públicamente su contenido. No renuncia a sus derechos de propiedad de contenido, únicamente nos concede permiso a nosotros y a otros usuarios para utilizarlo. Por ejemplo, es posible que necesitemos copiar, volver a formatear y distribuir contenido que publica en nuestro Sitio web para que otras personas lo lean. Si no desea concedernos estos permisos, no ponga a disposición contenido en o a través de nuestro Juego. Piense detenidamente antes de poner a disposición cualquier contenido, ya que es posible que se haga público y que incluso otras personas lo utilicen de una manera que no le gusta.</p>
                        <p>Si tiene previsto poner a disposición algún contenido en o a través de nuestro Juego, este no debe ser ilegal ni ofensivo para las personas, debe ser sincero y lo debe haber escrito usted mismo. Entre los ejemplos de los tipos de cosas que no debe poner a disposición a través de nuestro Juego se incluyen: publicaciones que incluyan lenguaje racista u homofóbico; publicaciones acosadoras o provocadoras; publicaciones que sean ofensivas o que causen daños a la reputación de nuestras personas u otras; publicaciones que incluyan contenido porno o la imagen o creación de otra persona; o publicaciones que suplanten un moderador o intenten engañar o explotar a personas.</p>
                        <p>Usted debe ser el creador de cualquier contenido que ponga a disposición en nuestro Juego o debe tener el permiso o derecho legal para hacerlo. No debe poner a disposición ningún contenido, y acepta que no debe hacerlo, mediante el Juego que infrinja los derechos de otras personas. '</p>
                        <p>Nos reservamos el derecho de retirar cualquier contenido según nuestro criterio.</p>
                        <p><strong>Tenga cuidado si habla con personas en nuestro Juego. Es complicado tanto para usted como para nosotros saber con seguridad que lo que la gente dice es verdad, o incluso si la gente es realmente quien dice ser. Debe pensárselo dos veces antes de dar información acerca de usted.</strong></p>
                        <h2 id="actualizaciones">ACTUALIZACIONES</h2>
                        <p>Es posible que pongamos a disposición actualizaciones o revisiones (en conjunto "actualizaciones") cada cierto tiempo, pero no estamos obligados a hacerlo. Tampoco estamos obligados a proporcionar soporte técnico continuo ni mantenimiento de ningún Juego. Evidentemente, esperamos poder seguir lanzando nuevas actualizaciones de nuestro Juego, pero simplemente no podemos garantizarlo. Las actualizaciones incluyen cambios que es posible que no funcionen correctamente con otro software, como las Modificaciones. Es una lástima, pero asumimos ninguna responsabilidad al respecto. Si le ocurre, intente ejecutar una versión anterior.</p>
                        <p>RESPONSABILIDAD Y LEGISLACIÓN APLICABLE</p>
                        <p>Los términos de este CLUF no afectan ningún derecho legal (estatuario) que puede tener en virtud de la legislación que se le aplica para el Juego. PUEde que tenga determinados derechos que la legislación que se le aplica indique que no se pueden excluir. Nada de lo que manifestamos en estos términos afectará estos derechos legales, incluso si decimos algo que suene como una contradicción de sus derechos legales. Eso es a lo que nos referimos cuando decimos "sujeto a la legislación aplicable".</p>
                        <p>SUJETO A LA LEGISLACIÓN APLICABLE, CUANDO OBTIENE UNA COPIA DE NUESTRO JUEGO, LO PROPORCIONAMOS "TAL CUAL". LAS ACTUALIZACIONES TAMBIÉN SE PROPORCIONAN "TAL CUAL". ESTO SIGNIFICA QUE NO LE PROMETEMOS NADA EN RELACIÓN CON EL ESTÁNDAR O LA CALIDAD DE NUESTRO JUEGO O EL HECHO DE QUE FUNCIONE ININTERRUMPIDAMENTE O ESTÉ LIBRE DE ERRORES. NO SOMOS RESPONSABLES DE NINGUNA PÉRDIDA O DAÑO QUE ESTO PUEDA CAUSAR. USTED ASUME EL RIESGO TOTAL DE SU CALIDAD Y RENDIMIENTO. DEBE ACEPTAR QUE ES POSIBLE QUE LANCEMOS JUEGOS MUCHO ANTES DE QUE SE FINALICEN Y, POR ESTE MOTIVO, ES POSIBLE QUE TENGAN ERRORES (Y A MENUDO TENDRÁN), PERO PREFERIMOS LANZAR ESTAS CARACTERÍSTICAS DE FORMA ANTICIPADA QUE HACERLE ESPERAR PARA OBTENER LA PERFECCIÓN. SI DESEA NOTIFICARNOS UN ERROR POTENCIAL, DISPONEMOS DE UN SITIO PARA HACERLO AQUÍ.</p>
                        <p>Las leyes del país donde tiene su residencia habitual regirán este CLUF y todos los conflictos, como los conflictos relacionados con él, nuestro Juego o nuestro Sitio web, con independencia de conflictos de principios legales. </p>
                        <h2 id="terminaci-n">TERMINACIÓN</h2>
                        <p>Si queremos, podemos terminar este CLUF en caso de que incumpla alguno de los términos. Usted también puede terminarlo en cualquier momento; únicamente tiene que desinstalar el Juego de su dispositivo y el CLUF se terminará. Si se termina el CLUF, ya no podrá tener ningún derecho del Juego que le concede esta licencia. Sin embargo, aún tendrá el derecho de las cosas que haya creado usted mismo con el juego. Los párrafos sobre "Titularidad de nuestro Juego", "Nuestra responsabilidad" y "Disposiciones generals" se seguirán aplicando incluso después de que haya terminado el CLUF.</p>
                        <h2 id="disposiciones-generales">DISPOSICIONES GENERALES</h2>
                        <p>Es posible que su legislación local le conceda derechos que este CLUF no puede cambiar; si es así, este CLUF se aplica en la medida en que lo permita la legislación. Ningún contenido de esta licencia limita nuestra responsabilidad por muerte o daños físicos que se produzcan como resultado de nuestra negligencia o manifestaciones dolosas.</p>
                        <p>Podemos cambiar este CLUF cada cierto tiempo, si tenemos motivos para hacerlo. Por ejemplo, podemos realizar cambios en nuestros juegos, prácticas u obligación legal. Sin embargo, estos cambios solo entrarán en vigor en la medida en que puedan aplicarse legalmente. Por ejemplo, si utiliza el Juego únicamente en modo de un solo jugador y no utiliza las actualizaciones que ponemos a disposición, se aplica el CLUF antiguo, sin embargo, si utiliza las actualizaciones o partes del juego que dependen de nuestra oferta de servicios online continuos, entonces se aplica el nuevo CLUF. En ese caso, le informaremos del cambio antes de que entre en vigor mediante la publicación de una notificación en nuestro Sitio web o de otra forma razonable. No seremos injustos en relación con esto, pero, a veces la legislación cambia o alguien hace algo que afecta los otros usuarios del Juego y, por tanto, tenemos que tomar medidas.</p>
                        <p>Si se pone en contacto con nosotros con alguna sugerencia para cualquiera de nuestros Sitios web o Juegos, esa sugerencia la realiza gratuitamente y no tenemos ninguna obligación de aceptarla o considerarla. Esto significa que podemos utilizar o no utilizar su sugerencia de la manera que queramos y no tenemos que pagarle nada por ella. Si considera que tiene una sugerencia por la que estaríamos dispuestos a pagarle, no envíe su sugerencia sin primero indicarnos que espera que se la paguemos y sin que le hayamos respondido y pedido por escrito que nos envíe la sugerencia.</p>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg my-2" id="ACEPTAREULA" type="button">Aceptar EULA</button>
                    <button class="btn btn-secondary btn-block" id="CANCELAREULA" type="button">Cancelar</button>
                </div>
            </div>
        </div>

        <script src="js/eula.js"></script>

    <?php



    } else {
        header("location:index.php");
    }
    ?>

</body>

</html>