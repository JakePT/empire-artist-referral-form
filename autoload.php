<?php
spl_autoload_register(
	function ( $class ) {
		$prefix = 'EmpireArtist\\ReferralForm\\';

		if ( strncmp( $prefix, $class, strlen( $prefix ) ) === 0 ) {
			$file = __DIR__ . '/inc/' . str_replace( '\\', '/', substr( $class, strlen( $prefix ) ) ) . '.php';

			if ( file_exists( $file ) ) {
				require $file;
			}
		}

		return;
	}
);
