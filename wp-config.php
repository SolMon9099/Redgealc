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
define( 'DB_NAME', 'redgealp_dbwpdemo' );

/** Database username */
define( 'DB_USER', 'redgealp_demouser' );

/** Database password */
define( 'DB_PASSWORD', 'l[K2GEq]QVJycoeQG!' );

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
define( 'AUTH_KEY',         '|z*:]aPgjy&]i6v2BfW}8_kLLoBH:?orOuDE>`.)pg4v_Xm_mroc?l9X7zYnGDO)' );
define( 'SECURE_AUTH_KEY',  'anK@eq-#h8G&wG7cd*@:h2qV&LL8l3H1Xekr:KSsoEL3HEQV0;2/$R+xyJXOi,yl' );
define( 'LOGGED_IN_KEY',    'Y}TTuonMd)ca[`PVA< RPc*87`!MkAY* wc.=zmSFBJ*gG1M O,nr7qu@o*gGlL?' );
define( 'NONCE_KEY',        '%vifmOmD~5v[40M4+;Mzq^}iswQ9?2XT*.5TcJ^]GGM.7$]Hi*qJ0qS:2H?;1*u&' );
define( 'AUTH_SALT',        ' Y{W!TB<bkQ>;8%$%w{J.TGcjd:TNB?)&,a&BylrOGlW73IhR>;V)xRd|=e<Nd9=' );
define( 'SECURE_AUTH_SALT', ' Zd<$[BF< #5MjWzQ?bOOxkqv8I$trstB*gA6(Nf<)M&UTl)kpkf-<)k+f[bAj-=' );
define( 'LOGGED_IN_SALT',   'C7_(;qw6ps&Ar6~xLwkLV*ot^8OA`Bs+#Y#{fUV&U`{yGbQE2j;N+ZB!AEAI$/Ci' );
define( 'NONCE_SALT',       '/hmSgh)A_Ansr[WD)Z[Y?~luL5C3NXR[3:K<x0**@0vs7IR h!X,OW@]4SkB2,!)' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'rgmd_';

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
define( 'WP_DEBUG_LOG', true );
// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', true );

/* Add any custom values between this line and the "stop editing" line. */

define('WP_SITEURL','https://'.$_SERVER['HTTP_HOST']);
define('WP_HOME','https://'.$_SERVER['HTTP_HOST']);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
