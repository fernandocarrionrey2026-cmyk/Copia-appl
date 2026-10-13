<?php
/**
 * Funciones del tema "Inicio Estilo ASUS (ES)".
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configuración básica del tema.
 */
function asus_es_configuracion() {
	load_theme_textdomain( 'asus-es', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 160,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'align-wide' );

	/* Para que el editor de WordPress muestre los bloques con los colores del tema */
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'assets/css/inicio.css', 'assets/css/editor.css' ) );

	register_nav_menus( array(
		'principal' => __( 'Menú lateral (primer grupo)', 'asus-es' ),
	) );
}
add_action( 'after_setup_theme', 'asus_es_configuracion' );

/**
 * Carga de estilos y scripts.
 */
function asus_es_recursos() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'asus-es-base', get_stylesheet_uri(), array(), $version );
	wp_enqueue_style( 'asus-es', get_template_directory_uri() . '/assets/css/inicio.css', array(), $version );
	wp_enqueue_script( 'asus-es', get_template_directory_uri() . '/assets/js/inicio.js', array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'asus_es_recursos' );

/**
 * Devuelve la URL de una imagen guardada en assets/img, o una cadena vacía
 * si el archivo no existe (en ese caso se muestra un fondo de muestra).
 */
function asus_es_imagen( $archivo ) {
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
 * Atributo style con la imagen de fondo (vacío si no hay imagen).
 */
function asus_es_fondo( $archivo ) {
	$url = asus_es_imagen( $archivo );
	if ( ! $url ) {
		return '';
	}
	return ' style="background-image:url(\'' . esc_url( $url ) . '\')"';
}

/* Bloques "Carrusel ASUS" y "Cuadros ASUS" para el editor */
require get_template_directory() . '/inc/bloques.php';
