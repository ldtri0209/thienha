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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/thib205a/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'thib205a_data');

/** MySQL database username */
define('DB_USER', 'thib205a_admin');

/** MySQL database password */
define('DB_PASSWORD', 'P@ss2016');

/** MySQL hostname */
define('DB_HOST', 'db12.serverhosting.vn');

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
define('AUTH_KEY',         'QKsG$AVBPgS@T1|I,]}o&i>)+e>`93:zThZUc,NiEieLtX_WRY$g_$ 4<K6~U5M5');
define('SECURE_AUTH_KEY',  'lm#Ix%:@tr-b^Hj=-(>{nO<(sJqc!1MJ4rxi/+h1C6`VioTN}4wChy]=+%}$drc ');
define('LOGGED_IN_KEY',    'YDmQE(mvw]hM(]3X;YjLWW1DD<Un{9;AkEo]cVB_33PZ#|RVA5IG-QA943YLx%M,');
define('NONCE_KEY',        'I24aJ6Kjz)m`P<X838[gGt!;nbIAHRw$Mlp)-IVFDfl+{q7i*}!yLNhC{z{b7<yl');
define('AUTH_SALT',        '@0rL2DO4hS8nnX-b^89Fq9FuF7s:?LM*9?V7)sft399v)[K$15gs+V9toVd-J|SO');
define('SECURE_AUTH_SALT', ':8?gWU[(ox_UN%S!0MC^,{9Sq+51Y@F~ dxMXP{Vvx[O]iZ?%1H9QGBNU%{j^W`t');
define('LOGGED_IN_SALT',   ']Rx!;(3%O(lK?P;sbB&|&.(s$=[R$Ef*_EP3H hh(BTGKUMr>8|o]r3TzbE_2,)%');
define('NONCE_SALT',       ':wI*lDxHh;v4_YTCTQTXWDT!.lpl7lc$e9)wz%bN/#ru4{~!RLQlK?&v;?,,/7T&');

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
