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
define( 'DB_NAME', 'chep' );

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
define( 'AUTH_KEY',         'lj%,&H]>9=B%-Pkw{*GGHV6>!Wy ^5x4#ow 4~ED}e1qLrIlHt!tFI;6BZ$Vi~4~' );
define( 'SECURE_AUTH_KEY',  '3[U,(Q`}/MUXC97+k.r]!RW`KeqG$>^-/O @w&A%mwdX%X`]PF[[Oy+@l!&ZPRpf' );
define( 'LOGGED_IN_KEY',    'Ei$8f|IiQzF;O?V>.d KG |PXI#sD>o4Zn2=yHMNg[V]f%4g$g0G}?7}^z}Lr/FQ' );
define( 'NONCE_KEY',        'F{QS*eL O$I&ws^KOZI#vqp*/=r6ChKD4#mj<|@%^}P_ 0wUKO@YCpvf8RW8ZUv[' );
define( 'AUTH_SALT',        'vf#}4sHd|-<wmElnT|o3YBNe/@/<{!YbfXhPDXsr:wY*MgP+&GJAbJcLctIrdR|!' );
define( 'SECURE_AUTH_SALT', 'p)6I7dE^!#>OblL>{ dg#,~9|vnxQ~-,K;tZjX)G]ajPp1Cs{iS-|uXG0lwof=L[' );
define( 'LOGGED_IN_SALT',   ';ow`gbT1;MFGef=Lxm2gqvPI2J.cGM,z5w5o(`HsOwXGjTeBgHnY_-={dqG]L~gl' );
define( 'NONCE_SALT',       'O4F,+(CxUKRbL:E<[.42,xL;v[VG<YSyj9gY+>EJ99~a/GT/ spk,^pfYz]1@,b&' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
