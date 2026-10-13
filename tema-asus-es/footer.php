<?php
/**
 * Pie de página.
 */

$contenido = require get_template_directory() . '/inc/contenido-inicio.php';
?>

<footer class="pie">
	<div class="pie-contenido">

		<div class="pie-columnas">
			<?php foreach ( $contenido['pie_columnas'] as $bloque ) : ?>
				<details class="pie-bloque ancho-<?php echo count( $bloque['columnas'] ); ?>" open>
					<summary><?php echo esc_html( $bloque['titulo'] ); ?></summary>
					<div class="pie-sublistas">
						<?php foreach ( $bloque['columnas'] as $lista ) : ?>
							<ul>
								<?php foreach ( $lista as $enlace ) : ?>
									<li><a href="#"<?php echo ! empty( $enlace['negrita'] ) ? ' class="negrita"' : ''; ?>><?php echo esc_html( $enlace['texto'] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						<?php endforeach; ?>
					</div>
				</details>
			<?php endforeach; ?>
		</div>

		<div class="boletin">
			<p class="boletin-titulo"><?php echo esc_html( $contenido['boletin']['titulo'] ); ?></p>
			<form class="boletin-form" action="#" method="post" onsubmit="return false;">
				<input type="email" placeholder="<?php echo esc_attr( $contenido['boletin']['placeholder'] ); ?>" aria-label="<?php echo esc_attr( $contenido['boletin']['placeholder'] ); ?>">
				<button type="submit"><?php echo esc_html( $contenido['boletin']['boton'] ); ?></button>
			</form>
		</div>

		<div class="pie-final">
			<span class="pie-derechos"><?php echo esc_html( $contenido['pie_derechos'] ); ?></span>
			<ul class="pie-legales">
				<?php foreach ( $contenido['pie_legales'] as $legal ) : ?>
					<li><a href="#"><?php echo esc_html( $legal ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<a class="pie-pais" href="#">
				<svg viewBox="0 0 24 24" width="17" height="17" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.4"/><path d="M3 12h18M12 3c3 3 3 15 0 18M12 3c-3 3-3 15 0 18" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>
				<?php echo esc_html( $contenido['pie_pais'] ); ?>
			</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
