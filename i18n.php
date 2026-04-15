<?php
function validarIdioma($idioma) {
    $idiomasValidos = ['en', 'es', 'fr', 'de', 'ru', 'pt', 'it', 'pl', 'el', 'ar'];
    return in_array($idioma, $idiomasValidos) ? $idioma : 'es';
}

function obtenerTraducciones() {
    $traducciones = array();
    if (($archivo = fopen("translations.csv", "r")) !== false) {
        $cabecera = fgetcsv($archivo, 1000, ",");
        while (($linea = fgetcsv($archivo, 1000, ",")) !== false) {
            if (!isset($linea[0])) {
                continue;
            }
            $traducciones[$linea[0]] = array(
                'en' => $linea[1],
                'es' => $linea[2],
                'fr' => $linea[3],
                'de' => $linea[4],
                'ru' => $linea[5],
                'pt' => $linea[6],
                'it' => $linea[7],
                'pl' => $linea[8],
                'el' => $linea[9],
                'ar' => $linea[10]
            );
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
    if (isset($GLOBALS['conjuntoTraducciones'][$clave][$GLOBALS['idiomaActivo']])) {
        return $GLOBALS['conjuntoTraducciones'][$clave][$GLOBALS['idiomaActivo']];
    }
    return isset($GLOBALS['conjuntoTraducciones'][$clave]['en']) ? $GLOBALS['conjuntoTraducciones'][$clave]['en'] : $clave;
}
?>