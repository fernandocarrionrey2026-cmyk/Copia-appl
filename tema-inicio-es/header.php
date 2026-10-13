<?php
/**
 * Cabecera: barra de navegación superior.
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="barra-nav" id="barra-nav">
	<nav class="nav-contenido" aria-label="<?php esc_attr_e( 'Navegación principal', 'inicio-es' ); ?>">

		<a class="nav-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Inicio', 'inicio-es' ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
			<?php else : ?>
				<!-- Logo de muestra: cámbialo en Apariencia > Personalizar > Identidad del sitio -->
				<svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><circle cx="10" cy="10" r="8" fill="currentColor"/></svg>
			<?php endif; ?>
		</a>

		<div class="nav-menu" id="nav-menu">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'principal',
				'container'      => false,
				'menu_class'     => 'nav-lista',
				'fallback_cb'    => 'inicio_es_menu_respaldo',
				'depth'          => 1,
			) );
			?>
		</div>

		<div class="nav-iconos">
			<a href="#" class="nav-icono" aria-label="<?php esc_attr_e( 'Buscar', 'inicio-es' ); ?>">
				<svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5" fill="none" stroke="currentColor" stroke-width="1.6"/><line x1="15.5" y1="15.5" x2="21" y2="21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
			</a>
			<a href="#" class="nav-icono" aria-label="<?php esc_attr_e( 'Bolsa de compras', 'inicio-es' ); ?>">
				<svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><path d="M5 8h14l-1 13H6L5 8z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M9 8V6a3 3 0 0 1 6 0v2" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
			</a>
			<button class="nav-hamburguesa" id="nav-hamburguesa" aria-expanded="false" aria-controls="nav-menu" aria-label="<?php esc_attr_e( 'Abrir menú', 'inicio-es' ); ?>">
				<span></span><span></span>
			</button>
		</div>
	</nav>
</header>
