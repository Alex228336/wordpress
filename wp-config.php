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
define( 'DB_NAME', 'shop' );

/** Database username */
define( 'DB_USER', 'ALEX' );

/** Database password */
define( 'DB_PASSWORD', '020408' );

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
define( 'AUTH_KEY',         'oXV5FE8Ant*C3#aj_I^<Xek= 4Qp1_Esj4 I$.g^()9Dc75||OlzC~YBG:w _vc3' );
define( 'SECURE_AUTH_KEY',  'Bg2=0N0M*n7<8H!8ivz]{vYuUoUTn3cp ;%/1{-}=:k#[&vW 5Tmr*@jcf^sf@P-' );
define( 'LOGGED_IN_KEY',    'dcp<lM%UH:X0eNo%A)T2[zNqeV^h}pn4Y4e{RrmvLj3?5uqg9GP?*MaR@ pN)ss/' );
define( 'NONCE_KEY',        'gFMv|E;~/NWq!+;q/YwP{~)x/~mi#bmY;=YQc|.}k-cZ;PT_xikA,`MWZ$`iX_C/' );
define( 'AUTH_SALT',        '<5/@?tq_[;2(8Po{g[<7+A;uRp@B&$Olo&BwOW7_sXF0>`HkH=.=5xeXXe`UR`{r' );
define( 'SECURE_AUTH_SALT', 'B}hp~]2Ub[S7S/b(:l*V!y2TJ?` |0P=T.ifKno,LzVfAt4rqp4Q^xEQMwBQ+D7+' );
define( 'LOGGED_IN_SALT',   '6X6+O~0cw]yo>QfOnV|a-(#}g?Ri*r[!dRFR64alK?.oD(Xi/QFnxR;,emO(LF1|' );
define( 'NONCE_SALT',       'y$R6wAEF2|-tY8f)p*HMZW6Q mxd)TBBdrPt7u b#: C|,>p>y!5<4?98$hKF]Rf' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
