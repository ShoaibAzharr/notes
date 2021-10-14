<?php
/**
 * Function that registers "People" CPT for Prismagraphics
 * Register post type function call inside this function
 *
 * @return void
 */
function prisma_people_post_type()
{
	// Setting UI labels for People Post Type
    $labels = array(
        'name'                => _x( 'Peoples', 'Post Type General Name', 'prismagraphics' ),
        'singular_name'       => _x( 'People', 'Post Type Singular Name', 'prismagraphics' ),
        'menu_name'           => __( 'Peoples', 'prismagraphics' ),
        'all_items'           => __( 'All People', 'prismagraphics' ),
    );

	// Set other options for People Post Type
     
    $args = array(
        'description'         => __( 'People branches and departments', 'prismagraphics' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
     
    // Registering  Custom Post Type
    register_post_type( 'people', $args );
}

add_action( 'init', 'prisma_people_post_type'); 

/**
 * Function that registers a "Branches" taxanomy 
 * For the "People" CPT
 * 
 *
 * @return void
 */
function prisma_people_branch_taxonomy() {
 
  $labels = array(
    'name'			 => _x( 'Branches', 'taxonomy general name', 'prismagrahics' ),
    'singular_name'	 => _x( 'Topic', 'taxonomy singular name', 'prismagrahics' ),
    'search_items'	 => __( 'Search Branches', 'prismagraphics' ),
    'popular_items'	 => __( 'Popular Branches', 'prismagraphics' ),
    'menu_name'		 => __( 'Branches' ),
  ); 

  //Options array for "Branches" taxanomy
  $prisma_args = array(
    'hierarchical'			 => true,
    'labels'				 => $labels,
    'show_ui'				 => true,
    'show_in_rest'			 => true,
    'show_admin_column'		 => true,
    'query_var'				 => true,
    'rewrite'				 => array( 'slug' => 'branch' ),
  );

  //Method that registers taxanomy 
  register_taxonomy('branches','people', $prisma_args);

}


add_action( 'init', 'prisma_people_branch_taxonomy');

/**
 * Function that registers a "Departments" taxanomy 
 * For the "People" CPT
 * 
 *
 * @return void
 */
 
function prisma_people_department_taxonomy() {
 
	$labels = array(
		'name'			 => _x( 'Departments', 'taxonomy general name', 'prismagrahics' ),
		'singular_name'	 => _x( 'Topic', 'taxonomy singular name', 'prismagrahics' ),
		'search_items'	 => __( 'Search Departments', 'prismagraphics' ),
		'popular_items'	 => __( 'Popular Departments', 'prismagraphics' ),
		'menu_name'		 => __( 'Departments' ),
	); 
	
	//Options array for "Departments" taxanomy
	$prisma_args = array(
		'hierarchical'			 => true,
		'labels'				 => $labels,
		'show_ui'				 => true,
		'show_in_rest'			 => true,
		'show_admin_column'		 => true,
		'query_var'				 => true,
		'rewrite'				 => array( 'slug' => 'department' ),
	);

	//Method that registers taxanomy 
	register_taxonomy( 'departments', 'people', $prisma_args);

}

add_action( 'init', 'prisma_people_department_taxonomy');