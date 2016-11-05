<?php if ( !class_exists('Banhmi') ) :
/**
 * Banhmi
 *
 * @property-read  array  $settings
 * @property-read  array  $services
 */
final class Banhmi
{
  /**
   * Version
   */
  const VERSION = '1.0.0';

  /**
   * Option name
   */
  const OPTION_NAME = 'banhmi_theme_settings';

  /**
   * Settings
   *
   * @var  array
   */
  private $settings;

  /**
   * Helpers/Services/Extensions
   *
   * You may need a real DI container if there're many complicated dependencies to manage.
   *
   * @var  array
   */
  private $services;

  /**
   * Constructor
   */
  function __construct($settings)
  {
    $this->settings = $settings ? (array)$settings : [];
    $this->settings['basedir']  = __DIR__ . '/';
    $this->settings['baseuri']  = get_template_directory_uri() . '/';
    $this->settings['language'] = get_option('WPLANG') ? : 'en-US';
  }

  /**
   * Getter
   *
   * A shortcut to get readonly properties.
   *
   * @param  string  $name  Name of property.
   */
  function __get($name)
  {
    if ( !isset($this->$name) )
      throw new \InvalidArgumentException( __('Undefined property', 'banhmi') . ': "' . $name . '"' );

    return $this->$name;
  }

  /**
   * Do activation
   */
  function activate()
  {
    add_option(self::OPTION_NAME, [
      'breadcrumb_sep'   => '&rang;',
      'numeric_paginav'  => 0,
      'paginav_mid_size' => 1
    ]);
  }

  /**
   * Do installation
   */
  function install()
  {
    $this->registerServices();

    $this->registerAssets();

    $this->registerHooks();

    $this->registerFeatures();
  }

  /**
   * Do deactivation
   */
  function deactivate()
  {
    flush_rewrite_rules();
  }

  /**
   * Do uninstallation
   */
  static function uninstall()
  {
    // Theme uninstallation is not available yet.
  }

  /**
   * Register helpers/services/extensions
   */
  private function registerServices()
  {
    $this->services = [
      'js'   => wp_scripts(),
      'css'  => wp_styles(),
      'view' => new Banhmi\Helpers\ViewFactory($this),
    ];

    if ( !is_admin() ) {
      $this->services['posts'] = new Banhmi\Helpers\PostRepository($GLOBALS['wpdb']);
    }
  }

  /**
   * Register assets
   */
  private function registerAssets()
  {
    require $this->settings['basedir'] . 'assets/js.php';
    require $this->settings['basedir'] . 'assets/css.php';
  }

  /**
   * Register hooks
   */
  private function registerHooks()
  {
    require $this->settings['basedir'] . 'libraries/hooks.php';

    if ( is_admin() ) {
      require $this->settings['basedir'] . 'libraries/BackEnd/hooks.php';
    } else {
      require $this->settings['basedir'] . 'libraries/FrontEnd/hooks.php';
    }
  }

	/**
	 * Register features
	 */
	private function registerFeatures()
  {
		add_theme_support('title-tag');

		add_theme_support('post-thumbnails');

    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
	}
}

/**
 * Require Autoloader
 *
 * @var  resource
 */
require __DIR__ . '/libraries/Helpers/Autoloader.php';

/**
 * Register autoloading
 */
Banhmi\Helpers\Autoloader::getInstance()->register([
  ['Banhmi', __DIR__ . '/libraries']
]);

/**
 * Instantiate Banhmi
 */
$banhmi = new Banhmi( get_option(\Banhmi::OPTION_NAME) );

/**
 * Register activation hook
 */
add_action('after_switch_theme', [$banhmi, 'activate'], 0, 0);

/**
 * Register installation hook
 */
add_action('after_setup_theme', [$banhmi, 'install'], 0, 0);

/**
 * Register deactivation hook
 */
add_action('switch_theme', [$banhmi, 'deactivate'], 0, 0);

/**
 * Remove Banhmi from global space
 */
unset($banhmi);

endif;
