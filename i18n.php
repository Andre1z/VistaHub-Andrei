<?php
function obtenerTraducciones($idioma = 'es') {
    $traducciones = array();
    // Se intenta abrir el archivo CSV con las traducciones.
    if (($archivo = fopen("translations.csv", "r")) !== false) {
        // Se lee la primera línea para descartar los encabezados
        $cabecera = fgetcsv($archivo, 1000, ",");
        // Se procesan cada línea del archivo
        while (($linea = fgetcsv($archivo, 1000, ",")) !== false) {
            $clave = $linea[0];
            $traducciones[$clave] = array(
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

// Determina el idioma activo a partir de la sesión; si no está definido, se usa español ('es').
if (isset($_SESSION['language'])) {
    $idiomaActivo = $_SESSION['language'];
} else {
    $idiomaActivo = 'es';
}
$GLOBALS['idiomaActivo'] = $idiomaActivo;
$GLOBALS['conjuntoTraducciones'] = obtenerTraducciones($idiomaActivo);

function __($clave) {
    if (isset($GLOBALS['conjuntoTraducciones'][$clave][$GLOBALS['idiomaActivo']])) {
        return $GLOBALS['conjuntoTraducciones'][$clave][$GLOBALS['idiomaActivo']];
    }
    return isset($GLOBALS['conjuntoTraducciones'][$clave]['en']) ? $GLOBALS['conjuntoTraducciones'][$clave]['en'] : $clave;
}
?>