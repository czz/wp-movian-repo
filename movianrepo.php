<?php
/*
Plugin Name: Movian Repo
Plugin URI: http://github.com/czz/wp-movian-repo
Description: Plugin for Generating Movian repository json response
Author: czz78
Version: 1.0
Author URI: http://czz78.com/
License: GPLv3 or later
Text Domain: movianrepo
*/


define( 'MOVIANREPO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/*
 * Classes Required
 */
require_once(MOVIANREPO_PLUGIN_DIR . 'class/movianrepo_settings.php');
require_once(MOVIANREPO_PLUGIN_DIR . 'class/movian_repo.php');


/*
 * Only admin area
 */
if( is_admin() ) {

    // Add setting page
    $movianrepo_settings_page = new MovianRepoSettingsPage();

}


/*
 * Ajax calls
 */
add_action( 'wp_ajax_movian_repo', 'movian_repo_ajax' );
add_action( 'wp_ajax_nopriv_movian_repo', 'movian_repo_ajax' );
function movian_repo_ajax() {

    $options = get_option('movianrepo_option_name', array() );

    $list = $options['urls'];

    $mp = new MovianRepo();
    $json = $mp->build($list);

    header('Content-Type: application/json');
    echo $json;

    wp_die(); // this is required to terminate immediately and return a proper response

}


