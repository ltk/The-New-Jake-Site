<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

 /* Load in our environment variables */
require_once('environment/load_environment.php');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $_ENV["DB_NAME"]);

/** MySQL database username */
define('DB_USER', $_ENV["DB_USER"]);

/** MySQL database password */
define('DB_PASSWORD', $_ENV["DB_PASSWORD"]);

/** MySQL hostname */
define('DB_HOST', $_ENV["DB_HOST"]);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'M&W-ha-n2?OW[-^33<[*xvFC@hr&p|;P*TR8{o[,6-u?VKNI%Jz[uC~W;+<t{_9@');
define('SECURE_AUTH_KEY',  '-wiU4jLK{U*+;0%6&t:o09%Iw_,Y1A!VXe~<5w!y7T;7R1?ou`<Et{2L+I/lhB4$');
define('LOGGED_IN_KEY',    's[29{ce/NY0=6H>03gv@h&zYw=|;MaD$03eYn$p-9z-IUd4t4Mm4T f/Ndx;6{i(');
define('NONCE_KEY',        '+IG0q}/sx?:FDCtNT]t*&RKO+`q<L^u;(_I|~@{ojYVh%$rj)4B$yYD/MLq,!,>o');
define('AUTH_SALT',        ']~qy9%C%I+M^AdNviL.*T!MG)ZQ^[{i>@3p>GYhSpO 9 meR@F^I9o-C$1x_qwAa');
define('SECURE_AUTH_SALT', '*lI%0|4+kvk#aIG%HKq@UkVo@cuuqy=UM;{rqen~gp=+9shr@@by|6F-jg}oY])Q');
define('LOGGED_IN_SALT',   'GCfg0|aI2$W{ue&HY-2Wbv%vPS||o:?*,Lr~1bl4|kG)xMG-)}S`vr6$;+zf=OW-');
define('NONCE_SALT',       '{mWv#6Gaki+mvf+>%P@=zJUC+mdTmd07[WUxoGa>,msO3V5Tn)0{Kvcg|-a0u46=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', $_ENV["WP_DEBUG"]);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');