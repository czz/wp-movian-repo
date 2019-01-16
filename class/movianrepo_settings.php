<?php

/*
 * Setting page class
 */
class MovianRepoSettingsPage {

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {

        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
        add_action('admin_enqueue_scripts', array($this,'enqueue_scripts'));

    }


    /**
     * Enqueue Scripts
     */
    public function enqueue_scripts($hook) {

        if('toplevel_page_movianrepo' != $hook) return; // load only on movian repo page

        wp_register_script('movianrepo_js', str_replace('/class','',plugins_url( '/assets/js/movianrepo.js', __FILE__)), array ('jquery'));
        wp_register_style('movianrepo_css', str_replace('/class','',plugins_url( 'assets/css/style.css', __FILE__)));

        wp_enqueue_script('movianrepo_js');
        wp_enqueue_style('movianrepo_css');

    }


    /**
     * Add options page
     */
    public function add_plugin_page() {

        add_menu_page(
            'Settings Admin', 
            'Movian Repo', 
            'manage_options', 
            'movianrepo', 
            array( $this, 'create_admin_page' )
        );

    }


    /**
     * Options page callback
     */
    public function create_admin_page() {

        // Set class property
        $this->options = get_option( 'movianrepo_option_name' );
        ?>

        <div class="wrap">
            <h1>Movian Repo</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'movianrepo_option_group' );
                do_settings_sections( 'movianrepo-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }


    /**
     * Register and add settings
     */
    public function page_init() {

        register_setting(
            'movianrepo_option_group', // Option group
            'movianrepo_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Add git url', // Title
            array( $this, 'print_section_info' ), // Callback
            'movianrepo-setting-admin' // Page
        );

        add_settings_field(
            'urls', // ID
            'Git relative path\'s', // Title 
            array( $this, 'urls_callback' ), // Callback
            'movianrepo-setting-admin', // Page
            'setting_section_id' // Section
        );

    }


    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {

        $new_input = array();
        if( isset( $input['urls'] ) )

            foreach($input['urls'] as $url){
              $new_input['urls'][]=sanitize_text_field( $url);
            }

        return $new_input;
    }


    /** 
     * Print the Section text
     */
    public function print_section_info() {

        print 'Enter relative path of git plugins url (/czz/movian-plugin-zooqle): ';

    }


    /** 
     * Get the settings option array and print one of its values
     */
    public function urls_callback() {

        ?><a href="#" id="movianrepo-add">Add</a><ul id="movianrepo-urls-input"><?php

        foreach($this->options['urls'] as $url) {
            printf(
                '<li><input type="text" class="urls" name="movianrepo_option_name[urls][]" value="%s" /><a class="movianrepo-remove" href="javascript:void(0)">remove</a></li>',
                isset( $url ) ? esc_attr( $url) : ''
            );
        }

        ?></ul><?php

    }


}

