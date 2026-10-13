<?php
/**
 * Funciones del tema "Inicio Estilo Apple (ES)".
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configuración básica del tema.
 */
function inicio_es_configuracion() {
	load_theme_textdomain( 'inicio-es', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 44,
		'width'       => 44,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'principal' => __( 'Menú principal (barra superior)', 'inicio-es' ),
	) );
}
add_action( 'after_setup_theme', 'inicio_es_configuracion' );

/**
 * Carga de estilos y scripts.
 */
function inicio_es_recursos() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'inicio-es-base', get_stylesheet_uri(), array(), $version );
	wp_enqueue_style( 'inicio-es', get_template_directory_uri() . '/assets/css/inicio.css', array(), $version );
	wp_enqueue_script( 'inicio-es-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'inicio_es_recursos' );

/**
 * Menú de respaldo: se muestra mientras no se haya creado un menú
 * en Apariencia > Menús.
 */
function inicio_es_menu_respaldo() {
	$enlaces = array( 'Tienda', 'Mac', 'iPad', 'iPhone', 'Watch', 'Vision', 'AirPods', 'TV y Casa', 'Entretenimiento', 'Accesorios', 'Soporte' );

	echo '<ul class="nav-lista">';
	foreach ( $enlaces as $texto ) {
		echo '<li><a href="#">' . esc_html( $texto ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Devuelve la URL de una imagen guardada en assets/img, o una cadena vacía
 * si el archivo no existe (en ese caso se muestra un fondo de muestra).
 */
function inicio_es_imagen( $archivo ) {
	if ( empty( $archivo ) ) {
		return '';
	}
	if ( preg_match( '#^https?://#', $archivo ) ) {
		return $archivo;
	}
	if ( file_exists( get_template_directory() . '/assets/img/' . $archivo ) ) {
		return get_template_directory_uri() . '/assets/img/' . $archivo;
	}
	return '';
}

/**
 * Pinta los botones/enlaces de una sección.
 */
function inicio_es_botones( $botones ) {
	if ( empty( $botones ) ) {
		return;
	}
	echo '<div class="botones">';
	foreach ( $botones as $i => $boton ) {
		$clase = 0 === $i ? 'boton boton-principal' : 'boton boton-secundario';
		printf(
			'<a class="%1$s" href="%2$s">%3$s</a>',
			esc_attr( $clase ),
			esc_url( $boton['url'] ),
			esc_html( $boton['texto'] )
		);
	}
	echo '</div>';
}
