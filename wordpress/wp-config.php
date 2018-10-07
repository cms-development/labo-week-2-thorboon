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
define('DB_NAME', 'cmsdev-db');

/** MySQL database username */
define('DB_USER', 'cmsdev-user');

/** MySQL database password */
define('DB_PASSWORD', 'cmsdev-pass');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't chnge this if in doubt. */
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
define('AUTH_KEY',         '@9/,]gi:q7u&Wf`u3uGNotEpy}qtI3Q_>JsOBOlOG=L&3mtSPWiPSh2T4Iw^n1PE');
define('SECURE_AUTH_KEY',  'U<Q/3?p[y@VrY5dI/mDi=+|C~,~#.h5dZnx}B/L~?Hy|}.K,3=zxscj@mW-B!!gl');
define('LOGGED_IN_KEY',    ')MeGiUFZZ%o}6Yd+7f!kj^2O>|iw@CWR9)^ssPTk{~wA(i8Q jY8)?.(p$?Bm ,t');
define('NONCE_KEY',        'eHnRFOLK}|R2Pm7{ycuS-Qg#ixdqRf cTx*qo0PZU,CHQDtLXqMdnD-A%u{E*V0}');
define('AUTH_SALT',        'vwm&jKo%KZ-3!Tv1zdSKp3L~Hf_c|CJ.Ejk_^<{-.e%4=a)|:Wn&$?R4+7Ui>=`9');
define('SECURE_AUTH_SALT', '>W}MDVuyzD[g5]Dt$@}~r]~3#)>27|LrTMB:kK{p7JTS;dK0>4+mlwWr=?F15jOR');
define('LOGGED_IN_SALT',   'va{Ip%h_Z,9r$7+!<U=cgo3rK3D67[&jq8vBXT$uwE*.}^EJ]`@xZ5p(3G%S-;!X');
define('NONCE_SALT',       '%8oGPH9V48{|CfD3m4bW98Tc2z4|b5:dfn d;3--MlC:5x?zbrJQJshUQxWla>^N');

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
