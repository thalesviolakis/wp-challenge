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
define('DB_NAME', 'vortigo-wordpress-challenge');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

if (!defined('WP_CLI')) {
    define('WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
    define('WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
}



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'AV2Rri5YQJpQKx9JU1p54ZkMl6bH15wsCWSOfTxitUdAZ2I6bbcCcke98gTNhlI1');
define('SECURE_AUTH_KEY',  'Y7Zoba8mfYZ7mZVetEfheb2uVEySAFMGwaP0MRB9mBiXgFLzxwC5bXbKcdMDsLY5');
define('LOGGED_IN_KEY',    'QTEj2hIVmJ9IlW2O1LOVHtBJ0htKS3FToytcGHej4JHCb7JuTU0vcz42EA7gImkS');
define('NONCE_KEY',        'rdeAhzJA1yLXpU2NtdpePTThSGno7AxAxziB268oJCp9mFNkNDQG2VJ7T4QMOsc2');
define('AUTH_SALT',        'ibxpI3uV5EwXCCTLyVqv0jTFVbvGWLK6ZtJ9wYyrqoieSlS8caJD0bV27ZyCnkac');
define('SECURE_AUTH_SALT', 'EqjnxQJD1ezvaQuHP9iHNIkKES9e3bDb49rVmT5r0Rwt4gZPCiZdRe8BeQb6WMjq');
define('LOGGED_IN_SALT',   'Ub59aJsILRrgppoML9vL2uYgS0q3MZx7Slxa1114SgaZZTsbdRilPcg9DoWcq3jM');
define('NONCE_SALT',       'pzyrZMUtXJsMNJaQjn0NpflDrwXu0qLO1rgwOCvECwZ6gDWujeNi65UuZpEDq7o0');

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


/** 
 *   habilitando logs 
 */

// Enable WP_DEBUG mode
define('WP_DEBUG', true);


// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', __DIR__ . '\logs\wp-errors.log');

// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', true);
@ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '\logs\wp-errors.log');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
