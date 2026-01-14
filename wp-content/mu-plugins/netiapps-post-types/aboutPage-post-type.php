<?php

function setup_about() {
    register_post_type("About", [
        "label" => "About",
        "labels" => [
            "name" => "About",
            "singular_name" => "About",
            "add_new_item" => "Add new About",
            "edit_item" => "Edit About",
            "view_item" => "View About",
            "view_items" => "View Abouts",
            "search_items" => "Search Abouts",
            "not_found" => "No Abouts found",
            "all_items" => "All Abouts",
            "archives" => "About archives"
        ],
        "description" => "Abouts provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "menu_icon" => "dashicons-images-alt2",
        "rewrite" => [
            "slug" => "about"
        ],
        "supports" => [
            "title", "editor", "thumbnail", "revisions", "author", "excerpt", "page_attributes"
        ]
    ]);
}

add_action("init", "setup_about");


?>