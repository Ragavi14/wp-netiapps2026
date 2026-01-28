<?php

function setup_careersList() {
    register_post_type("CareersList", [
        "label" => "Careers List",
        "labels" => [
            "name" => "CareersList",
            "singular_name" => "CareersList",
            "add_new_item" => "Add new CareersList",
            "edit_item" => "Edit CareersList",
            "view_item" => "View CareersList",
            "view_items" => "View CareersLists",
            "search_items" => "Search CareersLists",
            "not_found" => "No CareersLists found",
            "all_items" => "All CareersLists",
            "archives" => "CareersList archives"
        ],
        "description" => "CareersLists provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "menu_icon" => "dashicons-images-alt2",
        "rewrite" => [
            "slug" => "careers-list"
        ],
        "supports" => [
            "title", "editor", "thumbnail", "revisions", "author", "excerpt", "page_attributes"
        ]
    ]);
}

add_action("init", "setup_careersList");


?>