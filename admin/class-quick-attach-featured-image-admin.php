<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/rohan-krishna
 * @since      1.0.0
 *
 * @package    Quick_Attach_Featured_Image
 * @subpackage Quick_Attach_Featured_Image/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Quick_Attach_Featured_Image
 * @subpackage Quick_Attach_Featured_Image/admin
 * @author     Rohan Krishna <phonemg30993@gmail.com>
 */
class Quick_Attach_Featured_Image_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $taxonomy;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->taxonomy = 'stm_lms_course_taxonomy';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Quick_Attach_Featured_Image_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Quick_Attach_Featured_Image_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/quick-attach-featured-image-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-datatable-css', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/jquery.dataTables.min.css', [], $this->version, 'all');
		wp_enqueue_style( $this->plugin_name . '-datatable-bs4-css', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/dataTables.bootstrap4.min.css', [], $this->version, 'all');
		wp_enqueue_style( $this->plugin_name . '-bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css', [], $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Quick_Attach_Featured_Image_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Quick_Attach_Featured_Image_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/quick-attach-featured-image-admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-datatable-js', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js', ['jquery'], $this->version, false);
		
	}

	public function add_wp_qafi_menu_page()
	{
		# code...
		add_menu_page(
			'Quick Attach Featured Image',
			'Quick Attach Featured Image',
			'manage_options',
			$this->plugin_name . '-options',
			[$this, 'wp_qafi_menu_page_html'],
			'',
			5
		);
	}

	public function get_all_terms_list()
	{
		# code...
		$taxonomy = 'stm_lms_course_taxonomy';

        return wp_dropdown_categories( array(
            'show_option_all'    => 'Choose a category',
            'show_option_none'   => '',
            'orderby'            => 'ID', 
            'order'              => 'ASC',
            'show_count'         => 0,
            'hide_empty'         => 0, 
            'child_of'           => 0,
            'exclude'            => '',
            'echo'               => 1,
            'selected'           => null,
            'hierarchical'       => 1, 
            'name'               => 'tax_input['.$this->taxonomy.'][]', // important
            'id'                 => $id,
            'class'              => 'form-no-clear',
            'depth'              => 0,
            'tab_index'          => 0,
            'taxonomy'           => $this->taxonomy,
            'hide_if_empty'      => true
		) );
	
	}

	public function queryByCategory($termID, $page)
	{
		if($termID) {
			$termID = $termID;
		} else {
			$termlist = get_terms($this->taxonomy);
			$termID = wp_list_pluck($termlist, 'term_id');
		}
		# code...
		$args = [
			'posts_per_page' => -1,
            'post_type' => 'stm-courses',
            'tax_query' => [
                [
                    'taxonomy' => $this->taxonomy,
                    'field' => 'id',
                    'terms' => $termID
                ]
			],
		];
		
		$posts = new WP_Query($args);
		// $posts = $query->posts;

		return $posts;
	}

	public function saveAttachment($postID, $attachmentID)
	{
		# sanitization
		$postID = (int) $postID;
		$attachmentID = (int) $attachmentID;

		$set = set_post_thumbnail($postID, $attachmentID);
	}

	public function wp_qafi_menu_page_html()
	{
		# code...
		include_once 'partials/quick-attach-featured-image-admin-display.php';
	}

}
