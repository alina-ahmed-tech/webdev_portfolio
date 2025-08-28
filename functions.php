<?php
/**
 * Theme bootstrap
 *
 * @package devfolio
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Define constants.
define( 'DEVFOLIO_VERSION', '1.0.0' );
define( 'DEVFOLIO_DIR', trailingslashit( get_template_directory() ) );
define( 'DEVFOLIO_URI', trailingslashit( get_template_directory_uri() ) );

// Autoload includes.
require_once DEVFOLIO_DIR . 'inc/setup.php';
require_once DEVFOLIO_DIR . 'inc/custom-post-types.php';
require_once DEVFOLIO_DIR . 'inc/acf-fields.php';
require_once DEVFOLIO_DIR . 'inc/template-tags.php';
require_once DEVFOLIO_DIR . 'inc/demo-content.php';
