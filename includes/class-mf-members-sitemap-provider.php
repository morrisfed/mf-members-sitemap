<?php
/**
 * Sitemaps: MF_Sitemaps_Members class
 *
 * Builds the sitemaps for the 'member' object type.
 *
 */

/**
 * Member XML sitemap provider.
 */
class MF_Sitemaps_Members extends WP_Sitemaps_Provider
{
    public function __construct()
    {
        $this->name = "members";
        $this->object_type = "member";
    }

    /**
     * Gets a URL list for a member sitemap.
     *
     * @param int    $page_num       Page of results.
     * @param string $object_subtype Optional. Not applicable for Users but
     *                               required for compatibility with the parent
     *                               provider class. Default empty.
     * @return array Array of URLs for a sitemap.
     */
    public function get_url_list($page_num, $object_subtype = "")
    {
        $args = $this->get_members_query_args();
        $args["paged"] = $page_num;

        $query = new WP_User_Query($args);
        $users = $query->get_results();
        $url_list = [];

        foreach ($users as $user) {
            $sitemap_entry = [
                "loc" => home_url(
                    "/teamfinder/#!biz/id/" . $user->data->user_login
                ),
            ];

            $url_list[] = $sitemap_entry;
        }

        return $url_list;
    }

    /**
     * Gets the max number of pages available for the object type.
     *
     * @see WP_Sitemaps_Provider::max_num_pages
     *
     * @param string $object_subtype Optional. Not applicable for Members but
     *                               required for compatibility with the parent
     *                               provider class. Default empty.
     * @return int Total page count.
     */
    public function get_max_num_pages($object_subtype = "")
    {
        return 1;
    }

    /**
     * Returns the query args for retrieving members to list in the sitemap.
     *
     * @return array Array of WP_User_Query arguments.
     */
    protected function get_members_query_args()
    {
        $args = [
            "role" => "Subscriber",
            "number" => wp_sitemaps_get_max_urls($this->object_type),
        ];

        return $args;
    }
}
