<?php
/**
 * Custom Taxonomy Filter class file.
 *
 * @package TC Custom Taxonomy Filter
 */

namespace taupecat;

/**
 * Custom Taxonomy Filter class.
 */
class Custom_Taxonomy_Filter {

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct() {

		// Empty constructor.
	}

	/**
	 * Initialize plugin hooks.
	 *
	 * @return void
	 */
	public function init() {

		// Only run this on the admin side of the world.
		if ( is_admin() ) {

			add_action( 'restrict_manage_posts', array( $this, 'restrict_manage_posts' ) );
			add_filter( 'parse_query', array( $this, 'convert_taxonomy_id_to_slug' ) );
		}
	}

	/**
	 * Restrict manage posts.
	 *
	 * @return void
	 */
	public function restrict_manage_posts() {

		global $wp_query;

		$filters = $this->get_filters();

		foreach ( $filters as $tax_slug ) {

			$value   = '';
			$term_id = '';

			if ( array_key_exists( $tax_slug, $wp_query->query_vars ) ) {

				$value = $wp_query->query_vars[ $tax_slug ];
			}

			$taxonomy = get_taxonomy( $tax_slug );
			$term     = get_term_by( 'slug', $value, $taxonomy->name );

			if ( $term ) {

				$term_id = $term->term_id;
			}

			wp_dropdown_categories(
				array(
					'show_option_all' => __( 'Show All ', 'taupecat' ) . $taxonomy->labels->name,
					'taxonomy'        => $tax_slug,
					'name'            => $tax_slug,
					'hide_empty'      => false,
					'orderby'         => 'name',
					'order'           => 'ASC',
					'selected'        => $term_id,
				)
			);
		}
	}

	/**
	 * Get existing filters.
	 *
	 * @return array Taxonomies.
	 */
	private function get_filters() {

		global $typenow;

		$args = array(
			'object_type' => array( $typenow ),
			'_builtin'    => false,
		);

		return get_taxonomies( $args );
	}

	/**
	 * Filter out the posts based on the custom taxonomy we chose.
	 *
	 * @param object $query Query object.
	 *
	 * @return void
	 */
	public function convert_taxonomy_id_to_slug( $query ) {

		global $pagenow;

		$query_vars  = &$query->query_vars;
		$tax_queries = &$query->tax_query->queries;

		// Loop through each of the requested taxonomies.
		if ( 'edit.php' === $pagenow ) {

			foreach ( $tax_queries as $tax_query ) {

				$slug = '';
				$term = get_term_by( 'id', $tax_query['terms'][0], $tax_query['taxonomy'] );

				if ( $term ) {

					$slug = $term->slug;
				}

				$query_vars[ $tax_query['taxonomy'] ] = $slug;
			}
		}
	}
}
