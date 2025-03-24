<?php

// accessing our front-facing API
// Header notic how the heder names are in capital letters 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate/Create DB and Connect
$database = new Database(); // new database object
$db = $database->connect(); // the connect pre-defined function


// Instantiate/create new (blog) post object
$author = new Author($db);

// GET ID. this allows us to define a value in the url applied to Postman
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get post 
$author->read_single();


// Create Array. We are assigning values to the columns or keys
// From this array, Postman returns the 6 properties that we have set below 
$author_arr = array(
'id' => $author->id,
'author' => $author->author 
);


// Make JSON via the print_r and json_encode pre-defined fucntions
print_r(json_encode($author_arr));