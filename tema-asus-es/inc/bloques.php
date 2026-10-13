<?php
/**
 * BLOQUES DEL EDITOR
 * ------------------
 * Agrega al editor de WordPress dos bloques que se editan con clics:
 *   - "Carrusel ASUS": las fotos grandes que pasan solas.
 *   - "Cuadros ASUS":  los cuadros de dos columnas.
 * También agrega el patrón "Página de inicio ASUS" (los dos bloques juntos)
 * y crea una sola vez la página "Inicio" con ese diseño.
 *
 * Los textos que trae cada bloque al agregarlo salen de inc/contenido-inicio.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Contenido de inc/contenido-inicio.php (se lee una sola vez).
 */
function asus_es_contenido() {
	static $contenido = null;
	if ( null === $contenido ) {
		$contenido = require get_template_directory() . '/inc/contenido-inicio.php';
	}
	return $contenido;
}

/**
 * Deja cada foto o cuadro con todos sus campos y valores válidos.
 * Acepta el formato de contenido-inicio.php ('enlace' => array(texto, url))
 * y el de los bloques (enlaceTexto, enlaceUrl).
 */
function asus_es_normalizar( $item ) {
	$item = is_array( $item ) ? $item : array();
	if ( isset( $item['enlace'] ) && is_array( $item['enlace'] ) ) {
		$item['enlaceTexto'] = isset( $item['enlace']['texto'] ) ? $item['enlace']['texto'] : '';
		$item['enlaceUrl']   = isset( $item['enlace']['url'] ) ? $item['enlace']['url'] : '';
	}
	$item = wp_parse_args( $item, array(
		'titulo'      => '',
		'subtitulo'   => '',
		'texto'       => '',
		'enlaceTexto' => '',
		'enlaceUrl'   => '#',
		'tema'        => 'oscuro',
		'muestra'     => 'gris',
		'imagen'      => '',
	) );
	if ( ! in_array( $item['tema'], array( 'oscuro', 'claro' ), true ) ) {
		$item['tema'] = 'oscuro';
	}
	if ( ! in_array( $item['muestra'], array( 'naranja', 'blanco', 'negro', 'gris' ), true ) ) {
		$item['muestra'] = 'gris';
	}
	return array_intersect_key( $item, array_flip( array( 'titulo', 'subtitulo', 'texto', 'enlaceTexto', 'enlaceUrl', 'tema', 'muestra', 'imagen' ) ) );
}

/**
 * Lista de fotos/cuadros de contenido-inicio.php en el formato de los bloques.
 */
function asus_es_lista_inicial( $clave ) {
	$contenido = asus_es_contenido();
	$lista     = isset( $contenido[ $clave ] ) ? $contenido[ $clave ] : array();
	return array_values( array_map( 'asus_es_normalizar', $lista ) );
}

/**
 * HTML del carrusel.
 *
 * @param array  $diapositivas Fotos del carrusel.
 * @param int    $segundos     Tiempo de cada foto.
 * @param string $envoltura    Atributos de la etiqueta principal (class="...").
 */
function asus_es_html_carrusel( $diapositivas, $segundos, $envoltura ) {
	$diapositivas = array_values( array_map( 'asus_es_normalizar', (array) $diapositivas ) );
	if ( ! $diapositivas ) {
		return '';
	}
	ob_start();
	?>
	<section <?php echo $envoltura; // phpcs:ignore -- ya viene escapado ?> data-duracion="<?php echo (int) $segundos * 1000; ?>" aria-roledescription="carrusel">
		<?php foreach ( $diapositivas as $i => $slide ) : ?>
			<div class="diapositiva tema-<?php echo esc_attr( $slide['tema'] ); ?> muestra-slide-<?php echo (int) $i % 6; ?><?php echo 0 === $i ? ' activa' : ''; ?>"<?php echo asus_es_fondo( $slide['imagen'] ); ?>>
				<div class="diapositiva-texto">
					<?php if ( '' !== $slide['titulo'] ) : ?>
						<h2><?php echo esc_html( $slide['titulo'] ); ?></h2>
					<?php endif; ?>
					<?php if ( '' !== $slide['subtitulo'] ) : ?>
						<p><?php echo esc_html( $slide['subtitulo'] ); ?></p>
					<?php endif; ?>
					<?php if ( '' !== $slide['enlaceTexto'] ) : ?>
						<a class="ver-mas" href="<?php echo esc_url( $slide['enlaceUrl'] ); ?>"><?php echo esc_html( $slide['enlaceTexto'] ); ?> <span aria-hidden="true">&rsaquo;</span></a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>

		<?php if ( count( $diapositivas ) > 1 ) : ?>
			<div class="controles">
				<?php foreach ( $diapositivas as $i => $slide ) : ?>
					<button class="punto<?php echo 0 === $i ? ' activo' : ''; ?>" data-indice="<?php echo (int) $i; ?>" aria-label="<?php echo esc_attr( $slide['titulo'] ? $slide['titulo'] : sprintf( 'Foto %d', $i + 1 ) ); ?>"><span class="progreso"></span></button>
				<?php endforeach; ?>
				<button class="pausa" aria-label="<?php esc_attr_e( 'Pausar', 'asus-es' ); ?>">
					<svg class="icono-pausa" viewBox="0 0 12 12" width="12" height="12" aria-hidden="true"><rect x="2.5" y="2" width="2" height="8" fill="currentColor"/><rect x="7.5" y="2" width="2" height="8" fill="currentColor"/></svg>
					<svg class="icono-play" viewBox="0 0 12 12" width="12" height="12" aria-hidden="true"><path d="M3 2l7 4-7 4z" fill="currentColor"/></svg>
				</button>
			</div>
		<?php endif; ?>
	</section>
	<?php
	return ob_get_clean();
}

