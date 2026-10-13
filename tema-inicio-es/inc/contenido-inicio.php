<?php
/**
 * CONTENIDO DE LA PÁGINA DE INICIO
 * ---------------------------------
 * Aquí está todo el texto de la página. Cambia lo que quieras:
 *
 * - 'titulo'     : texto grande
 * - 'subtitulo'  : texto debajo del título
 * - 'botones'    : lista de botones (el primero es azul, el segundo es de borde)
 * - 'tema'       : 'claro' (fondo gris claro, letras oscuras) u 'oscuro' (fondo negro, letras blancas)
 * - 'imagen'     : nombre de un archivo dentro de assets/img (por ejemplo 'iphone.jpg')
 *                  o una dirección completa (https://...). Si se deja vacío
 *                  se muestra un fondo de muestra.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(

	/* Franja de aviso arriba de todo (déjala vacía '' para ocultarla) */
	'aviso' => array(
		'texto'  => 'Compra en línea y recibe asesoría personalizada de un Especialista.',
		'enlace' => array( 'texto' => 'Comprar', 'url' => '#' ),
	),

	/* Secciones grandes, a lo ancho de la pantalla */
	'destacados' => array(
		array(
			'titulo'    => 'iPhone 17 Pro',
			'subtitulo' => 'Todo un Pro.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
				array( 'texto' => 'Comprar', 'url' => '#' ),
			),
			'tema'      => 'claro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'iPhone Air',
			'subtitulo' => 'Lo nuevo del iPhone en su versión más delgada.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
				array( 'texto' => 'Comprar', 'url' => '#' ),
			),
			'tema'      => 'claro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'iPhone 17',
			'subtitulo' => 'Más resistente. Más brillante. Más genial.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
				array( 'texto' => 'Comprar', 'url' => '#' ),
			),
			'tema'      => 'oscuro',
			'imagen'    => '',
		),
	),

	/* Cuadros en dos columnas */
	'mosaicos' => array(
		array(
			'titulo'    => 'AirPods Pro 3',
			'subtitulo' => 'La mejor cancelación activa de ruido del mundo en audífonos in-ear.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
				array( 'texto' => 'Comprar', 'url' => '#' ),
			),
			'tema'      => 'claro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'WATCH SERIES 11',
			'subtitulo' => 'El reloj más completo para tu salud.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
				array( 'texto' => 'Comprar', 'url' => '#' ),
			),
			'tema'      => 'oscuro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'MacBook Pro',
			'subtitulo' => 'Potencia de sobra con el chip M5.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
				array( 'texto' => 'Comprar', 'url' => '#' ),
			),
			'tema'      => 'oscuro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'iPad Pro',
			'subtitulo' => 'Ahora con superpoderes.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
				array( 'texto' => 'Comprar', 'url' => '#' ),
			),
			'tema'      => 'claro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'WATCH ULTRA 3',
			'subtitulo' => 'Aventura personalizada.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
				array( 'texto' => 'Comprar', 'url' => '#' ),
			),
			'tema'      => 'oscuro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'Trade In',
			'subtitulo' => 'Entrega tu dispositivo y obtén crédito para uno nuevo.',
			'botones'   => array(
				array( 'texto' => 'Más información', 'url' => '#' ),
			),
			'tema'      => 'claro',
			'imagen'    => '',
		),
	),

	/* Notas al pie (texto pequeño antes del pie de página) */
	'notas' => array(
		'Los precios, la disponibilidad y las características pueden variar según el país.',
		'Algunas funciones pueden no estar disponibles en todos los idiomas o regiones.',
	),

	/* Columnas del pie de página */
	'pie_columnas' => array(
		array(
			array(
				'titulo'  => 'Explorar y comprar',
				'enlaces' => array( 'Tienda', 'Mac', 'iPad', 'iPhone', 'Watch', 'Vision', 'AirPods', 'TV y Casa', 'AirTag', 'Accesorios' ),
			),
		),
		array(
			array(
				'titulo'  => 'Cuenta',
				'enlaces' => array( 'Administrar tu cuenta', 'Cuenta de iCloud.com' ),
			),
			array(
				'titulo'  => 'Entretenimiento',
				'enlaces' => array( 'Apple One', 'Apple TV', 'Apple Music', 'Apple Arcade', 'Apple Fitness+', 'Apple Podcasts', 'Apple Books', 'App Store' ),
			),
		),
		array(
			array(
				'titulo'  => 'Para empresas',
				'enlaces' => array( 'Apple y las empresas' ),
			),
			array(
				'titulo'  => 'Para educación',
				'enlaces' => array( 'Apple y la educación' ),
			),
		),
		array(
			array(
				'titulo'  => 'Valores',
				'enlaces' => array( 'Accesibilidad', 'Medio ambiente', 'Privacidad', 'Cadena de suministro' ),
			),
		),
		array(
			array(
				'titulo'  => 'Acerca de',
				'enlaces' => array( 'Newsroom', 'Liderazgo', 'Empleos', 'Ética y cumplimiento', 'Eventos', 'Contacto' ),
			),
		),
	),

	/* Parte final del pie */
	'pie_ayuda'    => 'Más formas de comprar: busca un distribuidor autorizado cerca de ti.',
	'pie_derechos' => 'Copyright © ' . gmdate( 'Y' ) . ' Mi Proyecto. Todos los derechos reservados.',
	'pie_legales'  => array( 'Política de privacidad', 'Uso de cookies', 'Términos de uso', 'Ventas y reembolsos', 'Aviso legal', 'Mapa del sitio' ),
	'pie_pais'     => 'Latinoamérica y el Caribe (Español)',
);
