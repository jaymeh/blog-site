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
define( 'AUTH_KEY',         'ty/uG-*37~A:jST<>z,vpP-`m?1nmDiH.YB~VcB6uT<z|e(4;G]OLQ;ml.YlrL0R' );
define( 'SECURE_AUTH_KEY',  'l-BTRnoQJ~-|DB7R$d{Ik0176WBQlgI)8DguWMB:Yt?~8j2F?zW;8o <5ElSZuDO' );
define( 'LOGGED_IN_KEY',    '!d5R,{_sXQUwn</b]4p|Ty@7-D^OsxZ^Coa6:D<#Vo2Y.]Z8;($^h|y)K-u@s=^!' );
define( 'NONCE_KEY',        'NH~U@MLVlPMqQbRMfKy}O)oPZ4cPjC4oxR5[2P1G85os^s%g|E|A*h.Ca0Co=@11' );
define( 'AUTH_SALT',        'QSIJBM|z`#-&%mT&*0W 5yZqj9? nw{3vwYl+u@eCA*,k%}PBqG@e7ndr3bGrjz/' );
define( 'SECURE_AUTH_SALT', '/xFHgZ/9li;pU2tZLwAAfIg&N`A_};1O$]2C)_c^0j+wlo/Rr;alzuL=eZ0T:i-i' );
define( 'LOGGED_IN_SALT',   'Xv$PU#Ue-31dN?Amw_z#,hp!gE!vM8;fOhsCMAs9Bw=mQNZ)@gM_rFrLB2*q|SB_' );
define( 'NONCE_SALT',       ')fIrq{fdcB^dR]Yqi%#%?pC;6dvFr^.Bk5]I)=D&ykY@pB1Dpi1<WtMq#>nDfEWC' );

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
