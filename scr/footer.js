// Metodos usados para cambiar el idioma de la pagina, guardando la preferencia en cookie y recargando la pagina
function cambiarIdioma(idioma) {
    document.cookie = 'language=' + encodeURIComponent(idioma) + ';path=/';
    const url = new URL(window.location.href);
    url.searchParams.delete('lang');
    window.location.href = url.toString();
}

document.getElementById('en').addEventListener('click', function() {
    cambiarIdioma('en');
});
document.getElementById('es').addEventListener('click', function() {
    cambiarIdioma('es');
});
document.getElementById('fr').addEventListener('click', function() {
    cambiarIdioma('fr');
});
document.getElementById('de').addEventListener('click', function() {
    cambiarIdioma('de');
});
document.getElementById('it').addEventListener('click', function() {
    cambiarIdioma('it');
});
document.getElementById('pt').addEventListener('click', function() {
    cambiarIdioma('pt');
});
document.getElementById('ru').addEventListener('click', function() {
    cambiarIdioma('ru');
});
document.getElementById('pl').addEventListener('click', function() {
    cambiarIdioma('pl');
});
document.getElementById('el').addEventListener('click', function() {
    cambiarIdioma('el');
});
document.getElementById('ar').addEventListener('click', function() {
    cambiarIdioma('ar');
});