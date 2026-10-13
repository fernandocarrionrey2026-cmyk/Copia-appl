<?php
/**
 * Página de inicio.
 *
 * Si en Settings > Reading la portada es una página (por ejemplo "Inicio")
 * y esa página tiene bloques, se muestra esa página: se edita con clics
 * en Pages > Inicio.
 * Si no, se muestra el diseño con los textos de inc/contenido-inicio.php.
 */

if ( is_page() && has_blocks( get_queried_object_id() ) ) {
	get_template_part( 'page' );
	return;
}

$contenido = asus_es_contenido();

get_header();
?>

<main id="contenido" class="inicio">
	<?php
	echo asus_es_html_carrusel( $contenido['carrusel'], 6, 'class="carrusel"' ); // phpcs:ignore -- HTML generado y escapado por el tema
	echo asus_es_html_cuadros( $contenido['cuadros'], 'class="cuadros"' ); // phpcs:ignore -- HTML generado y escapado por el tema
	?>
</main>

<?php
get_footer();
