<?php

function setup_homePage() {
    register_post_type("HomePage Section", [
        "label" => "HomePage Section",
        "labels" => [
            "name" => "Home Page",
            "singular_name" => "HomePage Section",
            "add_new_item" => "Add new HomePage Section",
            "edit_item" => "Edit HomePage Section",
            "view_item" => "View HomePage Section",
            "view_items" => "View HomePage Section",
            "search_items" => "Search HomePage Section",
            "not_found" => "No HomePage found",
            "all_items" => "All HomePage Section",
            "archives" => "HomePage Section archives"
        ],
        "description" => "HomePage Section provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "homePage_icon" => "dashicons-twitch",
        "rewrite" => [
            "slug" => "homePage-section"
        ],
        "supports" => [
            "title", "editor", "revisions", "author", "excerpt", "page_attributes","thumbnail"
        ]
       

    ]);

   
}

add_action("init", "setup_homePage");


?>