<?php

// Start session

// simple autoload
spl_autoload_register(function ($class_name) {
    include 'class/' . $class_name . '.php';
});

// database config
 

// Define base URL
const BASE_URL = 'http://localhost:8000/user-crud/'; //  sesuaikan dengan nama folder 

// navigasi config
const NAV_PAGES = [
    ['title' => 'Home',    'url' => 'index.php'],
    ['title' => 'Members', 'url' => 'members.php'],
    ['title' => 'New',     'url' => 'create.php'],
    ['title' => 'Profile', 'url' => 'profile.php'],
    ['title' => 'Gallery', 'url' => 'Gallery.php'],
    ['title' => 'Contact', 'url' => 'Contact.php'],
    ['title' => 'Logout',  'url' => 'logout.php']
];

