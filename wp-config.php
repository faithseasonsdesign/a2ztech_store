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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}


define('AUTH_KEY',         'ltFIoCIlapAnDtlrw9w5Ytrt9OZxuN/kjNdPDdLj3CMq4hp2zrk0yDq6j488TiEVUrMgxvKvGsBxA528eYg59A==');
define('SECURE_AUTH_KEY',  'M9ZS4VYRyfM7CX467HIEmaO4L6DUSXi8is+AWlWFfUTRo3yEhHsvej7t/simWzKfwC9F16AqnP3PSt/bQlj8Ww==');
define('LOGGED_IN_KEY',    'yCljhdoBZNTsLFZBc2JtTTnexKW4EV15CABypivVM2nusnmBUf62TBAfyJbvIAgj24knr5XlbISwV29z0+mf9g==');
define('NONCE_KEY',        'yBaO8UoXTvbPSkEKm55FLVY3Bd8waU0XMrEnhXag0NEK3fRYUOyVnZxZPCvZk8Mt1ROpMKahxPZBzmAllhZR8g==');
define('AUTH_SALT',        'MeWgbQ6i9zgITGJ6T8pRUsbF3ccgKvTsv+lp3vGc4fANw8xKGErpomgOV1rDEOpKeQwGCi6n5sagDHxEF8eXuA==');
define('SECURE_AUTH_SALT', '28bdUeFZX7QDwxIFgnGKVlbcpgb8DUquruCqy145EksngZuRlRrm1eHn47Vkr2MNvKxb4CRPLRqEVfpE0zKdbA==');
define('LOGGED_IN_SALT',   'YBephQT4p5tbUFM7wIkjcjPq1i48fr5th9YhUqTlI+qbq98lZ7iR0zpn+q5xfpPCFicJDNf/t/qRqsiPl4Ggog==');
define('NONCE_SALT',       'sb4Fz7LYntHAjuOEMDjVDw6Jpo/1Ryxzrpb2SMg3tMDKiRxiDMzAjGuDmsOEt0pUqB2f4qrRA7R6pgbgsQSGjg==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
