<?php

function setup_contact() {
    register_post_type("Contact", [
        "label" => "Contact",
        "labels" => [
            "name" => "Contact",
            "singular_name" => "Contact",
            "add_new_item" => "Add new Contact",
            "edit_item" => "Edit Contact",
            "view_item" => "View Contact",
            "view_items" => "View Contact",
            "search_items" => "Search Contact",
            "not_found" => "No Contact found",
            "all_items" => "All Contact",
            "archives" => "Contact archives"
        ],
        "description" => "Contact provided by Netiapps",
        "public" => true,
        'has_archive' => true,
        "show_in_rest" => true,
        "contact_icon" => "dashicons-twitch",
        "rewrite" => [
            "slug" => "contact"
        ],
        "supports" => [
            "title", "editor", "revisions", "author", "excerpt", "page_attributes","thumbnail"
        ]
       

    ]);

   
}

add_action("init", "setup_contact");


?>