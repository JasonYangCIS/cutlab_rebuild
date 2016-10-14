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
define('DB_NAME', 'cutlab');

/** MySQL database username */
define('DB_USER', 'cutlab');

/** MySQL database password */
define('DB_PASSWORD', 'cutlab');

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
define('AUTH_KEY',         'xQ|d&]O=bu~=r,Xyt8TE+IQB_bU%id hUY,A;t_O9P&S%pQj>GKwM/>0e`/`1/J*');
define('SECURE_AUTH_KEY',  '_H_3LGVSzCG3*(2sD#6(>|)]xPGeic3V=nxf44I}#MT:c9^qTr!7zOaph3AHl5Uy');
define('LOGGED_IN_KEY',    '6>%hZLL$( g2Lgi[T%@CuZnXM{a=qw8Mkc2wCIoO:e&lN(k=?2,uKN?hMps4HYT;');
define('NONCE_KEY',        ' olqn}+]Q?a)`|ZvN]xVjhoTs#+o}[BqvV9Bk/bDd+><o.(K{hSp-2PKK}IJwpfx');
define('AUTH_SALT',        'UDu1R_Ak-|iC,OE/r@X@,ZA@vx{6Embh[.{zb+>2y X*7J:Yu*uFId$y >7WM(e~');
define('SECURE_AUTH_SALT', 'A7rudc;!CdsS@GLCBdRv6CdcipD!/t[|M+i-l+/4hSnowegFrHF?obX55jewS%6#');
define('LOGGED_IN_SALT',   'ol({Q~N58<Hm922~rA0$K5#as9/-O*ppl12`yMtBD!OHQ_AwI92Y.xPj5DNgg>,3');
define('NONCE_SALT',       '|V&?buAB5)iBHIIA+Y{YYXr<v{&-@m$fRN2$ #M3SdOow/]. YE18EL<k&8dMD{R');

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
