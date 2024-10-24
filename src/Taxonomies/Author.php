<?php

namespace BookPlugin\Taxonomies;

class Author
{
    public function register()
    {
        add_action('init', [$this, 'register_taxonomy']);
    }

    public function register_taxonomy()
    {
        $labels = [
            'name'                          => esc_html_x('Authors', 'taxonomy general name', 'book'),
            'singular_name'                 => esc_html_x('Author', 'taxonomy singular name', 'book'),
            'search_items'                  => esc_html__('Search Authors', 'book'),
            'all_items'                     => esc_html__('All Authors', 'book'),
            'parent_item'                   => esc_html__('Parent Author', 'book'),
            'parent_item_colon'             => esc_html__('Parent Author:', 'book'),
            'edit_item'                     => esc_html__('Edit Author', 'book'),
            'update_item'                   => esc_html__('Update Author', 'book'),
            'add_new_item'                  => esc_html__('Add New Author', 'book'),
            'new_item_name'                 => esc_html__('New Author Name', 'book'),
            'menu_name'                     => esc_html__('Author', 'book'),
            'popular_items'                 => esc_html__('Popular Authors', 'book'),
            'separate_items_with_commas'    => esc_html__('Separate Authors with commas', 'book'),
            'add_or_remove_items'           => esc_html__('Add or remove Authors', 'book'),
            'choose_from_most_used'         => esc_html__('Choose from the most used Authors', 'book'),
            'not_found'                     => esc_html__('No Authors found.', 'book'),
        ];

        $args = [
            'labels'            => $labels,
            'public'            => true,
            'hierarchical'      => true,
            'show_in_rest'      => true,
        ];

        register_taxonomy('Author', ['book'], $args);
    }
}
