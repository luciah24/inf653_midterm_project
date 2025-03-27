<?php

// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");



include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate/Create DB and Connect
$database = new Database(); 

// new database object
$db = $database->connect(); 


$author = new Author($db);


$data = json_decode(file_get_contents("php://input"));


if(!isset($data->id) || !isset($data->author))
{

  echo json_encode(array('message' => 'Missing Required Parameters'));
  exit();

}


$author->id = $data->id;

$author->author = $data->author;



if ($author->update())
{
    // encode to JSON    
    echo json_encode(array('id' => $author->id, 'author' => $author->author));
}
else
{
    echo json_encode(array("message" => "Author Not Updated"));

}