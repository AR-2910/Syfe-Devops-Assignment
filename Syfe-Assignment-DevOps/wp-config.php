<?php
define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', 'wpuser' );
define( 'DB_PASSWORD', 'wppass' );
define( 'DB_HOST', 'mysql-svc:3306' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'AUTH_KEY',         'ce52c6979bd74a8609ea10627e1cdaaf070a42a4' );
define( 'SECURE_AUTH_KEY',  'dd8cc23b3119300cb58ffd88e59e8a73e9ad9e5e' );
define( 'LOGGED_IN_KEY',    '160e7d0dd383c1ad361845646e8dcaf1258d88ff' );
define( 'NONCE_KEY',        '23ee3565a215eef4e42d89d2c68990287fa4b050' );
define( 'AUTH_SALT',        '1d6d16f99641e860c543d24d895d13b04cc2b0b3' );
define( 'SECURE_AUTH_SALT', '8079fb6bc923376485975204fc9cc4265329d52e' );
define( 'LOGGED_IN_SALT',   'fb03d8f883f54b4dc462d9ee69d3e0fdc732e115' );
define( 'NONCE_SALT',       'a767cb1b002b7d36f80e158510542d07abf3858b' );
$table_prefix = 'wp_';
define( 'WP_DEBUG', false );
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && strpos( $_SERVER['HTTP_X_FORWARDED_PROTO'], 'https' ) !== false ) {
    $_SERVER['HTTPS'] = 'on';
}
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
