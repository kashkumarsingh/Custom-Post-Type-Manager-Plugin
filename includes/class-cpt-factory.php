<?php

namespace Custom_Post_Types_Manager;

class CPT_Factory
{
    /**
     * Creates and configures a new instance of CPT_Manager.
     *
     * @param string $cpt_name - The custom post type name.
     * @param array $config - Configuration settings for the CPT.
     * @param array $taxonomies - Optional array of taxonomies to register with the CPT.
     * @return CPT_Manager - Configured CPT_Manager instance.
     */
    public static function create(string $cpt_name, array $config = [], array $taxonomies = []): CPT_Manager
    {
        $cpt_manager = new CPT_Manager($cpt_name);
        $cpt_manager->apply_config($config);

        foreach ($taxonomies as $taxonomy_name => $taxonomy_config) {
            $cpt_manager->add_taxonomy($taxonomy_name, $taxonomy_config);
        }

        return $cpt_manager;
    }
}
