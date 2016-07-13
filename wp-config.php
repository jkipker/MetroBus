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
define('DB_NAME', 'metrobus-dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'yOZKpX@9cFG1e*g]_l_)8BXzM/aq4DcSCr/q-;/COGJS|451wpC_`R<@c<>MngXU');
define('SECURE_AUTH_KEY',  'M)b!_04X=^=G=?ymL1*+yReY2~8Jo*(EfRyV-c)_Z2=va-0MM|/0$p2F!jo^niUa');
define('LOGGED_IN_KEY',    '-niCp R_tCgmqsyLI&;]<4LV}=T4U>zg!RMm(Z#StX!<Q70aFhfn,H1:Q0#E/{K=');
define('NONCE_KEY',        'Xz;%fkaw0W0EOKRerPo8B;0yxD>9Z/^Q$Fq1t8JLA3B}E#|@i/JL$W%KN{1[)O`8');
define('AUTH_SALT',        'xg`2#//b}&?@{kjzXLHhkXJsWFg68d,dMp_vf|)0#?)Vi&+f@et~P#Q|9ZlFWqj?');
define('SECURE_AUTH_SALT', '1L$gG]-r<;3OUU,F(E*=,#a(*fx1f1IL/}za HYG Z-Xp2u<`@wdxwQt:a*|( Cf');
define('LOGGED_IN_SALT',   '}Gbve `>fVF+ *RPNPcn560Ux*g(]jO`hZLLUN>%}nyPmv^ C,K/d.D>uI9=Z4?x');
define('NONCE_SALT',       '.Mp,ON6T`!LCIB!3sI$`Fx@*<,F^2a~Tm7g:`=h-~MT 3(p5DBsct?YN57EX:]I~');

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
