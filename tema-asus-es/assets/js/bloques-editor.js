/**
 * Bloques "Carrusel ASUS" y "Cuadros ASUS" en el editor de WordPress.
 *
 * En el centro se ve cómo queda el bloque y en el panel de la derecha
 * se cambian los textos, los enlaces y las fotos con clics.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var be = wp.blockEditor;
	var c = wp.components;
	var ServerSideRender = wp.serverSideRender;
	var carpetaImagenes = ( window.asusEs && window.asusEs.img ) || '';

	/* Las fotos del tema se guardan solo con su nombre; las de la biblioteca, con su dirección. */
	var urlImagen = function ( valor ) {
		if ( ! valor ) { return ''; }
		return /^https?:\/\//.test( valor ) ? valor : carpetaImagenes + valor;
	};

	var opcionesTema = [
		{ label: 'Oscuro (letras blancas)', value: 'oscuro' },
		{ label: 'Claro (letras negras)', value: 'claro' }
	];
	var opcionesMuestra = [
		{ label: 'Gris', value: 'gris' },
		{ label: 'Blanco', value: 'blanco' },
		{ label: 'Negro', value: 'negro' },
		{ label: 'Naranja', value: 'naranja' }
	];

	/* Campo para elegir una foto de la biblioteca de medios */
	var campoImagen = function ( valor, alCambiar ) {
		return el( 'div', { style: { marginBottom: '16px' } },
			el( 'p', { style: { margin: '0 0 6px', fontWeight: 500 } }, 'Foto' ),
			valor ? el( 'img', {
				src: urlImagen( valor ),
				alt: '',
				style: { display: 'block', width: '100%', maxHeight: '140px', objectFit: 'cover', borderRadius: '4px', marginBottom: '8px' }
			} ) : el( 'p', { style: { margin: '0 0 8px', color: '#757575' } }, 'Sin foto: se ve un color de muestra.' ),
			el( be.MediaUploadCheck, {},
				el( be.MediaUpload, {
					allowedTypes: [ 'image' ],
					onSelect: function ( media ) { alCambiar( media.url ); },
					render: function ( obj ) {
						return el( 'div', { style: { display: 'flex', gap: '8px', flexWrap: 'wrap' } },
							el( c.Button, { variant: 'secondary', onClick: obj.open }, valor ? 'Cambiar foto' : 'Elegir foto' ),
							valor ? el( c.Button, { variant: 'tertiary', isDestructive: true, onClick: function () { alCambiar( '' ); } }, 'Quitar foto' ) : null
						);
					}
				} )
			)
		);
	};

	/* Un campo de texto, de lista o de foto, según su tipo */
	var campo = function ( definicion, item, alCambiar ) {
		var valor = item[ definicion.clave ] || '';
		var cambiar = function ( v ) { alCambiar( definicion.clave, v ); };
		if ( 'imagen' === definicion.tipo ) {
			return el( Fragment, { key: definicion.clave }, campoImagen( valor, cambiar ) );
		}
		if ( 'lista' === definicion.tipo ) {
			return el( c.SelectControl, { key: definicion.clave, label: definicion.etiqueta, value: valor, options: definicion.opciones, onChange: cambiar, help: definicion.ayuda, __nextHasNoMarginBottom: true, __next40pxDefaultSize: true } );
		}
		if ( 'parrafo' === definicion.tipo ) {
			return el( c.TextareaControl, { key: definicion.clave, label: definicion.etiqueta, value: valor, onChange: cambiar, help: definicion.ayuda, rows: 3, __nextHasNoMarginBottom: true } );
		}
		return el( c.TextControl, { key: definicion.clave, label: definicion.etiqueta, value: valor, onChange: cambiar, help: definicion.ayuda, __nextHasNoMarginBottom: true, __next40pxDefaultSize: true } );
	};

	/* Paneles del lado derecho: uno por cada foto o cuadro, y un botón para agregar más */
	var panelesLista = function ( props, atributo, campos, nombre, nuevo ) {
		var lista = props.attributes[ atributo ] || [];
		var guardar = function ( nuevaLista ) {
			var cambio = {};
			cambio[ atributo ] = nuevaLista;
			props.setAttributes( cambio );
		};
		var copiar = function () {
			return lista.map( function ( item ) { return Object.assign( {}, item ); } );
		};

		var paneles = lista.map( function ( item, i ) {
			var cambiarCampo = function ( clave, valor ) {
				var copia = copiar();
				copia[ i ][ clave ] = valor;
				guardar( copia );
			};
			var mover = function ( paso ) {
				var copia = copiar();
				var movido = copia.splice( i, 1 )[ 0 ];
				copia.splice( i + paso, 0, movido );
				guardar( copia );
			};
			return el( c.PanelBody, {
				key: atributo + '-' + i,
				title: nombre + ' ' + ( i + 1 ) + ( item.titulo ? ': ' + item.titulo : '' ),
				initialOpen: 0 === i
			},
				el( 'div', { style: { display: 'grid', gap: '14px' } },
					campos.map( function ( definicion ) { return campo( definicion, item, cambiarCampo ); } )
				),
				el( 'div', { style: { display: 'flex', gap: '4px', flexWrap: 'wrap', marginTop: '14px', paddingTop: '10px', borderTop: '1px solid #e0e0e0' } },
					el( c.Button, { variant: 'tertiary', disabled: 0 === i, onClick: function () { mover( -1 ); } }, '↑ Subir' ),
					el( c.Button, { variant: 'tertiary', disabled: i === lista.length - 1, onClick: function () { mover( 1 ); } }, '↓ Bajar' ),
					el( c.Button, {
						variant: 'tertiary',
						isDestructive: true,
						disabled: lista.length < 2,
						onClick: function () {
							var copia = copiar();
							copia.splice( i, 1 );
							guardar( copia );
						}
					}, 'Eliminar' )
				)
			);
		} );

		paneles.push( el( c.PanelBody, { key: atributo + '-agregar', title: 'Agregar', initialOpen: true },
			el( c.Button, {
				variant: 'primary',
				onClick: function () { guardar( copiar().concat( [ Object.assign( {}, nuevo ) ] ) ); }
			}, '+ Agregar ' + nombre.toLowerCase() )
		) );
		return paneles;
	};

	/* Vista previa del bloque en el centro del editor */
	var vistaPrevia = function ( nombreBloque, props, ayuda ) {
		var blockProps = be.useBlockProps();
		return el( 'div', blockProps,
			props.isSelected ? el( 'div', { className: 'asus-ayuda' }, ayuda ) : null,
			el( 'div', { className: 'asus-vista-previa' },
				el( ServerSideRender, { block: nombreBloque, attributes: props.attributes } )
			)
		);
	};

	/* ---------- Carrusel ASUS ---------- */
	var camposDiapositiva = [
		{ clave: 'titulo', etiqueta: 'Título' },
		{ clave: 'subtitulo', etiqueta: 'Subtítulo' },
		{ clave: 'enlaceTexto', etiqueta: 'Texto del enlace', ayuda: 'Por ejemplo «Ver más». Déjalo vacío para no mostrar enlace.' },
		{ clave: 'enlaceUrl', etiqueta: 'A dónde lleva el enlace', ayuda: 'Una dirección, por ejemplo https://… o /contacto. «#» no lleva a ningún lado.' },
		{ clave: 'tema', etiqueta: 'Color de las letras', tipo: 'lista', opciones: opcionesTema, ayuda: 'Usa «Oscuro» si la foto es oscura y «Claro» si es clara (en «Claro» el texto va arriba).' },
		{ clave: 'imagen', tipo: 'imagen' }
	];

	wp.blocks.registerBlockType( 'asus-es/carrusel', {
		title: 'Carrusel ASUS',
		category: 'asus',
		icon: 'images-alt2',
		edit: function ( props ) {
			return el( Fragment, {},
				el( be.InspectorControls, {},
					el( c.PanelBody, { title: 'Ajustes del carrusel', initialOpen: true },
						el( c.RangeControl, {
							label: 'Segundos por foto',
							value: props.attributes.duracion,
							min: 2,
							max: 30,
							onChange: function ( v ) { props.setAttributes( { duracion: v || 6 } ); },
							__nextHasNoMarginBottom: true,
							__next40pxDefaultSize: true
						} )
					),
					panelesLista( props, 'diapositivas', camposDiapositiva, 'Foto', {
						titulo: 'Nuevo título', subtitulo: 'Nuevo subtítulo', texto: '', enlaceTexto: 'Ver más', enlaceUrl: '#', tema: 'oscuro', muestra: 'gris', imagen: ''
					} )
				),
				vistaPrevia( 'asus-es/carrusel', props, '✎ Cambia las fotos y los textos en el panel de la derecha. En el editor se ve solo la primera foto; en la página pasan solas.' )
			);
		},
		save: function () { return null; }
	} );

	/* ---------- Cuadros ASUS ---------- */
	var camposCuadro = [
		{ clave: 'titulo', etiqueta: 'Título' },
		{ clave: 'subtitulo', etiqueta: 'Subtítulo' },
		{ clave: 'texto', etiqueta: 'Texto de abajo (opcional)', tipo: 'parrafo', ayuda: 'Aparece encima del enlace, como en el cuadro de Copilot+ PC.' },
		{ clave: 'enlaceTexto', etiqueta: 'Texto del enlace', ayuda: 'Por ejemplo «Ver más». Déjalo vacío para no mostrar enlace.' },
		{ clave: 'enlaceUrl', etiqueta: 'A dónde lleva el enlace', ayuda: 'Una dirección, por ejemplo https://… o /contacto. «#» no lleva a ningún lado.' },
		{ clave: 'tema', etiqueta: 'Color de las letras', tipo: 'lista', opciones: opcionesTema },
		{ clave: 'muestra', etiqueta: 'Color de fondo sin foto', tipo: 'lista', opciones: opcionesMuestra },
		{ clave: 'imagen', tipo: 'imagen' }
	];

	wp.blocks.registerBlockType( 'asus-es/cuadros', {
		title: 'Cuadros ASUS',
		category: 'asus',
		icon: 'grid-view',
		edit: function ( props ) {
			return el( Fragment, {},
				el( be.InspectorControls, {},
					panelesLista( props, 'cuadros', camposCuadro, 'Cuadro', {
						titulo: 'Nuevo cuadro', subtitulo: 'Escribe aquí el subtítulo', texto: '', enlaceTexto: 'Ver más', enlaceUrl: '#', tema: 'claro', muestra: 'gris', imagen: ''
					} )
				),
				vistaPrevia( 'asus-es/cuadros', props, '✎ Cambia los cuadros en el panel de la derecha. Se acomodan de dos en dos.' )
			);
		},
		save: function () { return null; }
	} );
} )( window.wp );
