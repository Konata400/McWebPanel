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
<link href="css/motd.css" rel="stylesheet">

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
    if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2 || array_key_exists('pconfmine', $_SESSION['CONFIGUSER']) && $_SESSION['CONFIGUSER']['pconfmine'] == 1) {
        $expulsar = 1;
    }

    if ($expulsar != 1) {
        header("location:index.php");
        exit;
    }

    //VALIDAMOS SESSION SINO ERROR
    if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {

        function leerlineas($eltipo)
        {
            $rutacarpetamine = getcwd();
            $rutacarpetamine = trim($rutacarpetamine);
            $rutacarpetamine .= "/config/serverproperties.txt";

            clearstatcache();
            if (file_exists($rutacarpetamine)) {
                $gestor = @fopen($rutacarpetamine, "r");

                while (($búfer = fgets($gestor, 4096)) !== false) {
                    $str = $búfer;
                    $array = explode("=", $str);
                    if ($array[0] == $eltipo) {
                        if ($array[0] == 'motd') {
                            return trim(substr($str, 5));
                        } else {
                            return trim($array[1]);
                        }
                    }
                }

                if (!feof($gestor)) {
                    echo "Error: fallo inesperado de fgets()\n";
                }
                fclose($gestor);
            }
        }

        function leermotd($texto)
        {
            $texto = "<span class='colreset'>" . $texto;

            //SALTO
            $texto = str_replace("\\n", "</span><br>", $texto);

            //NEGRITA
            $texto = str_replace("\u00a7l", "<strong>", $texto);

            //CURSIVA
            $texto = str_replace("\u00a7o", "<i>", $texto);

            //SUBRAYADO
            $texto = str_replace("\u00a7n", "<u>", $texto);

            //TACHADO
            $texto = str_replace("\u00a7m", "<s>", $texto);

            //RESET
            $texto = str_replace("\u00a7r", "</strong></i></u></s><span class='colreset'>", $texto);

            //COLORES MAYUSCULA
            $texto = str_replace("\u00A70", "<span class='col01'>", $texto);
            $texto = str_replace("\u00A71", "<span class='col02'>", $texto);
            $texto = str_replace("\u00A72", "<span class='col03'>", $texto);
            $texto = str_replace("\u00A73", "<span class='col04'>", $texto);
            $texto = str_replace("\u00A74", "<span class='col05'>", $texto);
            $texto = str_replace("\u00A75", "<span class='col06'>", $texto);
            $texto = str_replace("\u00A76", "<span class='col07'>", $texto);
            $texto = str_replace("\u00A77", "<span class='col08'>", $texto);
            $texto = str_replace("\u00A78", "<span class='col09'>", $texto);
            $texto = str_replace("\u00A79", "<span class='col10'>", $texto);
            $texto = str_replace("\u00A7a", "<span class='col11'>", $texto);
            $texto = str_replace("\u00A7b", "<span class='col12'>", $texto);
            $texto = str_replace("\u00A7c", "<span class='col13'>", $texto);
            $texto = str_replace("\u00A7d", "<span class='col14'>", $texto);
            $texto = str_replace("\u00A7e", "<span class='col15'>", $texto);
            $texto = str_replace("\u00A7f", "<span class='col16'>", $texto);

            //COLORES MINUSCULA
            $texto = str_replace("\u00a70", "<span class='col01'>", $texto);
            $texto = str_replace("\u00a71", "<span class='col02'>", $texto);
            $texto = str_replace("\u00a72", "<span class='col03'>", $texto);
            $texto = str_replace("\u00a73", "<span class='col04'>", $texto);
            $texto = str_replace("\u00a74", "<span class='col05'>", $texto);
            $texto = str_replace("\u00a75", "<span class='col06'>", $texto);
            $texto = str_replace("\u00a76", "<span class='col07'>", $texto);
            $texto = str_replace("\u00a77", "<span class='col08'>", $texto);
            $texto = str_replace("\u00a78", "<span class='col09'>", $texto);
            $texto = str_replace("\u00a79", "<span class='col10'>", $texto);
            $texto = str_replace("\u00a7a", "<span class='col11'>", $texto);
            $texto = str_replace("\u00a7b", "<span class='col12'>", $texto);
            $texto = str_replace("\u00a7c", "<span class='col13'>", $texto);
            $texto = str_replace("\u00a7d", "<span class='col14'>", $texto);
            $texto = str_replace("\u00a7e", "<span class='col15'>", $texto);
            $texto = str_replace("\u00a7f", "<span class='col16'>", $texto);

            //á
            $texto = str_replace("\u00e1", "á", $texto);
            $texto = str_replace("\u00c1", "Á", $texto);
            //é
            $texto = str_replace("\u00e9", "é", $texto);
            $texto = str_replace("\u00c9", "É", $texto);
            //í
            $texto = str_replace("\u00ed", "í", $texto);
            $texto = str_replace("\u00cd", "Í", $texto);
            //ó
            $texto = str_replace("\u00f3", "ó", $texto);
            $texto = str_replace("\u00d3", "Ó", $texto);
            //ú
            $texto = str_replace("\u00fa", "ú", $texto);
            $texto = str_replace("\u00da", "Ú", $texto);

            //à
            $texto = str_replace("\u00e0", "à", $texto);
            $texto = str_replace("\u00c0", "À", $texto);
            //è
            $texto = str_replace("\u00e8", "è", $texto);
            $texto = str_replace("\u00c8", "È", $texto);
            //ì
            $texto = str_replace("\u00ec", "ì", $texto);
            $texto = str_replace("\u00cc", "Ì", $texto);
            //ò
            $texto = str_replace("\u00f2", "ò", $texto);
            $texto = str_replace("\u00d2", "Ò", $texto);
            //ù
            $texto = str_replace("\u00f9", "ù", $texto);
            $texto = str_replace("\u00d9", "Ù", $texto);

            //ç
            $texto = str_replace("\u00e7", "ç", $texto);
            $texto = str_replace("\u00c7", "Ç", $texto);

            //ü
            $texto = str_replace("\u00fc", "ü", $texto);
            $texto = str_replace("\u00dc", "Ü", $texto);

            //ï
            $texto = str_replace("\u00ef", "ï", $texto);
            $texto = str_replace("\u00cf", "Ï", $texto);

            //¨
            $texto = str_replace("\u00a8", "¨", $texto);

            //¿
            $texto = str_replace("\u00bf", "¿", $texto);

            //ñ
            $texto = str_replace("\u00f1", "ñ", $texto);
            $texto = str_replace("\u00d1", "Ñ", $texto);

            //¶
            $texto = str_replace("\u00b6", "¶", $texto);

            //×
            $texto = str_replace("\u00d7", "×", $texto);

            //Ø
            $texto = str_replace("\u00d8", "Ø", $texto);


            //Þ
            $texto = str_replace("\u00de", "Þ", $texto);

            //÷
            $texto = str_replace("\u00f7", "÷", $texto);

            //ø
            $texto = str_replace("\u00f8", "ø", $texto);

            //þ
            $texto = str_replace("\u00fe", "þ", $texto);

            //…
            $texto = str_replace("\u00fe", "…", $texto);

            //™
            $texto = str_replace("\u2122", "™", $texto);

            //►
            $texto = str_replace("\u25ba", "►", $texto);

            //•
            $texto = str_replace("\u2022", "•", $texto);

            //♦
            $texto = str_replace("\u2666", "♦", $texto);

            //≈
            $texto = str_replace("\u2248", "≈", $texto);

            //❛
            $texto = str_replace("\u275b", "❛", $texto);

            //∘
            $texto = str_replace("\u2218", "∘", $texto);

            //∙
            $texto = str_replace("\u2219", "∙", $texto);

            //✿
            $texto = str_replace("\u273f", "✿", $texto);

            //⚈
            $texto = str_replace("\u2688", "⚈", $texto);

            //∆
            $texto = str_replace("\u2206", "∆", $texto);

            //∇
            $texto = str_replace("\u2207", "∇", $texto);

            //≡
            $texto = str_replace("\u2261", "≡", $texto);

            //≣
            $texto = str_replace("\u2263", "≣", $texto);

            //≪
            $texto = str_replace("\u226a", "≪", $texto);

            //≫
            $texto = str_replace("\u226b", "≫", $texto);

            //‡
            $texto = str_replace("\u2021", "‡", $texto);

            //₪
            $texto = str_replace("\u20aa", "₪", $texto);

            //۩
            $texto = str_replace("\u06e9", "۩", $texto);

            //۞
            $texto = str_replace("\u06de", "۞", $texto);

            //⌗
            $texto = str_replace("\u2317", "⌗", $texto);

            //⌘
            $texto = str_replace("\u2318", "⌘", $texto);

            //∅
            $texto = str_replace("\u2205", "∅", $texto);

            //∏
            $texto = str_replace("\u220f", "∏", $texto);

            //∑
            $texto = str_replace("\u2211", "∑", $texto);

            //√
            $texto = str_replace("\u221a", "√", $texto);

            //∞
            $texto = str_replace("\u221e", "∞", $texto);

            //〰
            $texto = str_replace("\u3030", "〰", $texto);

            //〽
            $texto = str_replace("\u303d", "〽", $texto);

            //╱
            $texto = str_replace("\u303d", "╱", $texto);

            //╲
            $texto = str_replace("\u2572", "╲", $texto);

            //╳
            $texto = str_replace("\u2573", "╳", $texto);

            //\u1735
            //\u1736

            //ᚋ
            $texto = str_replace("\u168b", "ᚋ", $texto);

            //ᚌ
            $texto = str_replace("\u168c", "ᚌ", $texto);

            //ᚍ
            $texto = str_replace("\u168d", "ᚍ", $texto);

            //ᚎ
            $texto = str_replace("\u168e", "ᚎ", $texto);

            //ᚏ
            $texto = str_replace("\u168f", "ᚏ", $texto);

            //⊏
            $texto = str_replace("\u228f", "⊏", $texto);

            //⊐
            $texto = str_replace("\u2290", "⊐", $texto);

            //⊓
            $texto = str_replace("\u2293", "⊓", $texto);

            //⊔
            $texto = str_replace("\u2294", "⊔", $texto);

            //⊕
            $texto = str_replace("\u2295", "⊕", $texto);

            //⊖
            $texto = str_replace("\u2296", "⊖", $texto);

            //⊗
            $texto = str_replace("\u2297", "⊗", $texto);

            //⊘
            $texto = str_replace("\u2298", "⊘", $texto);

            //⊙
            $texto = str_replace("\u2299", "⊙", $texto);

            //⊞
            $texto = str_replace("\u229e", "⊞", $texto);

            //⊟
            $texto = str_replace("\u229f", "⊟", $texto);

            //⊠
            $texto = str_replace("\u22a0", "⊠", $texto);

            //⊡
            $texto = str_replace("\u22a1", "⊡", $texto);

            //╭
            $texto = str_replace("\u256d", "╭", $texto);

            //╮
            $texto = str_replace("\u256e", "╮", $texto);

            //╰
            $texto = str_replace("\u2570", "╰", $texto);

            //╯
            $texto = str_replace("\u256f", "╯", $texto);

            //←
            $texto = str_replace("\u2190", "←", $texto);

            //↑
            $texto = str_replace("\u2191", "↑", $texto);

            //→
            $texto = str_replace("\u2192", "→", $texto);

            //↓
            $texto = str_replace("\u2193", "↓", $texto);

            //↔
            $texto = str_replace("\u2194", "↔", $texto);

            //↕
            $texto = str_replace("\u2195", "↕", $texto);

            //↖
            $texto = str_replace("\u2196", "↖", $texto);

            //↗
            $texto = str_replace("\u2197", "↗", $texto);

            //↘
            $texto = str_replace("\u2198", "↘", $texto);

            //↙
            $texto = str_replace("\u2199", "↙", $texto);

            //↩
            $texto = str_replace("\u21a9", "↩", $texto);

            //↪
            $texto = str_replace("\u21aa", "↪", $texto);

            //▶
            $texto = str_replace("\u25b6", "▶", $texto);

            //◀
            $texto = str_replace("\u25c0", "◀", $texto);

            //⤴
            $texto = str_replace("\u2934", "⤴", $texto);

            //⤵
            $texto = str_replace("\u2935", "⤵", $texto);

            //⇐
            $texto = str_replace("\u21d0", "⇐", $texto);

            //⇑
            $texto = str_replace("\u21d1", "⇑", $texto);

            //⇒
            $texto = str_replace("\u21d2", "⇒", $texto);

            //⇓
            $texto = str_replace("\u21d3", "⇓", $texto);

            //⇔
            $texto = str_replace("\u21d4", "⇔", $texto);

            //⇕
            $texto = str_replace("\u21d5", "⇕", $texto);

            //⇦
            $texto = str_replace("\u21e6", "⇦", $texto);

            //⇧
            $texto = str_replace("\u21e7", "⇧", $texto);

            //⇨ 
            $texto = str_replace("\u21e8", "⇨", $texto);

            //⇩
            $texto = str_replace("\u21e9", "⇩", $texto);

            //➡
            $texto = str_replace("\u27a1", "➡", $texto);

            //⬅
            $texto = str_replace("\u2b05", "⬅", $texto);

            //⬆
            $texto = str_replace("\u2b06", "⬆", $texto);

            //⬇
            $texto = str_replace("\u2b07", "⇦", $texto);

            //☚
            $texto = str_replace("\u261a", "☚", $texto);

            //☛
            $texto = str_replace("\u261b", "☛", $texto);

            //☜
            $texto = str_replace("\u261c", "☜", $texto);

            //☝
            $texto = str_replace("\u261d", "☝", $texto);

            //☞
            $texto = str_replace("\u261e", "☞", $texto);

            //☟
            $texto = str_replace("\u261f", "☟", $texto);

            //∎
            $texto = str_replace("\u220e", "∎", $texto);

            //▁
            $texto = str_replace("\u2581", "▁", $texto);

            //▂
            $texto = str_replace("\u2582", "▂", $texto);

            //▃
            $texto = str_replace("\u2583", "▃", $texto);

            //▄
            $texto = str_replace("\u2584", "▄", $texto);

            //▅
            $texto = str_replace("\u2585", "▅", $texto);

            //▆
            $texto = str_replace("\u2586", "▆", $texto);

            //▇
            $texto = str_replace("\u2587", "▇", $texto);

            //█
            $texto = str_replace("\u2588", "█", $texto);

            //▉
            $texto = str_replace("\u2589", "▉", $texto);

            //▊
            $texto = str_replace("\u258a", "▊", $texto);

            //▋
            $texto = str_replace("\u258b", "▋", $texto);

            //▌
            $texto = str_replace("\u258c", "▌", $texto);

            //▍
            $texto = str_replace("\u258d", "▍", $texto);

            //▎
            $texto = str_replace("\u258e", "▎", $texto);

            //▏
            $texto = str_replace("\u258f", "▏", $texto);

            //▐
            $texto = str_replace("\u2590", "▐", $texto);

            //░
            $texto = str_replace("\u2591", "░", $texto);

            //▒
            $texto = str_replace("\u2592", "▒", $texto);

            //▓
            $texto = str_replace("\u2593", "▓", $texto);

            //▚
            $texto = str_replace("\u259a", "▚", $texto);

            //▞
            $texto = str_replace("\u259e", "▞", $texto);

            //■
            $texto = str_replace("\u25a0", "■", $texto);

            //□
            $texto = str_replace("\u25a1", "□", $texto);

            //▢
            $texto = str_replace("\u25a2", "▢", $texto);

            //▣
            $texto = str_replace("\u25a3", "▣", $texto);

            //▤
            $texto = str_replace("\u25a4", "▤", $texto);

            //▥
            $texto = str_replace("\u25a5", "▥", $texto);

            //▦
            $texto = str_replace("\u25a6", "▦", $texto);

            //◧
            $texto = str_replace("\u25e7", "◧", $texto);

            //◨
            $texto = str_replace("\u25e8", "◨", $texto);

            //◩
            $texto = str_replace("\u25e9", "◩", $texto);

            //◪
            $texto = str_replace("\u25ea", "◪", $texto);

            //▲
            $texto = str_replace("\u25b2", "▲", $texto);

            //△
            $texto = str_replace("\u25b3", "△", $texto);

            //▶
            $texto = str_replace("\u25b6", "▶", $texto);

            //▷
            $texto = str_replace("\u25b7", "▷", $texto);

            //◆
            $texto = str_replace("\u25c6", "◆", $texto);

            //◇
            $texto = str_replace("\u25c7", "◇", $texto);

            //◊
            $texto = str_replace("\u25ca", "◊", $texto);

            //○
            $texto = str_replace("\u25cb", "○", $texto);

            //◌
            $texto = str_replace("\u25cc", "◌", $texto);

            //●
            $texto = str_replace("\u25cf", "●", $texto);

            //◐
            $texto = str_replace("\u25d0", "◐", $texto);

            //◑
            $texto = str_replace("\u25d1", "◑", $texto);

            //◒
            $texto = str_replace("\u25d2", "◒", $texto);

            //◓
            $texto = str_replace("\u25d3", "◓", $texto);

            //◔
            $texto = str_replace("\u25d4", "◔", $texto);

            //◕
            $texto = str_replace("\u25d5", "◕", $texto);

            //◢
            $texto = str_replace("\u25e2", "◢", $texto);

            //◣
            $texto = str_replace("\u25e3", "◣", $texto);

            //◤
            $texto = str_replace("\u25e4", "◤", $texto);

            //◥
            $texto = str_replace("\u25e5", "◥", $texto);

            //★
            $texto = str_replace("\u2605", "★", $texto);

            //☆
            $texto = str_replace("\u2606", "☆", $texto);

            //⭐
            $texto = str_replace("\u2b50", "⭐", $texto);

            //◻
            $texto = str_replace("\u25fb", "◻", $texto);

            //◼
            $texto = str_replace("\u25fc", "◼", $texto);

            //◽
            $texto = str_replace("\u25fd", "◽", $texto);

            //◾
            $texto = str_replace("\u25fe", "◾", $texto);

            //⚪
            $texto = str_replace("\u26aa", "⚪", $texto);

            //⚫
            $texto = str_replace("\u26ab", "⚫", $texto);

            //✳
            $texto = str_replace("\u2733", "✳", $texto);

            //✴
            $texto = str_replace("\u2734", "✴", $texto);

            //❇
            $texto = str_replace("\u2747", "❇", $texto);

            //፠
            $texto = str_replace("\u1360", "፠", $texto);

            //።
            $texto = str_replace("\u1362", "።", $texto);

            //፧
            $texto = str_replace("\u1367", "፧", $texto);

            //፨
            $texto = str_replace("\u1368", "፨", $texto);

            //⁂
            $texto = str_replace("\u2042", "⁂", $texto);

            //⁑
            $texto = str_replace("\u2051", "⁑", $texto);

            //⁎
            $texto = str_replace("\u204e", "⁎", $texto);

            //ᐁ
            $texto = str_replace("\u1401", "ᐁ", $texto);

            //ᐃ
            $texto = str_replace("\u1403", "ᐃ", $texto);

            //ᐅ
            $texto = str_replace("\u1405", "ᐅ", $texto);

            //ᐊ
            $texto = str_replace("\u140a", "ᐊ", $texto);

            //ᑌ
            $texto = str_replace("\u144c", "ᑌ", $texto);

            //ᑎ
            $texto = str_replace("\u144e", "ᑎ", $texto);

            //ᑐ
            $texto = str_replace("\u1450", "ᑐ", $texto);

            //ᑕ
            $texto = str_replace("\u1455", "ᑕ", $texto);

            //ᒣ
            $texto = str_replace("\u14a3", "ᒣ", $texto);

            //ᒥ
            $texto = str_replace("\u14a5", "ᒥ", $texto);

            //ᒧ
            $texto = str_replace("\u14a7", "ᒧ", $texto);

            //ᒪ
            $texto = str_replace("\u14aa", "ᒪ", $texto);

            //⬖
            $texto = str_replace("\u2b16", "⬖", $texto);

            //⬗
            $texto = str_replace("\u2b17", "⬗", $texto);

            //⬘
            $texto = str_replace("\u2b18", "⬘", $texto);

            //⬙
            $texto = str_replace("\u2b19", "⬙", $texto);

            //⬚
            $texto = str_replace("\u2b1a", "⬚", $texto);

            //⬛
            $texto = str_replace("\u2b1b", "⬛", $texto);

            //⬜
            $texto = str_replace("\u2b1c", "⬜", $texto);

            //⬝
            $texto = str_replace("\u2b1d", "⬝", $texto);

            //⬞
            $texto = str_replace("\u2b1e", "⬞", $texto);

            //⬟
            $texto = str_replace("\u2b1f", "⬟", $texto);

            //⬠
            $texto = str_replace("\u2b20", "⬠", $texto);

            //⬡
            $texto = str_replace("\u2b21", "⬡", $texto);

            //⬢
            $texto = str_replace("\u2b22", "⬢", $texto);

            //⬣
            $texto = str_replace("\u2b23", "⬣", $texto);

            //⬤
            $texto = str_replace("\u2b24", "⬤", $texto);

            //⬥
            $texto = str_replace("\u2b25", "⬥", $texto);

            //⬦
            $texto = str_replace("\u2b26", "⬦", $texto);

            //⬧
            $texto = str_replace("\u2b27", "⬧", $texto);

            //⬨
            $texto = str_replace("\u2b28", "⬨", $texto);

            //─
            $texto = str_replace("\u2500", "─", $texto);

            //│
            $texto = str_replace("\u2502", "│", $texto);

            //┅
            $texto = str_replace("\u2505", "┅", $texto);

            //┇
            $texto = str_replace("\u2507", "┇", $texto);

            //┌
            $texto = str_replace("\u250c", "┌", $texto);

            //┐
            $texto = str_replace("\u2510", "┐", $texto);

            //└
            $texto = str_replace("\u2514", "└", $texto);

            //┘
            $texto = str_replace("\u2518", "┘", $texto);

            //├
            $texto = str_replace("\u251c", "├", $texto);

            //┤
            $texto = str_replace("\u2524", "┤", $texto);

            //┬
            $texto = str_replace("\u252c", "┬", $texto);

            //┴
            $texto = str_replace("\u2534", "┴", $texto);

            //┼
            $texto = str_replace("\u253c", "┼", $texto);

            //═
            $texto = str_replace("\u2550", "═", $texto);

            //║
            $texto = str_replace("\u2551", "║", $texto);

            //╔
            $texto = str_replace("\u2554", "╔", $texto);

            //╗
            $texto = str_replace("\u2557", "╗", $texto);

            //╚
            $texto = str_replace("\u255a", "╚", $texto);

            //╝
            $texto = str_replace("\u255d", "╝", $texto);

            //╠
            $texto = str_replace("\u2560", "╠", $texto);

            //╣
            $texto = str_replace("\u2563", "╣", $texto);

            //╧
            $texto = str_replace("\u2567", "╧", $texto);

            //╩
            $texto = str_replace("\u2569", "╩", $texto);

            //╬
            $texto = str_replace("\u256c", "╬", $texto);

            //⓪
            $texto = str_replace("\u24ea", "⓪", $texto);

            //①
            $texto = str_replace("\u2460", "①", $texto);

            //②
            $texto = str_replace("\u2461", "②", $texto);

            //③
            $texto = str_replace("\u2462", "③", $texto);

            //④
            $texto = str_replace("\u2463", "④", $texto);

            //⑤
            $texto = str_replace("\u2464", "⑤", $texto);

            //⑥
            $texto = str_replace("\u2465", "⑥", $texto);

            //⑦
            $texto = str_replace("\u2466", "⑦", $texto);

            //⑧
            $texto = str_replace("\u2467", "⑧", $texto);

            //⑨
            $texto = str_replace("\u2468", "⑨", $texto);

            //⑩
            $texto = str_replace("\u2469", "⑩", $texto);

            //⑪
            $texto = str_replace("\u246a", "⑪", $texto);

            //⑫
            $texto = str_replace("\u246b", "⑫", $texto);

            //⑬
            $texto = str_replace("\u246c", "⑬", $texto);

            //⑭
            $texto = str_replace("\u246d", "⑭", $texto);

            //⑮
            $texto = str_replace("\u246e", "⑮", $texto);

            //⑯
            $texto = str_replace("\u246f", "⑯", $texto);

            //⑰
            $texto = str_replace("\u2470", "⑰", $texto);

            //⑱
            $texto = str_replace("\u2471", "⑱", $texto);

            //⑲
            $texto = str_replace("\u2472", "⑲", $texto);

            //⑳
            $texto = str_replace("\u2473", "⑳", $texto);

            //⓿
            $texto = str_replace("\u24ff", "⓿", $texto);

            //❶
            $texto = str_replace("\u2776", "❶", $texto);

            //❷
            $texto = str_replace("\u2777", "❷", $texto);

            //❸
            $texto = str_replace("\u2778", "❸", $texto);

            //❹
            $texto = str_replace("\u2779", "❹", $texto);

            //❺
            $texto = str_replace("\u277a", "❺", $texto);

            //❻
            $texto = str_replace("\u277b", "❻", $texto);

            //❼
            $texto = str_replace("\u277c", "❼", $texto);

            //❽
            $texto = str_replace("\u277d", "❽", $texto);

            //❾
            $texto = str_replace("\u277e", "❾", $texto);

            //❿
            $texto = str_replace("\u277f", "❿", $texto);

            //⓫
            $texto = str_replace("\u24eb", "⓫", $texto);

            //⓬
            $texto = str_replace("\u24ec", "⓬", $texto);

            //⓭
            $texto = str_replace("\u24ed", "⓭", $texto);

            //⓮
            $texto = str_replace("\u24ee", "⓮", $texto);

            //⓯
            $texto = str_replace("\u24ef", "⓯", $texto);

            //⓰
            $texto = str_replace("\u24f0", "⓰", $texto);

            //⓱
            $texto = str_replace("\u24f1", "⓱", $texto);

            //⓲
            $texto = str_replace("\u24f2", "⓲", $texto);

            //⓳
            $texto = str_replace("\u24f3", "⓳", $texto);

            //⓴
            $texto = str_replace("\u24f4", "⓴", $texto);

            //⓵
            $texto = str_replace("\u24f5", "⓵", $texto);

            //⓶
            $texto = str_replace("\u24f6", "⓶", $texto);

            //⓷
            $texto = str_replace("\u24f7", "⓷", $texto);

            //⓸
            $texto = str_replace("\u24f8", "⓸", $texto);

            //⓹
            $texto = str_replace("\u24f9", "⓹", $texto);

            //⓺
            $texto = str_replace("\u24fa", "⓺", $texto);

            //⓻
            $texto = str_replace("\u24fb", "⓻", $texto);

            //⓼
            $texto = str_replace("\u24fc", "⓼", $texto);

            //⓽
            $texto = str_replace("\u24fd", "⓽", $texto);

            //⓾
            $texto = str_replace("\u24fe", "⓾", $texto);

            //☐
            $texto = str_replace("\u2610", "☐", $texto);

            //☑
            $texto = str_replace("\u2611", "☑", $texto);

            //☒
            $texto = str_replace("\u2612", "☒", $texto);

            //⚐
            $texto = str_replace("\u2690", "⚐", $texto);

            //⚑
            $texto = str_replace("\u2691", "⚑", $texto);

            //♠
            $texto = str_replace("\u2660", "♠", $texto);

            //♣
            $texto = str_replace("\u2663", "♣", $texto);

            //♥
            $texto = str_replace("\u2665", "♥", $texto);

            //♦
            $texto = str_replace("\u2666", "♦", $texto);

            //✔
            $texto = str_replace("\u2714", "✔", $texto);

            //✖
            $texto = str_replace("\u2716", "✖", $texto);

            //❤
            $texto = str_replace("\u2764", "❤", $texto);

            //©
            $texto = str_replace("\u00a9", "©", $texto);

            //®
            $texto = str_replace("\u00ae", "®", $texto);

            //‼
            $texto = str_replace("\u203c", "‼", $texto);

            //⁉
            $texto = str_replace("\u2049", "⁉", $texto);

            //™
            $texto = str_replace("\u2122", "™", $texto);

            //Ⓜ
            $texto = str_replace("\u24c2", "Ⓜ", $texto);

            //♻
            $texto = str_replace("\u267b", "♻", $texto);

            //⚠
            $texto = str_replace("\u26a0", "⚠", $texto);

            //⚡
            $texto = str_replace("\u26a1", "⚡", $texto);

            //☠
            $texto = str_replace("\u2620", "☠", $texto);

            //☢
            $texto = str_replace("\u2622", "☢", $texto);

            //☮
            $texto = str_replace("\u262e", "☮", $texto);

            //☯
            $texto = str_replace("\u262f", "☯", $texto);

            //☺
            $texto = str_replace("\u263a", "☺", $texto);

            //☻
            $texto = str_replace("\u263b", "☻", $texto);

            //☹
            $texto = str_replace("\u2639", "☹", $texto);

            //♀
            $texto = str_replace("\u2640", "♀", $texto);

            //♂
            $texto = str_replace("\u2642", "♂", $texto);

            //♩
            $texto = str_replace("\u2669", "♩", $texto);

            //♪
            $texto = str_replace("\u266a", "♪", $texto);

            //♫
            $texto = str_replace("\u266b", "♫", $texto);

            //♬
            $texto = str_replace("\u266c", "♬", $texto);

            //⚀
            $texto = str_replace("\u2680", "⚀", $texto);

            //⚁
            $texto = str_replace("\u2681", "⚁", $texto);

            //⚂
            $texto = str_replace("\u2682", "⚂", $texto);

            //⚃
            $texto = str_replace("\u2683", "⚃", $texto);

            //⚄
            $texto = str_replace("\u2684", "⚄", $texto);

            //⚅
            $texto = str_replace("\u2685", "⚅", $texto);

            //☀
            $texto = str_replace("\u2600", "☀", $texto);

            //☁
            $texto = str_replace("\u2601", "☁", $texto);

            //☂
            $texto = str_replace("\u2602", "☂", $texto);

            //☔
            $texto = str_replace("\u2614", "☔", $texto);

            //☃
            $texto = str_replace("\u2603", "☃", $texto);

            //☼
            $texto = str_replace("\u263c", "☼", $texto);

            //☽
            $texto = str_replace("\u263d", "☽", $texto);

            //☾
            $texto = str_replace("\u263e", "☾", $texto);

            //❄
            $texto = str_replace("\u2744", "❄", $texto);

            //⌚
            $texto = str_replace("\u231a", "⌚", $texto);

            //⌛
            $texto = str_replace("\u231b", "⌛", $texto);

            //☎
            $texto = str_replace("\u260e", "☎", $texto);

            //✂
            $texto = str_replace("\u2702", "✂", $texto);

            //✉
            $texto = str_replace("\u2709", "✉", $texto);

            //✎
            $texto = str_replace("\u270e", "✎", $texto);

            //✏
            $texto = str_replace("\u270f", "✏", $texto);

            //✒
            $texto = str_replace("\u2712", "✒", $texto);

            //♿
            $texto = str_replace("\u267f", "♿", $texto);

            //⚓
            $texto = str_replace("\u2693", "⚓", $texto);

            //✈
            $texto = str_replace("\u2708", "✈", $texto);

            //✌
            $texto = str_replace("\u270c", "✌", $texto);

            //☕
            $texto = str_replace("\u2615", "☕", $texto);

            //♨
            $texto = str_replace("\u2668", "♨", $texto);

            //☺
            $texto = str_replace("\u263a", "☺", $texto);

            //♈
            $texto = str_replace("\u2648", "♈", $texto);

            //♉
            $texto = str_replace("\u2649", "♉", $texto);

            //♊
            $texto = str_replace("\u264a", "♊", $texto);

            //♋
            $texto = str_replace("\u264b", "♋", $texto);

            //♌
            $texto = str_replace("\u264c", "♌", $texto);

            //♍
            $texto = str_replace("\u264d", "♍", $texto);

            //♎
            $texto = str_replace("\u264e", "♎", $texto);

            //♏
            $texto = str_replace("\u264f", "♏", $texto);

            //♐
            $texto = str_replace("\u2650", "♐", $texto);

            //♑
            $texto = str_replace("\u2651", "♑", $texto);

            //♒
            $texto = str_replace("\u2652", "♒", $texto);

            //♓
            $texto = str_replace("\u2653", "♓", $texto);

            //RETORNO
            return $texto;
        }
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
                                    <div class="pt-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2 class=""><b>Configuración Minecraft</b></h2>
                                                    <hr>
                                                    <p class="lead">Nota: Los cambios en la configuración no se aplican hasta que se reinicia el servidor de Minecraft.</p>
                                                    <br>
                                                    <?php
                                                    $rutacarpetamine = getcwd();
                                                    $rutacarpetamine = trim($rutacarpetamine);
                                                    $rutacarpetamine .= "/config/serverproperties.txt";

                                                    clearstatcache();
                                                    if (!file_exists($rutacarpetamine)) {
                                                        echo '<div class="alert alert-danger" role="alert">Error: El archivo /config/serverproperties.txt no existe.</div>';
                                                        exit;
                                                    }

                                                    clearstatcache();
                                                    if (!is_readable($rutacarpetamine)) {
                                                        echo '<div class="alert alert-danger" role="alert">Error: El archivo /config/serverproperties.txt no tiene permisos de lectura.</div>';
                                                        exit;
                                                    }

                                                    clearstatcache();
                                                    if (!is_writable($rutacarpetamine)) {
                                                        echo '<div class="alert alert-danger" role="alert">Error: El archivo /config/serverproperties.txt no tiene permisos de escritura.</div>';
                                                        exit;
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Separacion Inicio -->
                                    <div class="pt-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2 class=""><b>Opciones Juego</b></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="pb-2 mt-2">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Modo Juego</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: Supervivencia (survival)</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Juego por defecto del servidor.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-gamemode">
                                                        <?php
                                                        $lostextos = array('Supervivencia', 'Creativo', 'Aventura', 'Espectador');
                                                        $losvalues = array('survival', 'creative', 'adventure', 'spectator');

                                                        $obtener = leerlineas('gamemode');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-gamemode">gamemode</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Forzar Modo de juego</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Fuerza a los jugadores a entrar con el modo de juego por defecto configurado.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-force-gamemode">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('force-gamemode');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-force-gamemode">force-gamemode</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Dificultad</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: Fácil (easy)</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Dificultad del modo Supervivencia.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-difficulty">
                                                        <?php
                                                        $lostextos = array('Pacifico', 'Facil', 'Normal', 'Dificil');
                                                        $losvalues = array('peaceful', 'easy', 'normal', 'hard');

                                                        $obtener = leerlineas('difficulty');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-difficulty">difficulty</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Modo Hardcore</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Si está en true, la dificultad es ignorada y fijada en difícil y los jugadores pasan a modo espectador si mueren.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-hardcore">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('hardcore');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-hardcore">hardcore</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>PVP</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Los jugadores pueden matar a otros jugadores.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-pvp">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('pvp');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-pvp">pvp</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Spawnear NPCs</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Los NPC (Aldeanos) podrán spawnear en el mapa.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-spawn-npcs">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('spawn-npcs');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-spawn-npcs">spawn-npcs</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Spawnear Animales</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Los Animales (Cerdo, Vaca, etc.) podrán spawnear en el mapa.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-spawn-animals">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('spawn-animals');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-spawn-animals">spawn-animals</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Spawnear Monstruos</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Los Monstruos (Creepers, Arañas, etc.) podrán spawnear en el mapa.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-spawn-monsters">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('spawn-monsters');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-spawn-monsters">spawn-monsters</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Activar Vuelo</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Permite volar a los usuarios.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-allow-flight">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('allow-flight');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-allow-flight">allow-flight</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Jugador AFK</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 0 (Desactivado)<br>Valor Min: 0 - Valor Max: 2147483647</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Si el jugador no se mueve en el tiempo asignado (minutos), el servidor lo expulsara.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" id="form-player-idle-timeout" value="<?php echo (leerlineas('player-idle-timeout')); ?>" min="0" max="2147483647">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-player-idle-timeout">player-idle-timeout</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Paquete de recursos</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: Vacío</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Asignar URL al paquete de recursos.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo (leerlineas('resource-pack')); ?>" id="form-resource-pack">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-resource-pack">resource-pack</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Verificar Paquete de recursos usando SHA1</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: Vacío</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Comprueba si el SHA1 corresponde con el fichero seleccionado de la URL.<br>Se utiliza el SHA1 del fichero en hexadecimal y en minúsculas.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo (leerlineas('resource-pack-sha1')); ?>" id="form-resource-pack-sha1">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-resource-pack-sha1">resource-pack-sha1</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="pt-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2 class=""><b>Opciones Mapa</b></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Nombre Mapa</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: world</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Nombre con el que se creara el mapa principal.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo (leerlineas('level-name')); ?>" id="form-level-name" maxlength="255">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-level-name">level-name</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Semilla del mapa</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: aleatorio</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Semilla para generación de mapas.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo (leerlineas('level-seed')); ?>" id="form-level-seed">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-level-seed">level-seed</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Tipo Mapa</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: default</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Determina el tipo de mapa que se generara.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-level-type">
                                                        <?php
                                                        $lostextos = array('Standard', 'Plano', 'Biomas Largos', 'Amplificado', 'Un bioma (Requiere 1.15 o superior)');
                                                        $losvalues = array('default', 'flat', 'largeBiomes', 'amplified', 'buffet');

                                                        $obtener = leerlineas('level-type');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-level-type">level-type</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Configuración Generación Mapa</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: Vacío</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Configuración utilizada para personalizar la generación del mapa.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo (leerlineas('generator-settings')); ?>" id="form-generator-settings">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-generator-settings">generator-settings</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Altura Máxima Construir</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 256<br>Valor Min: 8 Valor Max: 256</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Determina la altura máxima que se podrá construir.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('max-build-height')); ?>" id="form-max-build-height" min="8" max="256">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-max-build-height">max-build-height</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Generar Estructuras</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Se generarán estructuras (Aldeas, edificios, etc.) por el mapa.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-generate-structures">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('generate-structures');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-generate-structures">generate-structures</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Habilitar Nether</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Activar el Nether y sus portales.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-allow-nether">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('allow-nether');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-allow-nether">allow-nether</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Distancia para renderizar entidades</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 100<br>Valor Min: 0 - Valor Max: 500</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Ajustar la distancia de renderizado de entidades, si es muy lejano puede causar lag.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('entity-broadcast-range-percentage')); ?>" id="form-entity-broadcast-range-percentage" min="0" max="500">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-entity-broadcast-range-percentage">entity-broadcast-range-percentage</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Protección Spawn</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 16<br>Valor Min: 0 - Valor Max: 16</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Asignas el radio de protección al punto spawn del mapa.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('spawn-protection')); ?>" id="form-spawn-protection" min="0" max="16">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-spawn-protection">spawn-protection</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Tamaño Máximo Mundo (en bloques)</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 29999984<br>Valor Min: 1 - Valor Max: 29999984</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Asignas el tamaño máximo del mundo, no se podrá caminar al llegar al límite</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('max-world-size')); ?>" id="form-max-world-size" min="1" max="29999984">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-max-world-size">max-world-size</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="pt-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2 class=""><b>Opciones Servidor</b></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Modo Online (PREMIUM)</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Activar o Desactivar el modo Legal (True) o Pirata (False).</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-online-mode">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('online-mode');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-online-mode">online-mode</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Máximo Jugadores</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 20<br>Valor Min: 1 - Valor Max: 2147483647</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Asignas el máximo de jugadores que podrán entrar al servidor.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('max-players')); ?>" id="form-max-players" min="1" max="2147483647">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-max-players">max-players</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Activar bloque de comandos</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Activa el bloque de comandos en el servidor.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-enable-command-block">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('enable-command-block');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-enable-command-block">enable-command-block</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Activar Solicitudes Query</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Responde a las solicitudes Query de Servidores y Programas.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-enable-query">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('enable-query');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-enable-query">enable-query</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Puerto Query</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 25565<br>Valor Min: 1025 - Valor Max: 65535</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Establece el puerto para Query.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('query.port')); ?>" id="form-query-port" min="1025" max="65535">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-query-port">query.port</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Activar RCON</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Activa protocolo RCON.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-enable-rcon">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('enable-rcon');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-enable-rcon">enable-rcon</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Puerto RCON</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 25575<br>Valor Min: 1025 - Valor Max: 65535</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Establece el puerto de red RCON.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('rcon.port')); ?>" id="form-rconport" min="1025" max="65535">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-rconport">rcon.port</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Password RCON</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: Vacío</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Fijar el password que usaras al conectarte con RCON.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo (leerlineas('rcon.password')); ?>" id="form-rcon-password">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-rcon-password">rcon.password</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Activar Lista Blanca</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">La lista blanca solo permitirá entrar a los usuarios que estén en ella cuando esté activada.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-white-list">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('white-list');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-white-list">white-list</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Forzar Lista Blanca</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Cuando está en true, los usuarios que no están añadidos en la lista blanca (si está esta habilitada) son expulsados ​​del servidor después de que el servidor vuelve a cargar el archivo de la lista blanca.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-enforce-whitelist">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('enforce-whitelist');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-enforce-whitelist">enforce-whitelist</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Ip del Server</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: Vacío</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Fijar el servidor obligatoriamente a una IP, se recomienda dejarla en blanco.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo (leerlineas('server-ip')); ?>" id="form-server-ip">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-server-ip">server-ip</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Activar Estado</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Hace aparecer el servidor 'online' en la lista de servidores.<br>Si está en falso, suprimirá las respuestas de los clientes. Esto significa que aparecerá como fuera de línea, pero seguirá aceptando conexiones.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-enable-status">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('enable-status');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-enable-status">enable-status</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>broadcast-console-to-ops</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Envía los resultados de los comandos de consola a todos los operadores.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-broadcast-console-to-ops">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('broadcast-console-to-ops');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-broadcast-console-to-ops">broadcast-console-to-ops</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>broadcast-rcon-to-ops</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Envía los resultados de los comandos de consola mediante rcon a todos los operadores.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-broadcast-rcon-to-ops">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('broadcast-rcon-to-ops');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-broadcast-rcon-to-ops">broadcast-rcon-to-ops</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Usar Transporte Nativo</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Mejoras en el rendimiento Linux: envío y recepción de paquetes optimizados.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-use-native-transport">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('use-native-transport');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-use-native-transport">use-native-transport</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Prevenir Conexiones Proxy</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Si el ISP/AS enviado desde el servidor es diferente al del Servidor Autentificación de Mojang, el jugador es kickeado.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-prevent-proxy-connections">
                                                        <?php
                                                        $lostextos = array('False', 'True');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('prevent-proxy-connections');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-prevent-proxy-connections">prevent-proxy-connections</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Activar Monitoreo JMX</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: false</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Monitorear los tiempos de tick del servidor(averageTickTime y tickTimes).</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-enable-jmx-monitoring">
                                                        <?php
                                                        $lostextos = array('False', 'True (Requiere 1.16 o superior)');
                                                        $losvalues = array('false', 'true');

                                                        $obtener = leerlineas('enable-jmx-monitoring');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-enable-jmx-monitoring">enable-jmx-monitoring</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Estadísticas Mojang</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: True</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Envía estadísticas del Servidor a Mojang.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-snooper-enabled">
                                                        <?php
                                                        $lostextos = array('True', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('snooper-enabled');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-snooper-enabled">snooper-enabled</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Activar Modo Guardado Syncronizado Chunks</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: true</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Modo Sincronizado previene la perdida de datos y corrupción después de un crasheo.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control w-100" id="form-sync-chunk-writes">
                                                        <?php
                                                        $lostextos = array('True (Requiere 1.16 o superior)', 'False');
                                                        $losvalues = array('true', 'false');

                                                        $obtener = leerlineas('sync-chunk-writes');

                                                        for ($i = 0; $i < count($lostextos); $i++) {

                                                            if ($obtener == $losvalues[$i]) {
                                                                echo '<option selected value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $losvalues[$i] . '">' . $lostextos[$i] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-sync-chunk-writes">sync-chunk-writes</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Tiempo Máximo Respuesta</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 60000<br>Valor Min: 1000 - Valor Max: 60000</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Los segundos que tardara en cerrar el servidor si no responde en X segundos.<br> (60000 = 60 segundos).</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('max-tick-time')); ?>" id="form-max-tick-time" min="1000" max="60000">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-max-tick-time">max-tick-time</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>op-permission-level</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 4<br>Valor Min: 1 - Valor Max: 4</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Asigna el permiso por defecto para operadores.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('op-permission-level')); ?>" id="form-op-permission-level" min="1" max="4">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-op-permission-level">op-permission-level</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>function-permission-level</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 2<br>Valor Min: 1 - Valor Max: 4</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Asigna el permiso por defecto para funciones.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('function-permission-level')); ?>" id="form-function-permission-level" min="1" max="4">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-function-permission-level">function-permission-level</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Limite de Paquetes</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 0 (Sin limité)<br>Requiere Versión: 1.16.2 o superior</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Permite kikear jugadores que constantemente están enviando demasiados paquetes en cuestión de segundos.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('rate-limit')); ?>" id="form-rate-limit" min="0">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-rate-limit">rate-limit</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Compresión de red</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 256<br>Valor Min: 64 - Valor Max: 256</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Permite comprimir los paquetes de red del servidor.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('network-compression-threshold')); ?>" id="form-network-compression-threshold" min="64" max="256">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-network-compression-threshold">network-compression-threshold</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Distancia Visionado</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: 10<br>Valor Min: 3 - Valor Max: 32</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Aumentará la distancia de visionado cargando más chunks desde la posición donde mira el jugador.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" value="<?php echo (leerlineas('view-distance')); ?>" id="form-view-distance" min="3" max="32">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-view-distance">view-distance</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->
                                    <hr>
                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>MOTD</b></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="">Valor Defecto: A Minecraft Server</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="lead">Mensaje que se muestra en la lista de servidores del cliente.</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="<?php echo (leerlineas('motd')); ?>" id="form-motd">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="lead text-center text-white mt-2 bg-primary" id="label-motd">motd</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Separacion Fin -->

                                    <!-- Separacion Inicio -->
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class=""><b>Visor MOTD</b></h3>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ml-2 ">
                                                    <div class="row minirow">
                                                        <div class="bg-dark iconservlist"></div>
                                                        <div class="imgservlist"><br><span id="visormotd"><?php echo leermotd(leerlineas('motd')); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Separacion Fin -->

                                </div>

                            </div>
                        </div>
                        <br>
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

        <script src="js/minecraft.js"></script>

    <?php
        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>
</body>

</html>