<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://enesnet.de
 * @since      1.0.0
 *
 * @package    Caldav_List
 * @subpackage Caldav_List/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Caldav_List
 * @subpackage Caldav_List/public
 * @author     Oliver Enes <oliver@enesnet.de>
 */

require_once __DIR__ . '/../lib/get-events.php';


class Caldav_List_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;


    /**
     * Render function for [caldavlist] code
     * @return string
     */

    public function render()
    {
        try {
            $caldav_list_einstellungen_options = get_option('caldav_list_einstellungen_option_name'); // Array of All Options
            $caldav_url_0 = $caldav_list_einstellungen_options['caldav_url_0']; // Caldav-URL
            $username_1 = $caldav_list_einstellungen_options['username_1']; // Username
            $password_2 = $caldav_list_einstellungen_options['password_2']; // Password
            $calendar_3 = $caldav_list_einstellungen_options['calendar_3']; // calender
            $filter_4 = $caldav_list_einstellungen_options['filter_4']; // filter
            $heading_5 = $caldav_list_einstellungen_options['heading_5'];
            $ignored_categories_6 = $caldav_list_einstellungen_options['ignored_categories_6']; // ignored categories
            $include_events_with_no_category_7 = $caldav_list_einstellungen_options['include_events_with_no_category_7']; // show events without categories ind filtered list

            $include_events_with_no_category = $include_events_with_no_category_7 === '1' ? true : false;

            $ignored_categories = [];
            if (!empty(trim($ignored_categories_6))) {
                $ignored_categories = array_map('trim', explode(',', $ignored_categories_6));
            }

            $events = getEvents($caldav_url_0, $username_1, $password_2, $calendar_3);

            $events = array_filter($events, function ($event) use ($ignored_categories) {
                $categories = $event['VCALENDAR']['VEVENT']['CATEGORIES'];
                if (is_array($categories)) {
                    foreach ($categories as $cat) {
                        if (in_array($cat, $ignored_categories)) {
                            return false;
                        }
                    }
                } else {
                    if (in_array($categories, $ignored_categories)) {
                        return false;
                    }
                }
                return true;
            });

            $events = array_filter($events, function ($event) {
                if (!empty($event['CLASS']) && $event['CLASS'] == 'PRIVATE') {
                    return false;
                }
                return true;
            });

            $events = array_values($events);

            $json_events = json_encode($events, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_LINE_TERMINATORS);

            $payload = [
                "filters" => $filter_4,
                "events" => $json_events,
                "heading" => $heading_5,
                "includeEventsWithNoCategory" => $include_events_with_no_category,
            ];

            return "<div id='caldavroot' data-data='" . base64_encode(json_encode($payload)) . "'></div>";
        } catch (Exception $e) {
            return "<div id='caldavroot' data-data='" . base64_encode(json_encode(['error' => $e->getMessage()])) . "'></div>";
        }
    }

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @return string
     * @throws Exception
     * @since    1.0.0
     */

    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_shortcode('caldavlist', array($this, 'render'));

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Caldav_List_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Caldav_List_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/caldav-list-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Caldav_List_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Caldav_List_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . '../dist/caldavlist.js', array('jquery'), $this->version, true);

    }
}
