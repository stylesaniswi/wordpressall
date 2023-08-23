<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'portfolio' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'E43~,+7YHzVln9qH,33E|TG2__=3u6m3a*p_i;B8TSoO`.<YUA/Mlke@JVAl%YP,' );
define( 'SECURE_AUTH_KEY',  'i-]Ylax/9`&QxYKd/O%L}oE7ihUda`4H23~;2B^3Xy@H|KZFGO~Eu+@o@zh99}@,' );
define( 'LOGGED_IN_KEY',    '{%ikQLV+m;GBzXOhxY|iDm2}Ut=IqzVp:~D3xgAo2_S-`6T4vpC|2NT 6t%cnULW' );
define( 'NONCE_KEY',        'Utz7a. >t59>B)$6TdF{fwQ0/&e!b9!PMuKb4#jCD3}7&,U{GV}TdWg4O0$~A`kz' );
define( 'AUTH_SALT',        'bd#YC({P]nMIgxigCT-R@z/!v~Y/X`7Ko+l,KN(rGk=3It<xsP|FKA/pab@M(ub4' );
define( 'SECURE_AUTH_SALT', 'GZ@DfhrBw^Tt89AvHRUB.)cg+.,({?j.U< Q=!=+qOQLuyaEx_s6#_RJ3d?I?Ut/' );
define( 'LOGGED_IN_SALT',   'al/f?q1tmxVXob,f#ZP&^&H~x)_j0dzhmIf>@$EZKosUq.pw0Obki/Zym,B hYpC' );
define( 'NONCE_SALT',       '+M <[Io;c]@IY};041r4I>dMs0BFuP(.0@`(Qa]S|[Z`oy%W^4wMJ,r5Ws2NN:0^' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'yp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
