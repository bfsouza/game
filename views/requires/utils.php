<?php
/**
 * Redirecionar para URL
 * @param type $url
 */
function redirect($url) {
    header("location: ".$url);
    exit;
}

/**
 * Converter string para data/hora
 * @param type $str
 * @return type
 */
function convert_dmY_Hi($str) {
    return date("d/m/Y H:i", strtotime($str));
}

/**
 * Converter string para data
 * @param type $str
 * @return type
 */
function convert_dmY($str) {
    return date("d/m/Y", strtotime($str));
}

/**
 * Converter string para hora/minuto
 * @param type $str
 * @return type
 */
function convert_Hi($str) {
    return date("H:i", strtotime($str));
}