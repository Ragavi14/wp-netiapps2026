<?php

function setup_blogs() {
    register_post_type("Blogs", [
        "label" => "Blogs",
        "labels" => [
            "name" => "Blogs",
            "singular_name" => "Blogs",
            "add_new_item" => "Add new Blogs",
            "edit_item" => "Edit Blogs",
            "view_item" => "View Blogs",
            "view_items" => "View Blogss",
            "search_items" => "Search Blogss",
            "not_found" => "No Blogss found",
            "all_items" => "All Blogss",
            "archives" => "Blogs archives"
        ],
        "description" => "Blogss provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "menu_icon" => "dashicons-images-alt2",
        "rewrite" => [
            "slug" => "blogs"
        ],
        "supports" => [
            "title", "editor", "thumbnail", "revisions", "author", "excerpt", "page_attributes"
        ]
    ]);
}

add_action("init", "setup_blogs");


?>