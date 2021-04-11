$( '#myNavbar .navbar-nav a' ).on( 'click', function () {
	$( '#myNavbar .navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
	$( this ).parent( 'li' ).addClass( 'active' );
});