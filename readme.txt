=== Custom Post Types Manager ===
Contributors: yourusername
Tags: custom post types, taxonomies, WordPress, plugin
Requires at least: 5.0
Tested up to: 6.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

A plugin to register custom post types and taxonomies for any theme. This plugin provides a simple way to manage and organize custom content types on your WordPress site.

== Features ==

* Register custom post types such as FAQs, Services, and Boilers.
* Create custom taxonomies for better content organization.
* Supports REST API for seamless integration with the WordPress block editor.
* Dynamic labels and settings for easy customization.

== Installation ==

1. Upload the `custom-post-types-manager` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. The custom post types and taxonomies will be available in your WordPress admin panel.

== Usage ==

Once activated, the following custom post types will be available:

* FAQs: A post type to manage frequently asked questions.
* Services: A post type to manage services offered.
* Boilers: A post type to manage boiler products or information.
* Why Choose Meraboiler: A post type for testimonials or reasons to choose your service.

You can also create a taxonomy for FAQ Categories to group your FAQs.

== Changelog ==

= 1.0 =
* Initial release of the Custom Post Types Manager plugin.
* Registered custom post types: FAQ, Service, Boiler, Why Choose Meraboiler.
* Registered custom taxonomy: FAQ Category.

== Upgrade Notice ==

= 1.0 =
Initial release of the plugin. No upgrade necessary.

== Frequently Asked Questions ==

= How do I customize the labels for my custom post types? =

You can modify the labels in the `cpt-manager.php` file under the `cpt_manager_get_config()` function.

= Can I add more custom post types? =

Yes, you can add more custom post types by modifying the configuration array in the `cpt-manager.php` file.

== Acknowledgments ==

* Thanks to the WordPress community for their contributions and support.
