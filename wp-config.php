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
define( 'DB_NAME', 'blog_jaymeh' );

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
define('AUTH_KEY',         '#j-2Rxaq!Fik <T(pQjWm$g7#Z0vmAZdO!wm@&?V/neu!920fRA~;&J>CH|V)_|n');
define('SECURE_AUTH_KEY',  '6p3-t5]Lx2,pN-?03(AUCULHG#Eq7k49_Tpo9w:DGoKAR[w3MgzfRP@)5P6opHCN');
define('LOGGED_IN_KEY',    'Nt^t@z)NipE,g7j&)w.iwh2p(rF{)f.9]KX@CHlumyNXMPJ#I JHT?*>IK Hd4Ck');
define('NONCE_KEY',        '?0IwP*w~}>G5:o%l+/JV2]H,r)RFJ`id[s{llD_1QxHr1R<O<]^y[9+@)A-lJ+_!');
define('AUTH_SALT',        'Zk_Gxr*R{EOC^,8jV_8V{^23Zz<I9dYwD~A <z_s9`$8|.J6#tF3EgU/h&/FIC&w');
define('SECURE_AUTH_SALT', '|UT#[SBiwW!qsTaLk*5H(E$4nzg<D:.$CdW +m!XJ:A2E=Nt4*21=Fu8$uB$+X7t');
define('LOGGED_IN_SALT',   '>-Ox_f6_MO(jU,Vz aP9aoS&E:.gD;Y$2|:dSzpvjX9I_i]6[G*=<J.Udk<lUZ%5');
define('NONCE_SALT',       '7+Yhb2i]@O6&0yxP^n~0D6m$-F=K$JlgYe<j!y~90Mxt|WZ`Mi{<Lr&.08<jXRzf');

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
