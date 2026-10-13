( function () {
	/* ---------- Menú lateral ---------- */
	var abrir = document.getElementById( 'abrir-menu' );
	var cerrar = document.getElementById( 'cerrar-menu' );
	var menu = document.getElementById( 'menu-lateral' );
	var velo = document.getElementById( 'velo' );

	var ponerMenu = function ( abierto ) {
		document.body.classList.toggle( 'menu-abierto', abierto );
		menu.setAttribute( 'aria-hidden', abierto ? 'false' : 'true' );
		abrir.setAttribute( 'aria-expanded', abierto ? 'true' : 'false' );
		velo.hidden = ! abierto;
	};
	if ( abrir && menu ) {
		abrir.addEventListener( 'click', function () { ponerMenu( true ); } );
		cerrar.addEventListener( 'click', function () { ponerMenu( false ); } );
		velo.addEventListener( 'click', function () { ponerMenu( false ); } );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key ) { ponerMenu( false ); }
		} );

		/* Despliega los submenús con el "+" */
		menu.querySelectorAll( '.con-sub > .menu-enlace' ).forEach( function ( b ) {
			b.addEventListener( 'click', function () {
				var abierto = b.getAttribute( 'aria-expanded' ) !== 'true';
				b.setAttribute( 'aria-expanded', abierto ? 'true' : 'false' );
				b.nextElementSibling.hidden = ! abierto;
			} );
		} );

		/* Menú creado en WordPress: los elementos con hijos también se despliegan */
		menu.querySelectorAll( '.menu-wp .menu-item-has-children > a' ).forEach( function ( a ) {
			var sub = a.nextElementSibling;
			sub.hidden = true;
			a.classList.add( 'tiene-hijos' );
			a.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				sub.hidden = ! sub.hidden;
				a.classList.toggle( 'desplegado', ! sub.hidden );
			} );
		} );
	}

	/* ---------- Carrusel ---------- */
	var carrusel = document.getElementById( 'carrusel' );
	if ( carrusel ) {
		var slides = carrusel.querySelectorAll( '.diapositiva' );
		var puntos = carrusel.querySelectorAll( '.punto' );
		var pausa = document.getElementById( 'pausa' );
		var actual = 0;
		var pausado = false;
		var temporizador;
		var DURACION = 6000; /* tiempo de cada foto en milisegundos (6000 = 6 segundos) */
		carrusel.style.setProperty( '--duracion', DURACION + 'ms' );

		var mostrar = function ( n ) {
			actual = ( n + slides.length ) % slides.length;
			slides.forEach( function ( s, i ) { s.classList.toggle( 'activa', i === actual ); } );
			puntos.forEach( function ( p, i ) {
				p.classList.remove( 'activo' );
				if ( i === actual ) {
					void p.offsetWidth; /* reinicia la barra de progreso */
					p.classList.add( 'activo' );
				}
			} );
			programar();
		};
		var programar = function () {
			clearTimeout( temporizador );
			if ( ! pausado && slides.length > 1 ) {
				temporizador = setTimeout( function () { mostrar( actual + 1 ); }, DURACION );
			}
		};

		puntos.forEach( function ( p ) {
			p.addEventListener( 'click', function () { mostrar( parseInt( p.dataset.indice, 10 ) ); } );
		} );
		pausa.addEventListener( 'click', function () {
			pausado = ! pausado;
			carrusel.classList.toggle( 'pausado', pausado );
			pausa.setAttribute( 'aria-label', pausado ? 'Reproducir' : 'Pausar' );
			if ( pausado ) { clearTimeout( temporizador ); } else { mostrar( actual ); }
		} );

		/* Deslizar con el dedo */
		var inicioX = null;
		carrusel.addEventListener( 'touchstart', function ( e ) { inicioX = e.touches[ 0 ].clientX; }, { passive: true } );
		carrusel.addEventListener( 'touchend', function ( e ) {
			if ( null === inicioX ) { return; }
			var dx = e.changedTouches[ 0 ].clientX - inicioX;
			if ( Math.abs( dx ) > 40 ) { mostrar( actual + ( dx < 0 ? 1 : -1 ) ); }
			inicioX = null;
		} );

		programar();
	}

	/* ---------- Pie: columnas plegables solo en celular ---------- */
	var bloques = document.querySelectorAll( '.pie-bloque' );
	var consulta = window.matchMedia( '(max-width: 767px)' );
	var ajustarPie = function () {
		bloques.forEach( function ( b ) { b.open = ! consulta.matches; } );
	};
	ajustarPie();
	consulta.addEventListener( 'change', ajustarPie );
} )();
