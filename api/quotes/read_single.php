<?php

// accessing our front-facing API
// Header notic how the heder names are in capital letters 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate/Create DB and Connect
$database = new Database(); // new database object
$db = $database->connect(); // the connect pre-defined function


// Instantiate/create new (blog) post object
$quote = new Quote($db);

// GET ID. this allows us to define a value in the url applied to Postman
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();



$quote->read_single();


// Create Array. We are assigning values to the columns or keys
// From this array, Postman returns the 6 properties that we have set below 
$quote_arr = array(
'id' => $quote->id,
'quote' => $quote->quote,
'author_id' => $quote->author_id,
'category_id' => $quote->category_id

);


// Make JSON via the print_r and json_encode pre-defined fucntions
print_r(json_encode($quote_arr));