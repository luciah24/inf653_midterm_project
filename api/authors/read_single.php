<?php
// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate/Create DB and Connect
$database = new Database(); 

// new database object
$db = $database->connect(); 

$author = new Author($db);


$author->id = isset($_GET['id']) ? $_GET['id'] : die();


if ($author->read_single()) 
{
    echo json_encode(array('id' => $author->id, 'author' => $author->author));
}
else
{
    echo json_encode(array("message" => "author_id Not Found"));
}

   