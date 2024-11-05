<?php
/**
 * Plugin Name: Custom Post Types Manager
 * Description: A WordPress plugin to manage custom post types with taxonomy configuration.
 * Version: 1.0.0
 * Author: Kashkumar Singh
 * License: GPLv2 or later
 */


namespace Custom_Post_Types_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Define constants for the plugin.
 */
define('CPT_MANAGER_VERSION', '1.0');
define('CPT_MANAGER_TEXT_DOMAIN', 'cpt-manager');


// Autoload class files
spl_autoload_register(function ($class) {
    $prefix = __NAMESPACE__ . '\\';
    $base_dir = __DIR__ . '/includes/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return; // Not our class, return
    }

    $relative_class = strtolower(str_replace('\\', '/', substr($class, $len)));
    $file = $base_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        error_log("Class file for {$class} not found: {$file}"); // Log error if file not found
    }
});

final class Custom_Post_Types_Manager_Plugin
{
    private static ?self $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->init_hooks();
    }

    private function init_hooks(): void
    {
        add_action('init', [$this, 'register_default_post_types']);
    }

    public function register_default_post_types(): void
    {
        $post_types = array_filter($this->get_post_types(), function ($config, $cpt_name) {
            return apply_filters("cpt_manager_enable_{$cpt_name}", true);
        }, ARRAY_FILTER_USE_BOTH);
    
        foreach ($post_types as $cpt_name => $config) {
            $cpt_manager = CPT_Factory::create($cpt_name, $config);
    
            if ($cpt_name === 'faq') {
                $cpt_manager->add_taxonomy('faq_category', $this->get_taxonomy_config('faq_category'));
            }
    
            $cpt_manager->register();
        }
    }

    private function get_post_types(): array
    {
        $post_types = [
            'service' => ['singular' => 'Service', 'plural' => 'Services', 'slug' => 'services', 'icon' => 'dashicons-hammer'],
            'faq' => ['singular' => 'FAQ', 'plural' => 'FAQs', 'slug' => 'faqs', 'icon' => 'dashicons-format-chat'],
            'boiler' => ['singular' => 'Boiler', 'plural' => 'Boilers', 'slug' => 'boilers', 'icon' => 'dashicons-building'],
        ];
    
        // Remove duplicate post types by keys
        $unique_post_types = array_unique($post_types, SORT_REGULAR);
    
        return array_map(function($config) {
            return [
                'labels' => CPT_Labels::getLabels($config['singular'], $config['plural']),
                'rewrite' => ['slug' => $config['slug']],
                'menu_icon' => $config['icon'],
            ];
        }, $unique_post_types);
    }
    
    

    private function get_taxonomy_config(string $taxonomy_name): array
    {
        $default_labels = [
            'name' => ucfirst($taxonomy_name),
            'singular_name' => ucfirst($taxonomy_name),
            'menu_name' => ucfirst($taxonomy_name), // Assuming menu_name is an additional label
            'all_items' => 'All ' . ucfirst($taxonomy_name),
        ];
    
        // Remove any duplicate labels
        $unique_labels = array_unique($default_labels);
    
        return array_merge(
            ['labels' => $unique_labels],
            [
                'rewrite' => ['slug' => strtolower(str_replace('_', '-', $taxonomy_name))],
                'show_in_rest' => true,
                'hierarchical' => true,
                'menu_icon' => 'dashicons-category',
            ]
        );
    }
    
    
}

Custom_Post_Types_Manager_Plugin::getInstance();
