<?php
/**
 * Plugin Name: Stadus
 * Description: Forget email updates. Post a stadus. I mean status.
 * Author: Marcus Battle
 * Author URI: https://marcusbattle.com/apps/stadus
 */

// Include the dependencies loaded by composer
if ( file_exists( dirname( __FILE__ ) . '/vendor' ) ) {
    require_once( 'vendor/autoload.php' );
}

class Stadus extends Weaverbird\API {

    /**
     * The template directory.
     */
    protected $template_dir;

    /**
     * The constructor.
     */
    public function __construct() {

        // Load the variables.
        $this->template_dir = plugin_dir_path( __FILE__ ) . 'templates/';

        // Load the CPTs.
        $this->cpts[] = new Stadus\Classes\CPTs\Status();

        // Load the Taxonomies.
        $this->taxonomies[] = new Stadus\Classes\Taxonomies\Project();
    }

    /**
     * Load all of the hooks.
     */
    public static function register() {

        $plugin = new self();
        
        add_action( 'wp_head', [ $plugin, 'dont_follow_projects' ] );
        add_filter( 'template_include', [ $plugin, 'load_templates' ] );
        add_action( 'pre_get_posts', [ $plugin, 'display_statuses_on_project' ] );

        parent::hooks( $plugin );
    }

    public function dont_follow_projects() {
        
        if ( is_singular( 'status' ) || is_tax( 'project' ) ) {
            wp_no_robots();
        }
    }
    /**
     * Load the templates.
     */
    public function load_templates( $template ) : string {

        if ( is_tax( 'project' ) && empty( $template ) ) {
            $template = $this->template_dir . 'project.php';
        }
    
        return $template;
    }

    /**
     * Get the statuses for a project.
     */
    public function display_statuses_on_project( \WP_Query $query ) : WP_Query  {
        
        $project = get_query_var( 'project' ); 

        if ( ! is_admin() && $query->is_main_query() && $project ) {
            $query->set( 'post_type', 'status' );
        }

        return $query;
    }
}

Stadus::register();