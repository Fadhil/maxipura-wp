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
define('DB_NAME', 'maxipura');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'D4/&jy=dw}XNjFo8e#.Vok@[Il+_&)?NfszA3]o90xV7$p a;]W8k>UC/p@P*vLp');
define('SECURE_AUTH_KEY',  'SpFrt%r]DDJzfjA^9b?}1F1Z9#3fQ_[^i5u@JMU]SB:]w3{U>%*^T$Ut4%Ixf~`Y');
define('LOGGED_IN_KEY',    '0xKL]EUC%CC;?<N(nt1/{r,QO4L>E{uGRYT-c+.CU*bTB>NB$)k-f7oF5_VZ7[=C');
define('NONCE_KEY',        'FDZ#TJSB5D$wC)OeXF1#=**R=T4%br]*BWGd#2NB*FmV0|U ~-S_G+K5j>`uwGHJ');
define('AUTH_SALT',        '6 B)XFD M_6+n&{9%@k=~eu5cu.(=~p+Q^v`U=$PXmj]f;r<uI@4TEoMD(oW^ARk');
define('SECURE_AUTH_SALT', 'Y B9e_y=v)1^9mw7c4f,ZERLo^|8_!z:!Uhy1+k|Gt&g2*oTjp{e7h10J>Dk#p<4');
define('LOGGED_IN_SALT',   'oK!ZX+^~6O[*)spzUx ^vY1[b0v+,S7}C5vp`84X^4U=3mi{-Q>`OTCR_#::k1i&');
define('NONCE_SALT',       'NDz|geM6{s$pFB/?FWVeTVJ;V#ybO$5mn%wNdC=?/$[-3.@5oEbx=V.Kv6C9WI$}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mp_';

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

