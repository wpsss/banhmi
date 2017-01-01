<?php
/**
 * Load Autoloader
 *
 * @var  resource
 */
require __DIR__ . '/libraries/Helpers/Autoloader.php';

/**
 * Register autoloading
 *
 * @see  Banhmi\Helpers\Autoloader::register
 */
Banhmi\Helpers\Autoloader::getInstance()->register([
    ['Banhmi', __DIR__ . '/libraries']
]);

/**
 * Get an instance of Banhmi Core
 *
 * @use  get_option()  To retrieve custom theme options from options table.
 */
$banhmi = new Banhmi\Core(get_option(Banhmi\Core::OPTION_NAME));

/**
 * Register activation hook
 *
 * @see  https://developer.wordpress.org/reference/hooks/after_switch_theme/
 */
add_action('after_switch_theme', [$banhmi, '_activate'], 0, 1);

/**
 * Register installation hook
 *
 * @see  https://developer.wordpress.org/reference/hooks/after_setup_theme/
 */
add_action('after_setup_theme', [$banhmi, '_install'], 0, 0);

/**
 * Register deactivation hook
 *
 * @see  https://developer.wordpress.org/reference/hooks/switch_theme/
 */
add_action('switch_theme', [$banhmi, '_deactivate'], 0, 3);

/**
 * Remove Banhmi Core from global space
 */
unset($banhmi);
