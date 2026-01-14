<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_netiapps2026' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'passworD@123' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9Ju?-z]7kKFmHG4-U6vr1bK|?|OSUY?8<K8msb}&Pld{:shRi.7]5;( 1`},%<0W' );
define( 'SECURE_AUTH_KEY',  'L9+)c1.K>+6D6(;IlQ{{?Zj]eHG?9s18z!+/_J(YHbHI6 Xj_6nC7Uyo@z$-$iHX' );
define( 'LOGGED_IN_KEY',    'm8ud4`4rp)nH2+sq]EeR: E76kCtG#w?gs,2mXuCSc}<g,Q)di:]z9F~abZJE~Z`' );
define( 'NONCE_KEY',        'D]3nqo_L.;hUsAQc^/ar3d(+/,fTU9Tm`s([su=_,HT0.4[/k0N>AIS|fDly=+9B' );
define( 'AUTH_SALT',        'qWm34#+z/|Fyt.(UXcqe=sE,g(K]:R72fwe@61cQ%>W`gO`pGaYLV];CfJ;6si&n' );
define( 'SECURE_AUTH_SALT', 'u@.oR7?>L;IpYy1MOI,5Z=Og0z}iD:])YQR[i@}ij!&}:|OnthlIHV>sUNss~3Yw' );
define( 'LOGGED_IN_SALT',   'ZS,E_ER}0q}x&wByI|[2f %H0(uNr/^raS|TG*hJ;#RXdwPs>.aU5Z$tIghj)d}]' );
define( 'NONCE_SALT',       '5Lfl4w/#)99w=w32Orz*)R,M2 P&wCnnWu9wK):Hj|S@T=.$Uez$a]FwZTWqT28n' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

define('FS_METHOD','direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
