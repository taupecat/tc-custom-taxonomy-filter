=== TC Custom Taxonomy Filter ===
Contributors: taupecat
Requires at least: 3.4
Tested up to: 3.4.2
Stable tag: 1.1
Tags: custom-taxonomy, filter

Filter your posts by your custom taxonomies.

== Description ==

Filter your posts (including custom post types) by your custom taxonomies, just like you can with WordPress' native category filter.

== Installation ==

1. Place the tc-custom-taxonomy-filter directory inside your plugins directory.
2. Navigate to the Plugins section of the Dashboard and click "Activate".
3. There is no step 3!

== Changelog ==

= Version 1.1 =

* Turned off the "show_count" argument in wp_dropdown_categories. That option only counts the "publish" post status, not "private" or "drafts." While this makes sense on the front end, in the administration interface it's a bit confusing.
* Removed the "Uncategorized" option because it wasn't working properly. Will investigate restoring it at some point in the future.

= Version 1.0 =

* Initial release.
