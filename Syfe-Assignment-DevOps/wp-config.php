<?php
define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', '<DB_USERNAME_PLACEHOLDER>' );
define( 'DB_PASSWORD', '<DB_PASSWORD_PLACEHOLDER>' );
define( 'DB_HOST', 'mysql-svc:3306' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'AUTH_KEY',         '<AUTH_KEY_PLACEHOLDER>' );
define( 'SECURE_AUTH_KEY',  '<SECURE_AUTH_KEY_PLACEHOLDER>' );
define( 'LOGGED_IN_KEY',    '<LOGGED_IN_KEY_PLACEHOLDER>' );
define( 'NONCE_KEY',        '<NONCE_KEY_PLACEHOLDER>' );
define( 'AUTH_SALT',        '<AUTH_SALT_PLACEHOLDER>' );
define( 'SECURE_AUTH_SALT', '<SECURE_AUTH_SALT_PLACEHOLDER>' );
define( 'LOGGED_IN_SALT',   '<LOGGED_IN_SALT_PLACEHOLDER>' );
define( 'NONCE_SALT',       '<NONCE_SALT_PLACEHOLDER>' );
$table_prefix = 'wp_';
define( 'WP_DEBUG', false );

if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && strpos( $_SERVER['HTTP_X_FORWARDED_PROTO'], 'https' ) !== false ) {
    $_SERVER['HTTPS'] = 'on';
}

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';

