<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'newssite' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'AhEvE0<#w7slohV;{yCeC4M4?Csn|2vJgFwohhzofFVnuewSom/ jc5#5dh[0s..' );
define( 'SECURE_AUTH_KEY',  'p?iUia^[:Z]q?&*Ec~-tOMko!: ?7/J$#$i~R4[|WS[alSiJD<-Y~BC$*c@]^8n0' );
define( 'LOGGED_IN_KEY',    'j%!T]8Kw#m)1sD:$wbl0i*`LB|3qp56TV.k]w<!%)&)g<=`@<uke{x;^~V~^(.Dy' );
define( 'NONCE_KEY',        'aW`!?|qSkX#B{f5={n|Mj{X6.{Z<hta^Yth(>3%p`X=_JbcJsge.7t_Q3V(%iJe_' );
define( 'AUTH_SALT',        'qfrN(d[_dF5PF#!pZu*xhMTm@ho`t6*9q8[Vj**]o|J]kJKK_+8@L WD_hvvG68B' );
define( 'SECURE_AUTH_SALT', 'BzX|KjfC3TTEm9aB*nB:LkpS2m[r[gZS!Rmt?B2&o,h:L6x|n>pIgg3O?E)[yaw.' );
define( 'LOGGED_IN_SALT',   'sR&OF^fh}LVm+BV$Sz/Cdyc1xO.qR`=6YmB_q#`s=*V+NtaJhJ)y7dy_xYPyvr&*' );
define( 'NONCE_SALT',       'A:5O)j!nw^9(CYnojh>j[ _n&WJ6{q| ^A]Uz+-mo*h O[o;C?bGJ?Q^hf}S|`iy' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ns_';

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
