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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', '1mm4cul473');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'D{a`)+d3~T/:yAkg?R(EqpE,6~6N_&82%iKmoQQ73R6xw?VIaMvy[*2ZslAHln54');
define('SECURE_AUTH_KEY',  'wm:Of>e}qWg^K^5|!1P{R*Msdqq/7jNq9GlsLAHW_t5,[R9UZ L.^(.Cg7UtbC~]');
define('LOGGED_IN_KEY',    '?I)Kz;JLmw({<J+kb/&`0,_t!)]GPs{EQhY%W.e9}>LXT$pd/[n0/{:pD:?8X=3)');
define('NONCE_KEY',        'Yu3dB[27}hpp {r?djY[o&D*oZ2+I3jptQ+r9r/ElVqb@SZ~m;?WS$A~O)c_V#-+');
define('AUTH_SALT',        '**jYLpUccZ<@1&OL9hKAEN2}}M&$Yf~>y9O3UiW*zjSG<q_yx^6/J2gJ}ANZ)y(<');
define('SECURE_AUTH_SALT', 'HdY6c:1a=-K8x0oj8^/OwA&vj7cN[93la:Z]f?IfE)hJpe7h4Sw&/KZu_3k~iSO1');
define('LOGGED_IN_SALT',   'MZc Im_TytocC%<`|@(]}RtPqz)%%rL0`J@o&r7#zH!2duRU?QHnEjE8))S$0_bW');
define('NONCE_SALT',       'd59Q%Y*A>3./VA#dLs]JK@fzTo!+}]j]7bAxo:wuU7dQbkd&.ozmHl9Gi4~?Sbl>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
