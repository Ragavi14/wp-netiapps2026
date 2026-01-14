<?php

function setup_solutions() {
    register_post_type("Solutions", [
        "label" => "Solutions",
        "labels" => [
            "name" => "Solutions",
            "singular_name" => "Solutions",
            "add_new_item" => "Add new Solutions",
            "edit_item" => "Edit Solutions",
            "view_item" => "View Solutions",
            "view_items" => "View Solutionss",
            "search_items" => "Search Solutionss",
            "not_found" => "No Solutionss found",
            "all_items" => "All Solutionss",
            "archives" => "Solutions archives"
        ],
        "description" => "Solutionss provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "menu_icon" => "dashicons-images-alt2",
        "rewrite" => [
            "slug" => "solutions"
        ],
        "supports" => [
            "title", "editor", "thumbnail", "revisions", "author", "excerpt", "page_attributes"
        ]
    ]);
}

add_action("init", "setup_solutions");


?>