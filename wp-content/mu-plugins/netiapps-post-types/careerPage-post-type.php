<?php

function setup_careerPage() {
    register_post_type("CareerPage", [
        "label" => "CareerPage",
        "labels" => [
            "name" => "Career",
            "singular_name" => "CareerPage",
            "add_new_item" => "Add new CareerPage",
            "edit_item" => "Edit CareerPage",
            "view_item" => "View CareerPage",
            "view_items" => "View CareerPage",
            "search_items" => "Search CareerPage",
            "not_found" => "No CareerPage found",
            "all_items" => "All CareerPage",
            "archives" => "CareerPage archives"
        ],
        "description" => "CareerPage provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "careerPage_icon" => "dashicons-twitch",
        "rewrite" => [
            "slug" => "careerPage"
        ],
        "supports" => [
            "title", "editor", "revisions", "author", "excerpt", "page_attributes","thumbnail"
        ]
       

    ]);

   
}

add_action("init", "setup_careerPage");


?>