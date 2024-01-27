<?php
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class CaldavListEinstellungen
{
    private $caldav_list_einstellungen_options;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'caldav_list_einstellungen_add_plugin_page'));
        add_action('admin_init', array($this, 'caldav_list_einstellungen_page_init'));
    }

    public function caldav_list_einstellungen_add_plugin_page()
    {
        add_options_page(
            'caldavlist', // page_title
            'caldavlist', // menu_title
            'manage_options', // capability
            'caldav-list-einstellungen', // menu_slug
            array($this, 'caldav_list_einstellungen_create_admin_page') // function
        );
    }

    public function caldav_list_einstellungen_create_admin_page()
    {
        $this->caldav_list_einstellungen_options = get_option('caldav_list_einstellungen_option_name'); ?>

        <div class="wrap">
            <h2>caldavlist Einstellungen</h2>
            <p>Hier können die caldav-Serverinformationen eingetragen werden. [caldavlist] kann in einer beliebigen
                Seite benutzt werden, um die Liste anzuzeigen.</p>
            <?php settings_errors(); ?>

            <form method="post" action="options.php">
                <?php
                settings_fields('caldav_list_einstellungen_option_group');
                do_settings_sections('caldav-list-einstellungen-admin');
                submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function caldav_list_einstellungen_page_init()
    {
        register_setting(
            'caldav_list_einstellungen_option_group', // option_group
            'caldav_list_einstellungen_option_name', // option_name
            array($this, 'caldav_list_einstellungen_sanitize') // sanitize_callback
        );

        add_settings_section(
            'caldav_list_einstellungen_setting_section', // id
            '', // title
            array($this, 'caldav_list_einstellungen_section_info'), // callback
            'caldav-list-einstellungen-admin' // page
        );

        add_settings_field(
            'caldav_url_0', // id
            'Caldav-URL', // title
            array($this, 'caldav_url_0_callback'), // callback
            'caldav-list-einstellungen-admin', // page
            'caldav_list_einstellungen_setting_section' // section
        );

        add_settings_field(
            'username_1', // id
            'Username', // title
            array($this, 'username_1_callback'), // callback
            'caldav-list-einstellungen-admin', // page
            'caldav_list_einstellungen_setting_section' // section
        );

        add_settings_field(
            'password_2', // id
            'Password', // title
            array($this, 'password_2_callback'), // callback
            'caldav-list-einstellungen-admin', // page
            'caldav_list_einstellungen_setting_section' // section
        );

        add_settings_field(
            'calendar_3', // id
            'calendar', // title
            array($this, 'calendar_3_callback'), // callback
            'caldav-list-einstellungen-admin', // page
            'caldav_list_einstellungen_setting_section' // section
        );

        add_settings_field(
            'heading_5', // id
            'Titel', // title
            array($this, 'heading_5_callback'), // callback
            'caldav-list-einstellungen-admin', // page
            'caldav_list_einstellungen_setting_section' // section
        );

        add_settings_field(
            'filter_4', // id
            'Filter Buttons', // title
            array($this, 'filter_4_callback'), // callback
            'caldav-list-einstellungen-admin', // page
            'caldav_list_einstellungen_setting_section' // section
        );

        add_settings_field(
            'ignored_categories_6', // id
            'Ignorierte Kategorien', // title
            array($this, 'ignored_categories_6_callback'), // callback
            'caldav-list-einstellungen-admin', // page
            'caldav_list_einstellungen_setting_section' // section
        );

        add_settings_field(
            'include_events_with_no_category_7', // id
            'Termine ohne Kategorie in der gefilterten Überischt anzeigen', // title
            array($this, 'include_events_with_no_category_7_callback'), // callback
            'caldav-list-einstellungen-admin', // page
            'caldav_list_einstellungen_setting_section' // section
        );
    }

    public function caldav_list_einstellungen_sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['caldav_url_0'])) {
            $sanitary_values['caldav_url_0'] = sanitize_text_field($input['caldav_url_0']);
        }

        if (isset($input['username_1'])) {
            $sanitary_values['username_1'] = sanitize_text_field($input['username_1']);
        }

        if (isset($input['password_2'])) {
            $sanitary_values['password_2'] = sanitize_text_field($input['password_2']);
        }

        if (isset($input['calendar_3'])) {
            $sanitary_values['calendar_3'] = sanitize_text_field($input['calendar_3']);
        }

        if (isset($input['filter_4'])) {
            $sanitary_values['filter_4'] = sanitize_textarea_field($input['filter_4']);
        }

        if (isset($input['heading_5'])) {
            $sanitary_values['heading_5'] = sanitize_textarea_field($input['heading_5']);
        }

        if (isset($input['ignored_categories_6'])) {
            $sanitary_values['ignored_categories_6'] = sanitize_textarea_field($input['ignored_categories_6']);
        }

        if (isset($input['include_events_with_no_category_7'])) {
            $sanitary_values['include_events_with_no_category_7'] = sanitize_textarea_field($input['include_events_with_no_category_7']);
        }

        return $sanitary_values;
    }

    public function caldav_list_einstellungen_section_info()
    {

    }

    public function caldav_url_0_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="caldav_list_einstellungen_option_name[caldav_url_0]" id="caldav_url_0" value="%s">',
            isset($this->caldav_list_einstellungen_options['caldav_url_0']) ? esc_attr($this->caldav_list_einstellungen_options['caldav_url_0']) : ''
        );
    }

    public function username_1_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="caldav_list_einstellungen_option_name[username_1]" id="username_1" value="%s">',
            isset($this->caldav_list_einstellungen_options['username_1']) ? esc_attr($this->caldav_list_einstellungen_options['username_1']) : ''
        );
    }

    public function password_2_callback()
    {
        printf(
            '<input class="regular-text" type="password" name="caldav_list_einstellungen_option_name[password_2]" id="password_2" value="%s">',
            isset($this->caldav_list_einstellungen_options['password_2']) ? esc_attr($this->caldav_list_einstellungen_options['password_2']) : ''
        );
    }

    public function calendar_3_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="caldav_list_einstellungen_option_name[calendar_3]" id="calendar_3" value="%s">',
            isset($this->caldav_list_einstellungen_options['calendar_3']) ? esc_attr($this->caldav_list_einstellungen_options['calendar_3']) : ''
        );
    }

    public function filter_4_callback()
    {
        printf(
            '<textarea class="regular-text" rows="20" name="caldav_list_einstellungen_option_name[filter_4]" id="filter_4">%s</textarea>',
            isset($this->caldav_list_einstellungen_options['filter_4']) ? esc_attr($this->caldav_list_einstellungen_options['filter_4']) : ''
        );
    }

    public function heading_5_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="caldav_list_einstellungen_option_name[heading_5]" id="heading_5" value="%s"><p>leer lassen für keine Überschrift</p>',
            isset($this->caldav_list_einstellungen_options['heading_5']) ? esc_attr($this->caldav_list_einstellungen_options['heading_5']) : ''
        );
    }

    public function ignored_categories_6_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="caldav_list_einstellungen_option_name[ignored_categories_6]" id="ignored_categories_6" value="%s"><p>Hier eingetragene Kategorien werden im Kalender nicht angezeigt (mehrere mit Komma (,) trennen)</p>',
            isset($this->caldav_list_einstellungen_options['ignored_categories_6']) ? esc_attr($this->caldav_list_einstellungen_options['ignored_categories_6']) : ''
        );
    }

    public function include_events_with_no_category_7_callback()
    {
        printf(
            '<input class="regular-text" type="checkbox" name="caldav_list_einstellungen_option_name[include_events_with_no_category_7]" id="include_events_with_no_category_7" value="1" ' . checked(1, $this->caldav_list_einstellungen_options['include_events_with_no_category_7'], false) . '><p>In der gefilterten Liste werden dann auch alle Termine ohne Kategorie angezeigt</p>',
            isset($this->caldav_list_einstellungen_options['include_events_with_no_category_7']) ? esc_attr($this->caldav_list_einstellungen_options['include_events_with_no_category_7']) : 'false'
        );
    }

}

if (is_admin())
    $caldav_list_einstellungen = new CaldavListEinstellungen();

/*
 * Retrieve this value with:
 * $caldav_list_einstellungen_options = get_option( 'caldav_list_einstellungen_option_name' ); // Array of All Options
 * $caldav_url_0 = $caldav_list_einstellungen_options['caldav_url_0']; // Caldav-URL
 * $username_1 = $caldav_list_einstellungen_options['username_1']; // Username
 * $password_2 = $caldav_list_einstellungen_options['password_2']; // Password
 * $calendar_3 = $caldav_list_einstellungen_options['calendar_3']; // calendar
 * $filter_4 = $caldav_list_einstellungen_options['filter_4']; // filter
 * $heading_5 = $caldav_list_einstellungen_options['heading_5']; // heading
 * $ignored_categories_6 = $caldav_list_einstellungen_options['ignored_categories_6']; // ignored categories
 * $include_events_with_no_category_7 = $caldav_list_einstellungen_options['include_events_with_no_category_7']; // show events without categories ind filtered list
 */
