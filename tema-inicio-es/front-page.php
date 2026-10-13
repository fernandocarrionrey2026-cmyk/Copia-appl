<?php
/**
 * Página de inicio.
 * El texto se edita en inc/contenido-inicio.php
 */

$contenido = require get_template_directory() . '/inc/contenido-inicio.php';

get_header();
?>

<main id="contenido" class="inicio">

	<?php if ( ! empty( $contenido['aviso']['texto'] ) ) : ?>
		<div class="aviso">
			<p>
				<?php echo esc_html( $contenido['aviso']['texto'] ); ?>
				<?php if ( ! empty( $contenido['aviso']['enlace'] ) ) : ?>
					<a href="<?php echo esc_url( $contenido['aviso']['enlace']['url'] ); ?>"><?php echo esc_html( $contenido['aviso']['enlace']['texto'] ); ?> &rsaquo;</a>
				<?php endif; ?>
			</p>
		</div>
	<?php endif; ?>

	<?php foreach ( $contenido['destacados'] as $i => $seccion ) :
		$imagen = inicio_es_imagen( $seccion['imagen'] );
		?>
		<section class="destacado tema-<?php echo esc_attr( $seccion['tema'] ); ?> muestra-<?php echo (int) $i % 3; ?>"
			<?php if ( $imagen ) : ?>style="background-image:url('<?php echo esc_url( $imagen ); ?>')"<?php endif; ?>>
			<div class="destacado-texto">
				<h2 class="titulo"><?php echo esc_html( $seccion['titulo'] ); ?></h2>
				<p class="subtitulo"><?php echo esc_html( $seccion['subtitulo'] ); ?></p>
				<?php inicio_es_botones( $seccion['botones'] ); ?>
			</div>
		</section>
	<?php endforeach; ?>

	<div class="mosaicos">
		<?php foreach ( $contenido['mosaicos'] as $i => $mosaico ) :
			$imagen = inicio_es_imagen( $mosaico['imagen'] );
			?>
			<section class="mosaico tema-<?php echo esc_attr( $mosaico['tema'] ); ?> muestra-<?php echo (int) $i % 6; ?>"
				<?php if ( $imagen ) : ?>style="background-image:url('<?php echo esc_url( $imagen ); ?>')"<?php endif; ?>>
				<div class="mosaico-texto">
					<h2 class="titulo"><?php echo esc_html( $mosaico['titulo'] ); ?></h2>
					<p class="subtitulo"><?php echo esc_html( $mosaico['subtitulo'] ); ?></p>
					<?php inicio_es_botones( $mosaico['botones'] ); ?>
				</div>
			</section>
		<?php endforeach; ?>
	</div>

</main>

<?php
get_footer();
