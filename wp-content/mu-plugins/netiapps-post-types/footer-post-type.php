<?php

function setup_footer() {
    register_post_type("Footer Section", [
        "label" => "Footer Section",
        "labels" => [
            "name" => "Footer Section",
            "singular_name" => "Footer Section",
            "add_new_item" => "Add new Footer Section",
            "edit_item" => "Edit Footer Section",
            "view_item" => "View Footer Section",
            "view_items" => "View Footer Section",
            "search_items" => "Search Footer Section",
            "not_found" => "No Footer found",
            "all_items" => "All Footer Section",
            "archives" => "Footer Section archives"
        ],
        "description" => "Footer Section provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "footer_icon" => "dashicons-twitch",
        "rewrite" => [
            "slug" => "footer-section"
        ],
        "supports" => [
            "title", "editor", "revisions", "author", "excerpt", "page_attributes","thumbnail"
        ]
       

    ]);

   
}

add_action("init", "setup_footer");


?>