<?php
/**
 * Main plugin class file.
 *
 */

if (!defined("ABSPATH")) {
    exit();
}

/**
 * Main plugin class.
 */
class MfMembersSiteMap
{
    /**
     * The single instance of MfMembersSiteMap.
     *
     * @var     object
     * @access  private
     * @since   1.0.0
     */
    private static $_instance = null; //phpcs:ignore

    /**
     * Local instance of MfMembersSiteMap_Admin_API
     *
     * @var MfMembersSiteMap_Admin_API|null
     */
    public $admin = null;

    /**
     * Settings class object
     *
     * @var     object
     * @access  public
     * @since   1.0.0
     */
    public $settings = null;

    /**
     * The version number.
     *
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $_version; //phpcs:ignore

    /**
     * The token.
     *
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $_token; //phpcs:ignore

    /**
     * The main plugin file.
     *
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $file;

    /**
     * The main plugin directory.
     *
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $dir;

    /**
     * Constructor funtion.
     *
     * @param string $file File constructor.
     * @param string $version Plugin version.
     */
    public function __construct($file = "", $version = "1.0.0")
    {
        $this->_version = $version;
        $this->_token = "MfMembersSiteMap";

        // Load plugin environment variables.
        $this->file = $file;
        $this->dir = dirname($this->file);

        add_action("wp_sitemaps_init", [$this, "handleSitemapsInit"]);
    } // End __construct ()

    /**
     * Main MfMembersSiteMap Instance
     *
     * Ensures only one instance of MfMembersSiteMap is loaded or can be loaded.
     *
     * @param string $file File instance.
     * @param string $version Version parameter.
     *
     * @return Object MfMembersSiteMap instance
     * @see MfMembersSiteMap()
     * @since 1.0.0
     * @static
     */
    public static function instance($file = "", $version = "1.0.0")
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($file, $version);
        }

        return self::$_instance;
    } // End instance ()

    public function handleSitemapsInit(WP_Sitemaps $wp_sitemaps)
    {
        $providerAdded = wp_register_sitemap_provider(
            "members",
            new MF_Sitemaps_Members()
        );
    }

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public function __clone()
    {
        _doing_it_wrong(
            __FUNCTION__,
            esc_html(__("Cloning of MfMembersSiteMap is forbidden")),
            esc_attr($this->_version)
        );
    } // End __clone ()

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public function __wakeup()
    {
        _doing_it_wrong(
            __FUNCTION__,
            esc_html(
                __("Unserializing instances of MfMembersSiteMap is forbidden")
            ),
            esc_attr($this->_version)
        );
    } // End __wakeup ()
}
