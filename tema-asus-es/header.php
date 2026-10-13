<?php
/**
 * Cabecera: barra con menú, logo y búsqueda; menú lateral; franja de aviso.
 */

$contenido = require get_template_directory() . '/inc/contenido-inicio.php';
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="cabecera">
	<button class="cabecera-boton" id="abrir-menu" aria-expanded="false" aria-controls="menu-lateral" aria-label="<?php esc_attr_e( 'Abrir menú', 'asus-es' ); ?>">
		<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
	</button>

	<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if ( has_custom_logo() ) : ?>
			<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
		<?php else : ?>
			<!-- Logo de muestra: cámbialo en Apariencia > Personalizar > Identidad del sitio -->
			<span class="logo-texto">MI LOGO</span>
		<?php endif; ?>
	</a>

	<a href="#" class="cabecera-boton" aria-label="<?php esc_attr_e( 'Buscar', 'asus-es' ); ?>">
		<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><circle cx="11" cy="11" r="6.5" fill="none" stroke="currentColor" stroke-width="1.4"/><line x1="16" y1="16" x2="20.5" y2="20.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
	</a>
</header>

<!-- Menú lateral -->
<div class="velo" id="velo" hidden></div>
<aside class="menu-lateral" id="menu-lateral" aria-hidden="true">
	<button class="cerrar-menu" id="cerrar-menu" aria-label="<?php esc_attr_e( 'Cerrar menú', 'asus-es' ); ?>">
		<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M5 5l14 14M19 5L5 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
	</button>

	<?php foreach ( $contenido['menu_lateral'] as $g => $grupo ) : ?>
		<?php if ( 0 === $g && has_nav_menu( 'principal' ) ) : ?>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'principal',
				'container'      => false,
				'menu_class'     => 'menu-grupo menu-wp',
				'depth'          => 2,
			) );
			?>
			<?php continue; ?>
		<?php endif; ?>
		<ul class="menu-grupo">
			<?php foreach ( $grupo as $item ) : ?>
				<li class="menu-item<?php echo ! empty( $item['sub'] ) ? ' con-sub' : ''; ?>">
					<?php if ( ! empty( $item['sub'] ) ) : ?>
						<button class="menu-enlace" aria-expanded="false">
							<?php if ( ! empty( $item['icono'] ) ) : ?>
								<svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><circle cx="12" cy="8" r="3.6" fill="none" stroke="currentColor" stroke-width="1.4"/><path d="M5 20c1.2-3.6 3.8-5.4 7-5.4s5.8 1.8 7 5.4" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
							<?php endif; ?>
							<span><?php echo esc_html( $item['texto'] ); ?></span>
							<span class="signo" aria-hidden="true"></span>
						</button>
						<ul class="submenu" hidden>
							<?php foreach ( $item['sub'] as $sub ) : ?>
								<li><a href="#"><?php echo esc_html( $sub ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php else : ?>
						<a class="menu-enlace" href="<?php echo esc_url( $item['url'] ); ?>">
							<span><?php echo esc_html( $item['texto'] ); ?><?php if ( ! empty( $item['destacado'] ) ) : ?><sup class="chispa">&#10022;</sup><?php endif; ?></span>
							<span class="flechita" aria-hidden="true">&rsaquo;</span>
						</a>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endforeach; ?>
</aside>

<?php if ( ! empty( $contenido['aviso']['texto'] ) ) : ?>
	<div class="aviso">
		<?php echo esc_html( $contenido['aviso']['texto'] ); ?>
		<?php if ( ! empty( $contenido['aviso']['enlace'] ) ) : ?>
			<a href="<?php echo esc_url( $contenido['aviso']['enlace']['url'] ); ?>"><?php echo esc_html( $contenido['aviso']['enlace']['texto'] ); ?> &rsaquo;</a>
		<?php endif; ?>
	</div>
<?php endif; ?>
