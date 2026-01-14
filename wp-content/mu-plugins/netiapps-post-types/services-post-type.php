<?php

function setup_services() {
    register_post_type("Services", [
        "label" => "Services",
        "labels" => [
            "name" => "Services",
            "singular_name" => "Services",
            "add_new_item" => "Add new Services",
            "edit_item" => "Edit Services",
            "view_item" => "View Services",
            "view_items" => "View Servicess",
            "search_items" => "Search Servicess",
            "not_found" => "No Servicess found",
            "all_items" => "All Servicess",
            "archives" => "Services archives"
        ],
        "description" => "Servicess provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "menu_icon" => "dashicons-images-alt2",
        "rewrite" => [
            "slug" => "services"
        ],
        "supports" => [
            "title", "editor", "thumbnail", "revisions", "author", "excerpt", "page_attributes"
        ]
    ]);
}

add_action("init", "setup_services");


?>