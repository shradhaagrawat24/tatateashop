<?php
/**
 * The base configuration for WordPress by TasteWP.com
 */

define('DB_NAME',     'wp_tatateashop');
define('DB_USER',     'wp_tatateashop');
define('DB_PASSWORD', 'h30wTZ49GyrAyuQRbJtvgkPILAfHSP7WNLS0iLoyJw4');
define('DB_HOST',     '127.0.0.1');
define('DB_CHARSET',  'utf8mb4');
define('DB_COLLATE',  '');

define('AUTH_KEY',         'zPk3XAM6okiud6P5ETWyqOGMIFXfyk1mM4oekIfdI1nuVB4Ty8n3vwuPVxF6CvpL');
define('SECURE_AUTH_KEY',  'h7emNVOcLJgcxlpjhYJn5QqLo1X68iztDTXRf62tjoS84aNOkh1MXO3mNwPH4Xta');
define('LOGGED_IN_KEY',    'XkU8N19HwVULZHgl9rXk5aJrwaXVkt1YNIJoe6ShYNv3A8Ki1llcFjTStcpz1gbU');
define('NONCE_KEY',        'fnGvLG23T8bp6HfA1qJMlt3ZN1mWGXe2W70e2rAAGvv2j6I9pgsoCh0nyZmMRSmu');
define('AUTH_SALT',        'iXRVjVzRDPLPJpDaUWlJ2V9cNkxZ7pgZ5ZESQbwsGlj0YtvFnEfJrevYaorPMSXW');
define('SECURE_AUTH_SALT', 'f02qtXW6JS6wMc8xdD89sdJnqEVlw9OKsHcVsVqh2bxyNvtiuO81Vu2931iu0YxI');
define('LOGGED_IN_SALT',   'qs5lIkH7JGFbehnhYIFluVSJXrRvxsS7mDJvl4EQjsNBp4wWF5Zj7DCGZg6wSmEW');
define('NONCE_SALT',       'zLR0F6ATJ1Ci4jBDrFe3rx0NIhe6wfIdHb8WmfAsJtD41bEiZ5srRlMpPEkwJtmj');

$table_prefix = 'wp_';

define('WP_TEMP_DIR',         '/tatateashop/wordpress/tmp');
define('WP_MEMORY_LIMIT',     '96M');
define('WP_MAX_MEMORY_LIMIT', '96M');
define('FS_METHOD', 'direct');

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', '/tatateashop/wordpress/debug.log');

define('WP_DEBUG_DISPLAY', true);
define('CONCATENATE_SCRIPTS', true);






define('WPLANG', 'en_US');

if (!defined('ABSPATH')) define('ABSPATH', __DIR__ . '/');
require_once ABSPATH . 'wp-settings.php';
