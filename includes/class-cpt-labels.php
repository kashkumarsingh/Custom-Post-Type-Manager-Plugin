<?php

namespace Custom_Post_Types_Manager;

final class CPT_Labels
{
    public static function getLabels(string $singular, string $plural): array
    {
        $label_map = [
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

        return array_map(fn($label) => __($label, CPT_MANAGER_TEXT_DOMAIN), $label_map);
    }
}
