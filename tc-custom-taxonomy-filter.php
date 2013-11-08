<?php
/*
Plugin Name: TC Custom Taxonomy Filter
Description: Filter your posts (including custom post types) by your custom taxonomies, just like you can with WordPress' native category filter.
Author: Tracy Rotton, TatumCreative, MRW Web Design
Version: 1.3.1
Author URI: http://www.taupecat.com/
License: GPLv2
*/

// Only run this on the admin side of the world
if ( is_admin() ) {
    add_action( 'restrict_manage_posts', 'tc_ctf_restrict_manage_posts' );
    add_filter( 'parse_query', 'tc_ctf_convert_taxonomy_id_to_slug' );
}

// Create our drop-down category listing, using all the latest & greatest WordPress things
function tc_ctf_restrict_manage_posts() {

    global $wp_query;

    $filters = tc_ctf_get_filters();

    foreach( $filters as $tax_slug ) {

        $taxonomy = get_taxonomy( $tax_slug );

        $value = array_key_exists($tax_slug, $wp_query->query_vars) ? $wp_query->query_vars[$tax_slug] : '';

        $term = get_term_by( 'slug', $value, $taxonomy->name );

        $term_id = $term ? $term->term_id : '';

        wp_dropdown_categories(
            array(
                'show_option_all'   => __("Show All " . $taxonomy->labels->name ),
                'taxonomy'          => $tax_slug,
                'name'              => $tax_slug,
                'hide_empty'        => false,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'selected'          => $term_id
            )
        );
    }
}

// Get only the custom taxonomies associated with this post type
function tc_ctf_get_filters() {
    global $typenow;

    $args = array(
        'object_type'   => array( $typenow ),
        '_builtin'      => false
    );

    $taxonomies = get_taxonomies( $args );

    return $taxonomies;
}

// Now, actually filter out the posts based on the category, er, _custom taxonomy_ we chose
function tc_ctf_convert_taxonomy_id_to_slug( $query ) {
    global $pagenow;

    $query_vars = &$query->query_vars;
    $tax_queries  = &$query->tax_query->queries;

    // loop through each of the requested taxonomies
    if ( $pagenow == 'edit.php' ) {
        foreach ( $tax_queries as $tax_query ) {
            $term = get_term_by( 'id', $tax_query['terms'][0], $tax_query['taxonomy'] );
            $slug = $term ? $term->slug : '';
            $query_vars[$tax_query['taxonomy']] = $slug;
        }
    }
}
