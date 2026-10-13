<?php
/**
 * Página de inicio.
 * El texto se edita en inc/contenido-inicio.php
 */

$contenido = require get_template_directory() . '/inc/contenido-inicio.php';

get_header();
?>

<main id="contenido" class="inicio">

	<!-- Carrusel principal -->
	<section class="carrusel" id="carrusel" aria-roledescription="carrusel">
		<?php foreach ( $contenido['carrusel'] as $i => $slide ) : ?>
			<div class="diapositiva tema-<?php echo esc_attr( $slide['tema'] ); ?> muestra-slide-<?php echo (int) $i % 6; ?><?php echo 0 === $i ? ' activa' : ''; ?>"<?php echo asus_es_fondo( $slide['imagen'] ); ?>>
				<div class="diapositiva-texto">
					<h2><?php echo esc_html( $slide['titulo'] ); ?></h2>
					<p><?php echo esc_html( $slide['subtitulo'] ); ?></p>
					<a class="ver-mas" href="<?php echo esc_url( $slide['enlace']['url'] ); ?>"><?php echo esc_html( $slide['enlace']['texto'] ); ?> <span aria-hidden="true">&rsaquo;</span></a>
				</div>
			</div>
		<?php endforeach; ?>

		<div class="controles">
			<?php foreach ( $contenido['carrusel'] as $i => $slide ) : ?>
				<button class="punto<?php echo 0 === $i ? ' activo' : ''; ?>" data-indice="<?php echo (int) $i; ?>" aria-label="<?php echo esc_attr( $slide['titulo'] ); ?>"><span class="progreso"></span></button>
			<?php endforeach; ?>
			<button class="pausa" id="pausa" aria-label="<?php esc_attr_e( 'Pausar', 'asus-es' ); ?>">
				<svg class="icono-pausa" viewBox="0 0 12 12" width="12" height="12" aria-hidden="true"><rect x="2.5" y="2" width="2" height="8" fill="currentColor"/><rect x="7.5" y="2" width="2" height="8" fill="currentColor"/></svg>
				<svg class="icono-play" viewBox="0 0 12 12" width="12" height="12" aria-hidden="true"><path d="M3 2l7 4-7 4z" fill="currentColor"/></svg>
			</button>
		</div>
	</section>

	<!-- Cuadros -->
	<section class="cuadros">
		<?php foreach ( $contenido['cuadros'] as $cuadro ) : ?>
			<div class="cuadro tema-<?php echo esc_attr( $cuadro['tema'] ); ?> muestra-<?php echo esc_attr( $cuadro['muestra'] ); ?>"<?php echo asus_es_fondo( $cuadro['imagen'] ); ?>>
				<div class="cuadro-arriba">
					<h3><?php echo esc_html( $cuadro['titulo'] ); ?></h3>
					<?php if ( ! empty( $cuadro['subtitulo'] ) ) : ?>
						<p><?php echo esc_html( $cuadro['subtitulo'] ); ?></p>
					<?php endif; ?>
				</div>
				<div class="cuadro-abajo">
					<?php if ( ! empty( $cuadro['texto'] ) ) : ?>
						<p class="cuadro-texto"><?php echo esc_html( $cuadro['texto'] ); ?></p>
					<?php endif; ?>
					<a class="ver-mas" href="<?php echo esc_url( $cuadro['enlace']['url'] ); ?>"><?php echo esc_html( $cuadro['enlace']['texto'] ); ?> <span aria-hidden="true">&rsaquo;</span></a>
				</div>
			</div>
		<?php endforeach; ?>
	</section>

</main>

<?php
get_footer();
