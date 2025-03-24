<?php

// accessing our front-facing API
// Header notic how the heder names are in capital letters 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
// the above header values all must be on ONE LINE 


include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate/Create DB and Connect
$database = new Database(); // new database object
$db = $database->connect(); // the connect pre-defined function


$quote = new Quote($db);



$data = json_decode(file_get_contents("php://input"));



// Set ID to update; again, these are the categories, so to speak, that we are updating
// or put differently, these all the columns need to be shown 
$quote->id = $data->id;

$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;



if ($quote->update())
{
    // encode to JSON
    echo json_encode(array("message" => "Quote Updated"));

}
else
{

    echo json_encode(array("message" => "Quote Not Updated"));
}