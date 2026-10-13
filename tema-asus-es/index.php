<?php
/**
 * Plantilla general (entradas, páginas y archivos).
 * La página de inicio usa front-page.php.
 */

get_header();
?>

<main id="contenido" class="contenido-general">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No hay contenido para mostrar.', 'asus-es' ); ?></p>
	<?php endif; ?>
</main>

<?php
get_footer();
