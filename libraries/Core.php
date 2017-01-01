<?php namespace Banhmi;
/**
 * Core
 *
 * This is theme core which acts as a container with extra functionalities of a WordPress theme.
 *
 * @property-read  array  $options
 * @property-read  array  $services
 */
final class Core
{
    /**
     * Version
     *
     * @var  string
     */
    const VERSION = '1.0.0';

    /**
     * Option name
     *
     * This key hold all settings which is different from theme mods.
     *
     * @var  string
     */
    const OPTION_NAME = 'banhmi_settings';

    /**
     * Site options
     *
     * If available, load and cache all autoloaded configurations.
     *
     * @var  array
     */
    private $options;

    /**
     * Services
     *
     * @var  object
     */
    private $services;

    /**
     * Constructor
     *
     * @see  Banhmi\Core::options
     */
    function __construct($options)
    {
        $this->services = new \ArrayObject;
        $this->options  = $options ? (array)$options : [];
        $this->options['basedir'] = get_template_directory() . '/';
        $this->options['baseuri'] = get_template_directory_uri() . '/';
    }

    /**
     * Getter
     *
     * A shortcut to get read-only properties
     *
     * @param  string  $name  Name of property.
     *
     * @return  array
     */
    function __get($name)
    {
        if (!isset($this->$name))
            throw new \InvalidArgumentException(__('Undefined property', 'banhmi') . ' "' . $name . '" . ');

        return $this->$name;
    }

    /**
     * Do activation
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/hooks/after_switch_theme/
     */
    function _activate($old_name)
    {
        wp_cache_add_global_groups('pages');

        add_option(self::OPTION_NAME, [
            'breadcrumb_sep'   => '&rang;',
            'numeric_paginav'  => 0,
            'paginav_mid_size' => 1
        ]);
    }

    /**
     * Do installation
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/hooks/after_setup_theme/
     */
    function _install()
    {
        $this->registerServices();

        $this->registerAssets();

        $this->registerHooks();

        $this->registerFeatures();
    }

    /**
     * Do deactivation
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/hooks/switch_theme/
     */
    function _deactivate($new_name, \WP_Theme $new_theme, \WP_Theme $old_theme)
    {
        flush_rewrite_rules(false);
    }

    /**
     * Register services
     */
    private function registerServices()
    {
        $this->services->js = wp_scripts();
        $this->services->css = wp_styles();
        $this->services->view = new Helpers\ViewFactory($this);

        if (!is_admin()) {
            $this->services['posts'] = new Helpers\PostRepository($GLOBALS['wpdb']);
        }

        do_action('register_theme_services', $this);
    }

    /**
     * Register assets
     */
    private function registerAssets()
    {
        $js_suffix  = SCRIPT_DEBUG ? '.js' : '. min.js';
        $css_suffix = SCRIPT_DEBUG ? '.css' : '. min.css';
        $assets_uri = $this->options['baseuri'] . 'assets/';

        // Set default stylesheets' version.
        $this->services->css->default_version = self::VERSION;

        // Register scripts.
        $this->services->js->add('app', $assets_uri . 'js/app' . $js_suffix, ['jquery-core'], self::VERSION, 1);
        $this->services->js->add('theme-settings', $assets_uri . 'js/theme-settings' . $js_suffix, ['jquery-core'], self::VERSION, 1);

        // Register stylesheets.
        $this->services->css->add('app', $assets_uri . 'css/app' . $css_suffix);
        $this->services->css->add('theme-settings', $assets_uri . 'css/theme-settings' . $css_suffix);
    }

    /**
     * Register hooks
     */
    private function registerHooks()
    {
        $this->commonHooks();

        if (is_admin()) {
            $this->backendHooks();
        } else {
            $this->frontendHooks();
        }
    }

    /**
     * Register features
     */
    private function registerFeatures()
    {
        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        add_theme_support('automatic-feed-links');

        add_theme_support('post-formats', ['aside', 'gallery', 'image', 'quote', 'video', 'audio']);

        add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    }

