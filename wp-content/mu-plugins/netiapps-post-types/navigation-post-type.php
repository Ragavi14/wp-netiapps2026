<?php

function setup_navigation() {
    register_post_type("Navigation Section", [
        "label" => "Navigation Section",
        "labels" => [
            "name" => "Navigation Section",
            "singular_name" => "Navigation Section",
            "add_new_item" => "Add new Navigation Section",
            "edit_item" => "Edit Navigation Section",
            "view_item" => "View Navigation Section",
            "view_items" => "View Navigation Section",
            "search_items" => "Search Navigation Section",
            "not_found" => "No Navigation found",
            "all_items" => "All Navigation Section",
            "archives" => "Navigation Section archives"
        ],
        "description" => "Navigation Section provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "navigation_icon" => "dashicons-twitch",
        "rewrite" => [
            "slug" => "navigation-section"
        ],
        "supports" => [
            "title", "editor", "revisions", "author", "excerpt", "page_attributes","thumbnail"
        ]
       

    ]);

   
}

add_action("init", "setup_navigation");


?>