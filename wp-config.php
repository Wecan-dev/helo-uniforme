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
define( 'DB_NAME', 'helo_uniforme' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

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
define( 'AUTH_KEY',         'g(H~F`0ygux%td=?UxtVMg$HL Gu^{q#>L!pE7/iJ7?bKLxck!^j%qwm7P5w&Ex(' );
define( 'SECURE_AUTH_KEY',  'nurG[(IQls5b49LKt#7?C5+up;rTxJFd`Adhwyw0e#F3qIz9s5m3zI>yUXCC=BXX' );
define( 'LOGGED_IN_KEY',    '5kyKiKbzH<#DZh |vwfB$&j4K._=L0~Buh[_)v (}F=t](28j&T=q5/d?m^*$+9x' );
define( 'NONCE_KEY',        'hd+jdUU`5[<xUBIAZ:+D>X!?S<~!u(s>yd4x[H2-zFQNO~ES$)OOu9BMqUbi))M?' );
define( 'AUTH_SALT',        'n8(NcS{c: L* }<M}~okhjFJHZVUtsG~T5a_t1B5ABRUrI^u0F1]UC0]C>:UIv4D' );
define( 'SECURE_AUTH_SALT', 'w?VPiXN|NvUCBGX[|EQC5#J8#S;C:F*>e/Vt121,A~.l(7ZU_,-y*IRk[}(]sZYt' );
define( 'LOGGED_IN_SALT',   'y$qYD^zRxXOrtRV#J(<`$IroHZH4W+Lo.>}+y6*Mpv%Iy/<L~cI#6_)RXI!_J.mj' );
define( 'NONCE_SALT',       '$T=5e84Sl=|2AT#>?HRc2TF9cC %Vy1oR*g8J2//r?JFf .Gs_w0{om*Vxw3I?ld' );

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
define('FS_METHOD', 'direct');
