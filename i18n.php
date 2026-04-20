<?php
function validarIdioma($idioma) {
    $idiomasValidos = ['en', 'es', 'fr', 'de', 'ru', 'pt', 'it', 'pl', 'el', 'ar'];
    return in_array($idioma, $idiomasValidos) ? $idioma : 'es';
}

function obtenerTraducciones() {
    $idiomas = ['en', 'es', 'fr', 'de', 'ru', 'pt', 'it', 'pl', 'el', 'ar'];
    $traducciones = array();
    if (($archivo = fopen("translations.csv", "r")) !== false) {
        fgetcsv($archivo, 1000, ",");
        while (($linea = fgetcsv($archivo, 1000, ",")) !== false) {
            if (!isset($linea[0]) || trim($linea[0]) === '') {
                continue;
            }
            $clave = trim($linea[0]);
            $filaTraducciones = array();
            foreach ($idiomas as $index => $idioma) {
                $filaTraducciones[$idioma] = isset($linea[$index + 1]) ? trim($linea[$index + 1]) : '';
            }
            $traducciones[$clave] = $filaTraducciones;
        }
        fclose($archivo);
    }
    return $traducciones;
}

$idiomaActivo = 'es';
if (isset($_COOKIE['language'])) {
    $idiomaActivo = validarIdioma($_COOKIE['language']);
}

$GLOBALS['idiomaActivo'] = $idiomaActivo;
$GLOBALS['conjuntoTraducciones'] = obtenerTraducciones();

function __($clave) {
    if (isset($GLOBALS['conjuntoTraducciones'][$clave][$GLOBALS['idiomaActivo']]) && $GLOBALS['conjuntoTraducciones'][$clave][$GLOBALS['idiomaActivo']] !== '') {
        return $GLOBALS['conjuntoTraducciones'][$clave][$GLOBALS['idiomaActivo']];
    }
    if (isset($GLOBALS['conjuntoTraducciones'][$clave]['en']) && $GLOBALS['conjuntoTraducciones'][$clave]['en'] !== '') {
        return $GLOBALS['conjuntoTraducciones'][$clave]['en'];
    }
    return $clave;
}
?>