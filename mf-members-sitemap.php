<?php
/**
 * Plugin Name: MorrisFed Members Sitemap
 * Version: 0.0.1
 * Plugin URI: https://www.morrisfed.org.uk/
 * Description: Generates sitemap entries for the TeamFinder pages related to Morris Federation members.
 * Author: Daniel Watford
 * Author URI: https://watfordconsulting.com
 * Requires at least: 5.8
 * Tested up to: 5.8
 */

if (!defined("ABSPATH")) {
    exit();
}

// Load plugin class files.
require_once "includes/class-mf-members-sitemap.php";
require_once "includes/class-mf-members-sitemap-provider.php";

/**
 * Returns the main instance of MfMembersSiteMap to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object mf-members-sitemap
 */
function mfMembersSiteMap()
{
    $instance = MfMembersSiteMap::instance(__FILE__, "1.0.0");
    return $instance;
}

mfMembersSiteMap();
