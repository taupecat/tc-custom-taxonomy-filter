<?php
/**
 * Plugin Name: TC Custom Taxonomy Filter
 * Description: Filter your posts (including custom post types) by your custom taxonomies, just like you can with WordPress' native category filter.
 * Author: Tracy Rotton, TatumCreative, MRW Web Design
 * Version: 1.3.1
 * Author URI: http://www.taupecat.com/
 * License: MIT
 * Requires at least: 3.4
 * Required PHP: 5.3.0
 * Tested up to: 5.3.2
 * Stable tag: 2.0.0
 *
 * @package TC Custom Taxonomy Filter
 */

namespace taupecat;

require_once __DIR__ . '/class-custom-taxonomy-filter.php';

( new Custom_Taxonomy_Filter() )->init();
