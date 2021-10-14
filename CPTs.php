<?php 
/**
 * Create a Class for Custom Post Types & their Taxonomies.
 *
 * @package PrismaGraphics
 */

if ( ! class_exists( 'PrismaGraphics_CPTs' ) ) :

	/**
	 * Class for Custom Post Types & their Taxonomies.
	 */
	class PrismaGraphics_CPTs {

		/**
		 * @var The single instance of the class
		 * @since 1.0.0
		 */
		protected static $_instance = null;


		/**
		 * Class constructor
		 */
		public function __construct() {

			$this->_hooks();

		}

		/**
		 * Hook into actions and filters
		 * @since  1.0.0
		 */
		private function _hooks() {
			add_action( 'init', array( $this, '__generate_custom_post_types' ) );
			add_action( 'init', array( $this, '__generate_taxonomies' ) );
			add_action( 'plugins_loaded', array( $this, 'textdomain' ) );
		}

		/**
		 * Registering CPTs and Taxonomies
		 *
		 * @since 1.0.0
		 */
		public function __generate_custom_post_types() {

			// register 'prisma-case_study'.
			$this->__register_post_type(
				array(
					// register name must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
					'name'          => 'prisma-case_study',
					// archive slug.
					'slug'          => 'resources/case-studies',
					// titles (singular & plural).
					'singular_name' => 'Case Study',
					'plural_name'   => 'Case Studies',
					// icon class.
					'menu_icon'     => 'dashicons-superhero',
					// admin menu position.
					'menu_position' => 7,
					// support for.
					'supports'      => array( 'title', 'revisions', 'thumbnail', 'editor', 'excerpt' ),

					'has_archive'   => true
				)
			);

			// register 'prisma-people'.
			$this->__register_post_type(
				array(
					// register name must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
					'name'          => 'prisma-people',
					// archive slug.
					'slug'          => 'people',
					// titles (singular & plural).
					'singular_name' => 'People',
					'plural_name'   => 'People',
					// icon class.
					'menu_icon'     => 'dashicons-groups',
					// admin menu position.
					'menu_position' => 7,
					// support for.
					'supports'      => array( 'title', 'editor' ),

					'has_archive'   => true
				)
			);

		}

		/**
		 * Registering taxonomies
		 *
		 * @since 1.0.0
		 */
		public function __generate_taxonomies() {

			// register 'solution' taxonomy.
			$this->__register_taxonomy(
				array(
					// register name must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
					'name'              => 'prisma-solution',
					// archive slug.
					'slug'              => 'solution',
					// titles (singular & plural).
					'singular_name'     => 'Solution',
					'plural_name'       => 'Solutions',
					// supported post types.
					'post_types'        => array( 'prisma-case_study' ),
					// set this to 'false' for non-hierarchical taxonomy (like tags).
					'hierarchical'      => true,
					'show_admin_column' => true,
					'query_var'         => true,

				)
			);

			// register 'industry' taxonomy.
			$this->__register_taxonomy(
				array(
					// register name must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
					'name'              => 'prisma-industry',
					// archive slug.
					'slug'              => 'industry',
					// titles (singular & plural).
					'singular_name'     => 'Industry',
					'plural_name'       => 'Industries',
					// supported post types.
					'post_types'        => array( 'prisma-case_study' ),
					// set this to 'false' for non-hierarchical taxonomy (like tags).
					'hierarchical'      => true,
					'show_admin_column' => true,
					'query_var'         => true,

				)
			);

			// register 'department' taxonomy.
			$this->__register_taxonomy(
				array(
					// register name must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
					'name'              => 'prisma-department',
					// archive slug.
					'slug'              => 'department',
					// titles (singular & plural).
					'singular_name'     => 'Department',
					'plural_name'       => 'Departments',
					// supported post types.
					'post_types'        => array( 'prisma-people' ),
					// set this to 'false' for non-hierarchical taxonomy (like tags).
					'hierarchical'      => true,
					'show_admin_column' => true,
					'query_var'         => true,

				)
			);

			// register 'branch' taxonomy.
			$this->__register_taxonomy(
				array(
					// register name must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
					'name'              => 'prisma-branch',
					// archive slug.
					'slug'              => 'branch',
					// titles (singular & plural).
					'singular_name'     => 'Branch',
					'plural_name'       => 'Branchs',
					// supported post types.
					'post_types'        => array( 'prisma-people' ),
					// set this to 'false' for non-hierarchical taxonomy (like tags).
					'hierarchical'      => true,
					'show_admin_column' => true,
					'query_var'         => true,

				)
			);

		}


		/**
		 * Facade for 'register_post_type()'
		 *
		 * @param [type] $setting
		 * @return void
		 */
		private function __register_post_type( $setting ) {

			$default_setting = array(
				'public'       => true,
				'show_ui'      => true,
				'show_in_menu' => true,
				'hierarchical' => false,
			);

			$setting = wp_parse_args( $setting, $default_setting );

			$args = array(
				'labels' => array(
					'name'               => __( $setting['plural_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'singular_name'      => __( $setting['singular_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'add_new'            => __( 'Add New', PRISMA_PLUGIN_TEXTDOMAIN ),
					'add_new_item'       => __( 'Add New '. $setting['singular_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'edit_item'          => __( 'Edit '. $setting['singular_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'new_item'           => __( 'New', PRISMA_PLUGIN_TEXTDOMAIN ),
					'view_item'          => __( 'View', PRISMA_PLUGIN_TEXTDOMAIN ),
					'search_items'       => __( 'Search', PRISMA_PLUGIN_TEXTDOMAIN ),
					'not_found'          => __( 'Nothing found', PRISMA_PLUGIN_TEXTDOMAIN ),
					'not_found_in_trash' => __( 'Nothing found in Trash', PRISMA_PLUGIN_TEXTDOMAIN ),
					'all_items'          => __( 'All ' . $setting['plural_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'parent_item_colon'  => '',
				),
				'public'          => $setting['public'],
				// 'publicly_queryable' => false,
				'show_ui'         => $setting['show_ui'],
				'show_in_menu'    => $setting['show_in_menu'],
				'menu_position'   => $setting['menu_position'],
				'menu_icon'       => $setting['menu_icon'],
				'query_var'       => true,
				'rewrite'         => true,
				'capability_type' => 'post',
				'hierarchical'    => $setting['hierarchical'],
				'rewrite'         => array(
					'slug'       => $setting['slug'],
					'with_front' => false,
				),
				'supports'        => $setting['supports'],
				'has_archive'     => $setting['has_archive'],
			);

			register_post_type( $setting['name'], $args );

		}


		/**
		 * Facade for 'register_taxonomy()'
		 *
		 * @param array $setting
		 * @return void
		 */
		private function __register_taxonomy( $setting ) {

			$default_setting = [ 'hierarchical' => true, 'show_admin_column' => true, 'query_var' => true ];

			$setting = wp_parse_args( $setting, $default_setting );

			$args = array(
				'hierarchical'      => $setting['hierarchical'],
				'labels'            => array(
					'name'              => __( $setting['plural_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'singular_name'     => __( $setting['singular_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'search_items'      => __( 'Search '. $setting['plural_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'all_items'         => __( 'All '. $setting['plural_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'parent_item'       => __( 'Parent '. $setting['singular_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'parent_item_colon' => __( 'Parent '. $setting['singular_name'] .':', PRISMA_PLUGIN_TEXTDOMAIN ),
					'edit_item'         => __( 'Edit '. $setting['singular_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'update_item'       => __( 'Update '. $setting['singular_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'add_new_item'      => __( 'Add New '. $setting['singular_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'new_item_name'     => __( 'New '. $setting['singular_name'] .' Name', PRISMA_PLUGIN_TEXTDOMAIN ),
					'menu_name'         => __( $setting['plural_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
					'not_found'         => __( 'No '. $setting['singular_name'] .' found', PRISMA_PLUGIN_TEXTDOMAIN ),
					'back_to_items'     => __( 'Back to '. $setting['plural_name'], PRISMA_PLUGIN_TEXTDOMAIN ),
				),
				'show_admin_column' => $setting['show_admin_column'],
				'query_var'         => $setting['query_var'],
				'rewrite'           => array(
					'slug'       => $setting['slug'],
					'with_front' => false 
				),
			);

			register_taxonomy( $setting['name'], $setting['post_types'], $args );

		}

		/**
		 * Load Languages
		 * @since 1.0.0
		 */
		public function textdomain() {

			// $plugin_dir =  dirname( plugin_basename( __FILE__ ) ) ;
			// load_plugin_textdomain( PRISMA_PLUGIN_TEXTDOMAIN, false, $plugin_dir . '/languages/' );
		}

		/**
		 * Main Instance
		 *
		 * @since 1.0.0
		 * @static
		 * @see prismagraphics_loader()
		 * @return Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
	} // End Of Class.

endif;

/**
 * Returns the main instance of WP to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return PrismaGraphics_CPTs
 */
function prismagraphics_ctps_loader() {
	return PrismaGraphics_CPTs::instance();
}

// Call the function.
prismagraphics_ctps_loader();


$rpt_custom_attrs = array(
	'target' => false,
	'class'  => 'relpost-block-single',
);

/**
 * Filter to open the related post thumbnail in a new tab. 
 *
 * @version 1.9.2
 */
$rpt_custom_attr_filter = apply_filters( 'relpost_custom_attr', $rpt_custom_attrs );


$attributes = "";

foreach ( $rpt_custom_attr_filter as $key => $value ) {
	if( false !== $value || ! empty( $value ) )
	{
		$attributes .= $key .'="'. esc_attr( wp_unslash( $value ) ) .'" ';

	}
}


$output .= '<a'. $attributes. 'href="' . get_permalink( $post->ID ). '">';

