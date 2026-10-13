<?php
/**
 * Pie de página.
 */

$contenido = require get_template_directory() . '/inc/contenido-inicio.php';
?>

<footer class="pie">
	<div class="pie-contenido">

		<?php if ( ! empty( $contenido['notas'] ) ) : ?>
			<ol class="pie-notas">
				<?php foreach ( $contenido['notas'] as $nota ) : ?>
					<li><?php echo esc_html( $nota ); ?></li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>

		<div class="pie-columnas">
			<?php foreach ( $contenido['pie_columnas'] as $columna ) : ?>
				<div class="pie-columna">
					<?php foreach ( $columna as $grupo ) : ?>
						<details class="pie-grupo" open>
							<summary><?php echo esc_html( $grupo['titulo'] ); ?></summary>
							<ul>
								<?php foreach ( $grupo['enlaces'] as $enlace ) : ?>
									<li><a href="#"><?php echo esc_html( $enlace ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</details>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<p class="pie-ayuda"><?php echo esc_html( $contenido['pie_ayuda'] ); ?></p>

		<div class="pie-final">
			<p class="pie-derechos"><?php echo esc_html( $contenido['pie_derechos'] ); ?></p>
			<ul class="pie-legales">
				<?php foreach ( $contenido['pie_legales'] as $legal ) : ?>
					<li><a href="#"><?php echo esc_html( $legal ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<p class="pie-pais"><a href="#"><?php echo esc_html( $contenido['pie_pais'] ); ?></a></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
