<?php

namespace BookPlugin\Taxonomies;

class Publisher
{
    public function register()
    {
        add_action('init', [$this, 'register_taxonomy']);
    }

    public function register_taxonomy()
    {
        $labels = [
            'name'                          => esc_html_x('Publishers', 'taxonomy general name', 'book'),
            'singular_name'                 => esc_html_x('Publisher', 'taxonomy singular name', 'book'),
            'search_items'                  => esc_html__('Search Publishers', 'book'),
            'all_items'                     => esc_html__('All Publishers', 'book'),
            'parent_item'                   => esc_html__('Parent Publisher', 'book'),
            'parent_item_colon'             => esc_html__('Parent Publisher:', 'book'),
            'edit_item'                     => esc_html__('Edit Publisher', 'book'),
            'update_item'                   => esc_html__('Update Publisher', 'book'),
            'add_new_item'                  => esc_html__('Add New Publisher', 'book'),
            'new_item_name'                 => esc_html__('New Publisher Name', 'book'),
            'menu_name'                     => esc_html__('Publisher', 'book'),
            'popular_items'                 => esc_html__('Popular Publishers', 'book'),
            'separate_items_with_commas'    => esc_html__('Separate Publishers with commas', 'book'),
            'add_or_remove_items'           => esc_html__('Add or remove Publishers', 'book'),
            'choose_from_most_used'         => esc_html__('Choose from the most used Publishers', 'book'),
            'not_found'                     => esc_html__('No Publishers found.', 'book'),
        ];

        $args = [
            'labels'            => $labels,
            'public'            => true,
            'hierarchical'      => true,
            'show_in_rest'      => true,
        ];

        register_taxonomy('publisher', ['book'], $args);
    }
}
