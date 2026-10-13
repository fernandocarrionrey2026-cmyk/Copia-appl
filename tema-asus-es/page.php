<?php
/**
 * Páginas (Pages).
 *
 * Si la página empieza con un bloque ASUS (Carrusel o Cuadros), se muestra
 * a todo el ancho y sin el título arriba, como la página de inicio.
 * Si no, se muestra el título y el contenido centrado.
 */

get_header();

while ( have_posts() ) :
	the_post();

	$primer_bloque = '';
	foreach ( parse_blocks( get_post_field( 'post_content', get_the_ID() ) ) as $bloque ) {
		if ( ! empty( $bloque['blockName'] ) ) {
			$primer_bloque = $bloque['blockName'];
			break;
		}
	}
	$diseno_asus = 0 === strpos( $primer_bloque, 'asus-es/' );
	?>

	<main id="contenido" class="pagina<?php echo $diseno_asus ? ' pagina-asus' : ''; ?>">
		<?php if ( ! $diseno_asus ) : ?>
			<h1 class="pagina-titulo"><?php the_title(); ?></h1>
		<?php endif; ?>
		<div class="pagina-contenido">
			<?php the_content(); ?>
		</div>
	</main>

	<?php
endwhile;

get_footer();
