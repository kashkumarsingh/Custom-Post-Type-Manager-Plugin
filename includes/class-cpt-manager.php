<?php

namespace Custom_Post_Types_Manager;

class CPT_Manager
{
    private string $cpt_name;
    private array $config;
    private array $taxonomies = [];

    // Define default configuration
    private const DEFAULT_CONFIG = [
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor'],
        'show_in_rest' => true,
        'labels' => [],
    ];

    /**
     * Constructor to initialize CPT_Manager with a custom post type name.
     *
     * @param string $cpt_name - The name of the custom post type.
     */
    public function __construct(string $cpt_name)
    {
        $this->cpt_name = $cpt_name;
        $this->config = self::DEFAULT_CONFIG;
        $this->setDefaultLabels();
    }

    private function setDefaultLabels(): void
    {
        $this->config['labels'] = [
            'name' => ucfirst($this->cpt_name) . 's',
            'singular_name' => ucfirst($this->cpt_name),
        ];
    }

    /**
     * Apply configuration settings for the custom post type.
     *
     * @param array $config - Configuration settings for the CPT.
     */
    public function apply_config(array $config): void
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * Register the custom post type with WordPress.
     */
    public function register(): void
    {
        if (!post_type_exists($this->cpt_name)) {
            register_post_type($this->cpt_name, $this->config);
            $this->register_taxonomies();
        }
    }

    /**
     * Register taxonomies associated with this custom post type.
     */
    private function register_taxonomies(): void
    {
        foreach ($this->taxonomies as $taxonomy) {
            register_taxonomy($taxonomy['name'], $this->cpt_name, $taxonomy['config']);
        }
    }

    /**
     * Add a taxonomy to the custom post type.
     *
     * @param string $taxonomy_name - Name of the taxonomy.
     * @param array $taxonomy_config - Configuration settings for the taxonomy.
     */
    public function add_taxonomy(string $taxonomy_name, array $taxonomy_config): void
    {
        $default_taxonomy_config = [
            'hierarchical' => true,
            'public' => true,
            'show_in_rest' => true,
            'labels' => [
                'name' => ucfirst($taxonomy_name),
                'singular_name' => ucfirst($taxonomy_name),
            ]
        ];

        $this->taxonomies[] = [
            'name' => $taxonomy_name,
            'config' => array_merge($default_taxonomy_config, $taxonomy_config),
        ];
    }
}