    /**
     * Common hooks
     *
     * Hooks which are fired on both back-end and front-end.
     */
    private function commonHooks()
    {
        // Disable XML-RPC service.
        // add_filter('xmlrpc_enabled', '__return_false', PHP_INT_MAX);

        // Remove X-Pingback header.
        // add_filter('pings_open', '__return_false', PHP_INT_MAX);

        // Register book custom post type.
        $m = new BackEnd\Models\BookPostType;
        $c = new BackEnd\Controllers\BookPostType($m);
        add_filter('init', [$c, 'register'], 10, 0);
        add_filter('post_updated_messages', [$c, 'notify']);

        // Register book genre taxonomy.
        $m = new BackEnd\Models\BookGenreTaxonomy;
        $c = new BackEnd\Controllers\Taxonomy($m);
        add_filter('init', [$c, 'register'], 10, 0);
    }

    /**
     * Back-end hooks
     *
     * Hooks which are fired on back-end only.
     */
    private function backendHooks()
    {
        // Enqueue stylesheet and script for theme settings page.
        add_action('admin_enqueue_scripts', array($this, '_loadBackendAssets'));

        // Add theme settings page.
        $m = new BackEnd\Models\SettingsPage($this->options);
        $v = $this->services->view->create('SettingsPage');
        $c = new BackEnd\Controllers\SettingsPage($m, $v);
        add_action('admin_menu', [$c, 'add']);
        add_action('admin_init', [$c, 'register'], 0, 0);
        add_action('admin_notices', [$c, 'notify'], 0, 0);

        // Add book meta box.
        $m = new BackEnd\Models\BookMetaBox;
        $v = $this->services->view->create('BookMetaBox');
        $c = new BackEnd\Controllers\MetaBox($m, $v);
        add_action('save_post_book', [$m, 'save']);
        add_action('add_meta_boxes_book', [$c, 'add'], 0, 0);
    }

    /**
     * Front-end hooks
     *
     * Hooks which are fire on front-end only.
     */
    private function frontendHooks()
    {
        add_filter('the_posts', [$this, '_factoryQueriedPosts'], PHP_INT_MAX, 2);

        add_filter('template_include', [$this, '_includeMasterTemplate'], PHP_INT_MAX);

        add_action('wp_enqueue_scripts', [$this, '_loadFrontendAssets'], 10, 0);

        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'wp_resource_hints', 2);
        remove_action('wp_head', 'wp_oembed_add_host_js');
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
        remove_action('template_redirect', 'rest_output_link_header', 11, 0);
    }

    /**
     * Load backend assets
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
     */
    function _loadBackendAssets($hook_suffix)
    {
        if ('toplevel_page_theme-settings' === $hook_suffix) {
            $this->services->js->enqueue('theme-settings');
            $this->services->css->enqueue('theme-settings');
        }
    }

    /**
     * Load backend assets
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
     */
    function _loadFrontendAssets()
    {
        $this->services->js->enqueue('app');
        $this->services->css->enqueue('app');
    }

    /**
     * Factory queried posts
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/hooks/the_posts/
     */
    function _factoryQueriedPosts(array $posts, \WP_Query $query)
    {
        $query->query_vars['cache_results'] = false;
        $query->query_vars['suppress_filters'] = true;

        foreach ($posts as $key => $value) {
            $posts[$key] = $this->services['posts']->create($value);
        }

        return $posts;
    }

    /**
     * Load master template
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/hooks/template_include/
     */
    function _includeMasterTemplate($template)
    {
        $query = clone $GLOBALS['wp_query'];
        $tpl = basename($template);
        $head = locate_template([
            'part-templates/head-' . $tpl,
            'part-templates/head.php']
        );
        $main = locate_template([
            'part-templates/main-' . $tpl,
            'page-templates/' . $tpl,
            $tpl]
        );
        $header = locate_template([
            'part-templates/header-' . $tpl,
            'part-templates/header.php']
        );
        $footer = locate_template([
            'part-templates/footer-' . $tpl,
            'part-templates/footer.php']
        );
        $callback = apply_filters('page_output_buffering_callback', 'Banhmi\Helpers\Html::minify', $query);

        ob_start($callback);

        include $this->options['basedir'] . 'part-templates/base.php';

        $html = ob_get_contents();

        ob_clean();

        exit($html);
    }
}
