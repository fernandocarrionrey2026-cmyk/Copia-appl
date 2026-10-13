<?php
/**
 * CONTENIDO DE LA PÁGINA DE INICIO
 * ---------------------------------
 * Aquí están la franja de aviso, el menú lateral y el pie de página.
 *
 * El carrusel y los cuadros se editan con clics en Pages > Inicio
 * (bloques «Carrusel ASUS» y «Cuadros ASUS»). Lo que está aquí abajo para
 * 'carrusel' y 'cuadros' son los textos que traen esos bloques al agregarlos.
 *
 * - 'imagen' : nombre de un archivo dentro de assets/img (por ejemplo 'zephyrus.jpg')
 *              o una dirección completa (http://...). Si se deja vacío
 *              se muestra un fondo de color de muestra.
 * - 'tema'   : 'oscuro' (letras blancas) o 'claro' (letras negras).
 * - 'url'    : a dónde lleva el enlace ('#' = a ningún lado).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(

	/* Franja gris debajo del logo (déjala vacía '' para ocultarla) */
	'aviso' => array(
		'texto'  => '¡Registre sus productos* para recibir una Garantía Perfecta por 1 año!',
		'enlace' => array( 'texto' => 'Saber más', 'url' => '#' ),
	),

	/* Menú lateral (se abre con el botón de las tres rayas).
	   Cada grupo se separa con una línea. Si un elemento tiene 'sub',
	   muestra un "+" y se despliega. Si en Apariencia > Menús asignas un menú
	   a "Menú lateral (primer grupo)", se usa ese en lugar del primer grupo. */
	'menu_lateral' => array(
		array(
			array( 'texto' => 'AI', 'url' => '#', 'destacado' => true ),
			array( 'texto' => 'Consolas', 'sub' => array( 'ROG Ally', 'ROG Ally X', 'Accesorios para consolas' ) ),
			array( 'texto' => 'Portátiles', 'sub' => array( 'Para el hogar', 'Para gaming', 'Para creadores', 'Para estudiantes', 'Para empresas' ) ),
			array( 'texto' => 'Monitores/Desktops', 'sub' => array( 'Monitores', 'Computadoras de escritorio', 'All-in-One PCs', 'Mini PCs' ) ),
			array( 'texto' => 'Tarjetas Madre/Componentes', 'sub' => array( 'Tarjetas madre', 'Tarjetas gráficas', 'Fuentes de poder', 'Gabinetes', 'Enfriamiento' ) ),
			array( 'texto' => 'Redes/IoT/Servidores', 'sub' => array( 'Routers WiFi', 'Sistemas WiFi Mesh', 'Servidores', 'IoT' ) ),
			array( 'texto' => 'Accesorios', 'sub' => array( 'Teclados', 'Mouse', 'Audífonos', 'Mochilas y fundas' ) ),
		),
		array(
			array( 'texto' => 'Soporte', 'sub' => array( 'Centro de soporte', 'Centros de servicio', 'Registro de producto', 'Garantía' ) ),
			array( 'texto' => 'Mi cuenta', 'icono' => 'usuario', 'sub' => array( 'Iniciar sesión', 'Crear cuenta', 'Mis productos' ) ),
		),
		array(
			array( 'texto' => 'Gaming', 'sub' => array( 'Laptops gaming', 'Monitores gaming', 'Periféricos gaming' ) ),
			array( 'texto' => 'Corporativo', 'sub' => array( 'Laptops para empresas', 'Desktops para empresas', 'Soluciones' ) ),
		),
	),

	/* Carrusel principal: pasa solo cada 6 segundos (el tiempo se cambia en assets/js/inicio.js) */
	'carrusel' => array(
		array(
			'titulo'    => 'ROG ZEPHYRUS DUO',
			'subtitulo' => 'Duplica tu potencial',
			'enlace'    => array( 'texto' => 'Ver más', 'url' => '#' ),
			'tema'      => 'oscuro',
			'imagen'    => 'rog-zephyrus-duo.jpg',
		),
		array(
			'titulo'    => 'Zenbook DUO',
			'subtitulo' => 'Tu DUO perfecto',
			'enlace'    => array( 'texto' => 'Ver más', 'url' => '#' ),
			'tema'      => 'claro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'ROG STRIX SCAR 18',
			'subtitulo' => 'Acelera tu victoria',
			'enlace'    => array( 'texto' => 'Ver más', 'url' => '#' ),
			'tema'      => 'oscuro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'ASUS Vivobook S16',
			'subtitulo' => 'Más inteligente, más productiva, más segura.',
			'enlace'    => array( 'texto' => 'Ver más', 'url' => '#' ),
			'tema'      => 'claro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'ASUS TUF GAMING F15',
			'subtitulo' => 'Resistencia optimizada para el campo de batalla.',
			'enlace'    => array( 'texto' => 'Ver más', 'url' => '#' ),
			'tema'      => 'oscuro',
			'imagen'    => '',
		),
		array(
			'titulo'    => 'Copilot+ PC',
			'subtitulo' => 'Los PC Windows más rápidos e inteligentes.',
			'enlace'    => array( 'texto' => 'Saber más', 'url' => '#' ),
			'tema'      => 'claro',
			'imagen'    => '',
		),
	),

	/* Cuadros de dos columnas debajo del carrusel.
	   'muestra' solo elige el color de muestra mientras no pongas imagen:
	   'naranja', 'blanco', 'negro' o 'gris'. */
	'cuadros' => array(
		array(
			'titulo'    => 'ASUS TUF GAMING F15',
			'subtitulo' => 'Resistencia optimizada para el campo de batalla.',
			'texto'     => '',
			'enlace'    => array( 'texto' => 'Ver más', 'url' => '#' ),
			'tema'      => 'oscuro',
			'muestra'   => 'naranja',
			'imagen'    => 'tuf-gaming-f15.jpg',
		),
		array(
			'titulo'    => 'ASUS Vivobook S16',
			'subtitulo' => 'Más inteligente, más productiva, más segura.',
			'texto'     => '',
			'enlace'    => array( 'texto' => 'Ver más', 'url' => '#' ),
			'tema'      => 'claro',
			'muestra'   => 'blanco',
			'imagen'    => 'vivobook-s16.jpg',
		),
		array(
			'titulo'    => 'ROG STRIX SCAR 18',
			'subtitulo' => 'ACELERA TU VICTORIA',
			'texto'     => '',
			'enlace'    => array( 'texto' => 'Ver más', 'url' => '#' ),
			'tema'      => 'oscuro',
			'muestra'   => 'negro',
			'imagen'    => 'rog-strix-scar-18.jpg',
		),
		array(
			'titulo'    => 'Copilot+PC',
			'subtitulo' => '',
			'texto'     => 'Los Copilot+ PC son los PC Windows más rápidos, inteligentes y seguros de la historia',
			'enlace'    => array( 'texto' => 'Saber más', 'url' => '#' ),
			'tema'      => 'claro',
			'muestra'   => 'gris',
			'imagen'    => 'copilot-pc.jpg',
		),
	),

	/* Pie de página.
	   Un enlace con 'negrita' => true se ve como título de grupo. */
	'pie_columnas' => array(
		array(
			'titulo'   => 'Comprar y más información',
			'columnas' => array(
				array(
					array( 'texto' => 'Consolas', 'negrita' => true ),
					array( 'texto' => 'Portátiles', 'negrita' => true ),
					array( 'texto' => 'Casa' ),
					array( 'texto' => 'Oficina' ),
					array( 'texto' => 'Estudiantes' ),
					array( 'texto' => 'AI PC' ),
				),
				array(
					array( 'texto' => 'Monitores/Desktops', 'negrita' => true ),
					array( 'texto' => 'All-in-One PCs' ),
					array( 'texto' => 'Tarjetas Madre/Componentes', 'negrita' => true ),
					array( 'texto' => 'Redes/IoT/Servidores', 'negrita' => true ),
					array( 'texto' => 'Accesorios', 'negrita' => true ),
				),
			),
		),
		array(
			'titulo'   => 'Soporte',
			'columnas' => array(
				array(
					array( 'texto' => 'Centros de servicio' ),
					array( 'texto' => 'Registro de producto' ),
					array( 'texto' => 'Videos de soporte' ),
					array( 'texto' => 'Quienes somos', 'negrita' => true ),
					array( 'texto' => 'Acerca de nosotros' ),
					array( 'texto' => 'Pressroom' ),
					array( 'texto' => 'Empleos' ),
				),
			),
		),
		array(
			'titulo'   => 'Buscas más',
			'columnas' => array(
				array(
					array( 'texto' => 'AI PC' ),
					array( 'texto' => 'Design Center' ),
					array( 'texto' => 'Equipos profesionales' ),
					array( 'texto' => 'Advanced AI PCs' ),
					array( 'texto' => 'Avisos de licencias' ),
					array( 'texto' => 'Blog' ),
					array( 'texto' => 'Armoury Crate' ),
					array( 'texto' => 'Aura' ),
				),
			),
		),
	),

	'boletin' => array(
		'titulo'      => 'Obtén las últimas ofertas y más',
		'placeholder' => 'Ingresar dirección de correo electrónico',
		'boton'       => 'Regístrate',
	),

	'pie_derechos' => '© ' . gmdate( 'Y' ) . ' Mi Proyecto. Todos los derechos reservados.',
	'pie_legales'  => array( 'Condiciones de uso', 'Política de privacidad' ),
	'pie_pais'     => 'Ecuador / Español',
);
