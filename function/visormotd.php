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

require_once("../template/session.php");
require_once("../template/errorreport.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
    $_SESSION['VALIDADO'] = "NO";
    $_SESSION['KEYSECRETA'] = "0";
}

//VALIDAMOS SESSION
if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {

    //VALIDAMOS SESSION
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['action']) && !empty($_POST['action'])) {

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

            $elerror = 0;
            $retorno = "";

            $elmotd = $_POST['action'];

            $retorno = leermotd($elmotd);

            echo $retorno;
        }
    }
}
