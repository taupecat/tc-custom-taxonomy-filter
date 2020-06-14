# TC Custom Taxonomy Filter

* Contributors: taupecat, tatumcreative, mrwweb
* Requires at least: 3.4
* Tested up to: 5.4.2
* Stable tag: 2.0.0
* Requires PHP: 5.3.0
* Tags: custom-taxonomy, filter
* License: MIT

A WordPress plugin to filter your posts by custom taxonomies in the dashboard.

## Description

Filter your posts (including custom post types) by your custom taxonomies, just like you can with WordPress' native category filter.

## Installation

1. Place the tc-custom-taxonomy-filter directory inside your plugins directory.
2. Navigate to the Plugins section of the Dashboard and click "Activate".

## Changelog

### Version 2.0.0

* Rewrote code to modern WordPress standards.
* Added column for custom taxonomy.
* Changed license to MIT.

### Version 1.3.1

* One more minor code change to deal with another PHP notice. Props mrwweb.

### Version 1.3

* Bug fix to remove PHP notices. Props tatumcreative, mrwweb.

### Version 1.2

* Fixed a small bug where is_admin() wasn't being called as a proper function.

### Version 1.1

* Turned off the "show_count" argument in wp_dropdown_categories. That option only counts the "publish" post status, not "private" or "drafts." While this makes sense on the front end, in the administration interface it's a bit confusing.
* Removed the "Uncategorized" option because it wasn't working properly. Will investigate restoring it at some point in the future.

### Version 1.0

* Initial release.
