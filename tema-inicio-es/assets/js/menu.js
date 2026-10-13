/* Abre y cierra el menú en celulares */
( function () {
	var boton = document.getElementById( 'nav-hamburguesa' );
	var barra = document.getElementById( 'barra-nav' );
	if ( ! boton || ! barra ) {
		return;
	}

	boton.addEventListener( 'click', function () {
		var abierto = barra.classList.toggle( 'menu-abierto' );
		boton.setAttribute( 'aria-expanded', abierto ? 'true' : 'false' );
		document.body.classList.toggle( 'sin-scroll', abierto );
	} );

	/* En el pie de página, las columnas se pliegan solo en pantallas pequeñas */
	var grupos = document.querySelectorAll( '.pie-grupo' );
	var consulta = window.matchMedia( '(max-width: 833px)' );
	function ajustarPie() {
		grupos.forEach( function ( g ) {
			g.open = ! consulta.matches;
		} );
	}
	ajustarPie();
	consulta.addEventListener( 'change', ajustarPie );
} )();
