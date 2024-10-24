<?php

namespace BookPlugin\PostTypes;

use BookPlugin\ServiceProvider;

class Book
{
    public function register()
    {
        add_action('init', [$this, 'register_post_type']);
    }
    public function register_post_type()
    {
        $labels = [
            'name'               => esc_html_x('Books', 'Post Type General Name', 'book'),
            'singular_name'      => esc_html_x('Book', 'Post Type Singular Name', 'book'),
            'menu_name'          => esc_html__('Books', 'book'),
            'name_admin_bar'     => esc_html__('Book', 'book'),
            'add_new'            => esc_html__('Add New Book', 'book'),
            'edit_item'          => esc_html__('Edit Book', 'book'),
            'new_item'           => esc_html__('New Book', 'book'),
            'view_item'          => esc_html__('View Book', 'book'),
        ];

        $args = [
            'label'              => esc_html__('Book', 'book'),
            'labels'             => $labels,
            'public'             => true,
            'has_archive'        => true,
            'supports'           => ['title', 'editor', 'thumbnail'],
            'show_in_rest'       => true,
        ];

        register_post_type('book', $args);
    }
}