/**
 * HTML de los cuadros de dos columnas.
 */
function asus_es_html_cuadros( $cuadros, $envoltura ) {
	$cuadros = array_values( array_map( 'asus_es_normalizar', (array) $cuadros ) );
	if ( ! $cuadros ) {
		return '';
	}
	ob_start();
	?>
	<section <?php echo $envoltura; // phpcs:ignore -- ya viene escapado ?>>
		<?php foreach ( $cuadros as $cuadro ) : ?>
			<div class="cuadro tema-<?php echo esc_attr( $cuadro['tema'] ); ?> muestra-<?php echo esc_attr( $cuadro['muestra'] ); ?>"<?php echo asus_es_fondo( $cuadro['imagen'] ); ?>>
				<div class="cuadro-arriba">
					<?php if ( '' !== $cuadro['titulo'] ) : ?>
						<h3><?php echo esc_html( $cuadro['titulo'] ); ?></h3>
					<?php endif; ?>
					<?php if ( '' !== $cuadro['subtitulo'] ) : ?>
						<p><?php echo esc_html( $cuadro['subtitulo'] ); ?></p>
					<?php endif; ?>
				</div>
				<div class="cuadro-abajo">
					<?php if ( '' !== $cuadro['texto'] ) : ?>
						<p class="cuadro-texto"><?php echo esc_html( $cuadro['texto'] ); ?></p>
					<?php endif; ?>
					<?php if ( '' !== $cuadro['enlaceTexto'] ) : ?>
						<a class="ver-mas" href="<?php echo esc_url( $cuadro['enlaceUrl'] ); ?>"><?php echo esc_html( $cuadro['enlaceTexto'] ); ?> <span aria-hidden="true">&rsaquo;</span></a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</section>
	<?php
	return ob_get_clean();
}

/**
 * Lo que muestran los bloques en la página.
 */
function asus_es_render_carrusel( $atributos ) {
	$segundos = isset( $atributos['duracion'] ) ? (int) $atributos['duracion'] : 6;
	$segundos = max( 2, min( 30, $segundos ) );
	$lista    = isset( $atributos['diapositivas'] ) ? $atributos['diapositivas'] : array();
	return asus_es_html_carrusel( $lista, $segundos, get_block_wrapper_attributes( array( 'class' => 'carrusel' ) ) );
}

function asus_es_render_cuadros( $atributos ) {
	$lista = isset( $atributos['cuadros'] ) ? $atributos['cuadros'] : array();
	return asus_es_html_cuadros( $lista, get_block_wrapper_attributes( array( 'class' => 'cuadros' ) ) );
}

/**
 * Registro de los bloques, su categoría "ASUS" y el patrón de página.
 */
