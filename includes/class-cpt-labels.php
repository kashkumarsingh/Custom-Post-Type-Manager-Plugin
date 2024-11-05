<?php

namespace Custom_Post_Types_Manager;

final class CPT_Labels
{
    /**
     * Text domain for translation, allowing customization if needed.
     */
    private const TEXT_DOMAIN = CPT_MANAGER_TEXT_DOMAIN;

    /**
     * Generate labels for a custom post type.
     *
     * @param string $singular Singular name of the post type.
     * @param string $plural Plural name of the post type.
     * @param array $custom_labels Optional. Additional custom labels to merge with defaults.
     *
     * @return array Translated labels array.
     */
    public static function getLabels(string $singular, string $plural, array $custom_labels = []): array
    {
        // Validate inputs
        if (empty($singular) || empty($plural)) {
            throw new \InvalidArgumentException("Singular and plural names must be non-empty strings.");
        }

        // Default label definitions
        $default_labels = [
            'name' => $plural,
            'singular_name' => $singular,
            'add_new_item' => 'Add New ' . $singular,
            'edit_item' => 'Edit ' . $singular,
            'new_item' => 'New ' . $singular,
            'view_item' => 'View ' . $singular,
            'search_items' => 'Search ' . $plural,
            'not_found' => 'No ' . strtolower($plural) . ' found',
            'not_found_in_trash' => 'No ' . strtolower($plural) . ' found in Trash',
        ];

        // Merge custom labels if provided
        $labels = array_merge($default_labels, $custom_labels);

        // Translate all labels
        return array_map(fn($label) => __($label, self::TEXT_DOMAIN), $labels);
    }
}
