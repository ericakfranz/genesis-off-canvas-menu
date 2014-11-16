<?php

/**
 * GENESIS OFF-CANVAS MENU
 * Adapted from Codrops - http://tympanus.net/codrops/2014/09/16/off-canvas-menu-effects/
 *
 * @author      Erica Franz @ericakfranz
 * @authoruri   http://fatpony.me
 * @link        http://fatpony.me/genesis-off-canvas-menu
 * @link        http://github.com/ericakfranz/genesis-off-canvas-menu
 *
 * @version     1.0
 * 
 * @license     GNU General Public License v2 or later
 */

// Remember to enqueue your scripts!
add_action( 'wp_enqueue_scripts', 'fatpony_load_scripts' );
 
// Load Elastic Sidebar scripts only if sidebar is active
// - no reason to waste resources
function fatpony_load_scripts() {
    if( is_active_sidebar( 'elastic-sidebar' ) ) {
         wp_enqueue_script( 'snap-svg', get_stylesheet_directory_uri() . '/js/snap.svg-min.js', array(), null, false );
     // Load footer scripts
         wp_enqueue_script( 'classie', get_stylesheet_directory_uri() . '/js/classie.js', array(), null, true );
         wp_enqueue_script( 'elastic', get_stylesheet_directory_uri() . '/js/elastic.js', array(), null, true );
    }
}


// Remove default header widget - untested with the header right widget intact
unregister_sidebar( 'header-right' );
 
// Register new sidebar
    genesis_register_sidebar(
        array(
            'id'    =>  'elastic-sidebar',
            'name'  =>  __( 'Elastic Sidebar', 'theme_name' ),
            'description'   =>  __( 'This is the elastic sidebar area. Anything you place inside will be hidden until activated with the menu icon, then bounce into view using an elastic-like animation.', 'theme_name' ),
        )
    );
 
// Hook into header area
    add_action( 'genesis_before', 'fatpony_elastic_sidebar' );
    function fatpony_elastic_sidebar() {
        genesis_widget_area( 'elastic-sidebar', array(
            'before'    =>  '<div class="container">
                                <div class="elastic-wrap">
                                    <div class="elastic-widget-wrap">',
            'after'     =>  '        </div>
                                    <button class="close-button" id="close-button">
                                        <span class="assistive-text">Close Menu</span>
                                    </button>
                                    <div class="morph-shape" id="morph-shape" data-morph-open="M-1,0h101c0,0,0-1,0,395c0,404,0,405,0,405H-1V0z">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100 800" preserveAspectRatio="none">
                                            <path d="M-1,0h101c0,0-97.833,153.603-97.833,396.167C2.167,627.579,100,800,100,800H-1V0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <button class="menu-button" id="open-button">
                                    <span class="assistive-text">Open Menu</span>
                                </button>
                                <div class="site-container-wrap">',
        ));
    }
 
// Wrap up loose ends
    add_action( 'genesis_after', 'fatpony_loose_ends' );
    function fatpony_loose_ends() {
        echo '</div></div>';
    }
    