function asus_es_registrar_bloques() {
	$version = wp_get_theme( get_template() )->get( 'Version' );
	$uri     = get_template_directory_uri();

	wp_register_script(
		'asus-es-bloques',
		$uri . '/assets/js/bloques-editor.js',
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render' ),
		$version,
		true
	);
	wp_add_inline_script(
		'asus-es-bloques',
		'window.asusEs = ' . wp_json_encode( array( 'img' => $uri . '/assets/img/' ) ) . ';',
		'before'
	);

	$soporte = array(
		'html'     => false,
		'align'    => array( 'full' ),
		'multiple' => true,
	);

	register_block_type( 'asus-es/carrusel', array(
		'api_version'     => 3,
		'title'           => 'Carrusel ASUS',
		'description'     => 'Fotos grandes que pasan solas, con título, subtítulo y enlace.',
		'category'        => 'asus',
		'icon'            => 'images-alt2',
		'keywords'        => array( 'carrusel', 'slider', 'banner', 'asus' ),
		'supports'        => $soporte,
		'attributes'      => array(
			'diapositivas' => array(
				'type'    => 'array',
				'default' => asus_es_lista_inicial( 'carrusel' ),
			),
			'duracion'     => array(
				'type'    => 'number',
				'default' => 6,
			),
			'align'        => array(
				'type'    => 'string',
				'default' => 'full',
			),
		),
		'editor_script'   => 'asus-es-bloques',
		'render_callback' => 'asus_es_render_carrusel',
	) );

	register_block_type( 'asus-es/cuadros', array(
		'api_version'     => 3,
		'title'           => 'Cuadros ASUS',
		'description'     => 'Cuadros de dos columnas con foto, título y enlace.',
		'category'        => 'asus',
		'icon'            => 'grid-view',
		'keywords'        => array( 'cuadros', 'columnas', 'productos', 'asus' ),
		'supports'        => $soporte,
		'attributes'      => array(
			'cuadros' => array(
				'type'    => 'array',
				'default' => asus_es_lista_inicial( 'cuadros' ),
			),
			'align'   => array(
				'type'    => 'string',
				'default' => 'full',
			),
		),
		'editor_script'   => 'asus-es-bloques',
		'render_callback' => 'asus_es_render_cuadros',
	) );

	if ( function_exists( 'register_block_pattern' ) ) {
		register_block_pattern_category( 'asus', array( 'label' => 'ASUS' ) );
		register_block_pattern( 'asus-es/pagina-inicio', array(
			'title'       => 'Página de inicio ASUS',
			'description' => 'El carrusel y los cuatro cuadros, igual que la página de inicio.',
			'categories'  => array( 'asus' ),
			'content'     => asus_es_contenido_patron(),
		) );
	}
}
add_action( 'init', 'asus_es_registrar_bloques' );

/**
 * Contenido del patrón: los dos bloques con sus textos iniciales.
 */
function asus_es_contenido_patron() {
	return "<!-- wp:asus-es/carrusel /-->\n\n<!-- wp:asus-es/cuadros /-->";
}

/**
 * Categoría "ASUS" en la lista de bloques del editor.
 */
function asus_es_categoria_bloques( $categorias ) {
	array_unshift( $categorias, array(
		'slug'  => 'asus',
		'title' => 'ASUS',
		'icon'  => null,
	) );
	return $categorias;
}
add_filter( 'block_categories_all', 'asus_es_categoria_bloques' );

/**
 * Crea una sola vez la página "Inicio" con el diseño ASUS.
 * Si el sitio todavía muestra las últimas entradas en la portada,
 * la deja como página de inicio (Settings > Reading).
 */
function asus_es_crear_pagina_inicio() {
	if ( get_option( 'asus_es_pagina_inicio' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$id = wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => 'Inicio',
		'post_content' => asus_es_contenido_patron(),
	) );
	if ( ! $id || is_wp_error( $id ) ) {
		return;
	}

	update_option( 'asus_es_pagina_inicio', $id );
	$es_portada = false;
	if ( 'posts' === get_option( 'show_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $id );
		$es_portada = true;
	}
	set_transient( 'asus_es_aviso_inicio', array( 'id' => $id, 'portada' => $es_portada ), HOUR_IN_SECONDS );
}
add_action( 'admin_init', 'asus_es_crear_pagina_inicio' );

/**
 * Aviso en el panel después de crear la página.
 */
function asus_es_aviso_pagina_inicio() {
	$aviso = get_transient( 'asus_es_aviso_inicio' );
	if ( ! $aviso || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	delete_transient( 'asus_es_aviso_inicio' );
	$editar = get_edit_post_link( $aviso['id'] );
	?>
	<div class="notice notice-success is-dismissible">
		<p>
			<strong>Tema ASUS:</strong> se creó la página «Inicio» con el carrusel y los cuadros<?php echo $aviso['portada'] ? ' y quedó como página de inicio de tu sitio' : ''; ?>.
			<a href="<?php echo esc_url( $editar ); ?>">Editarla con clics</a>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'asus_es_aviso_pagina_inicio' );
