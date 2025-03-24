<?php

// accessing our front-facing API
// Header notic how the heder names are in capital letters 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
// the above header values all must be on ONE LINE 


include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate/Create DB and Connect
$database = new Database(); // new database object
$db = $database->connect(); // the connect pre-defined function


// Instantiate/create new (blog) post object
$quote = new Quote($db);


// Gt the raw posted data 
$data = json_decode(file_get_contents("php://input"));



if ($quote->delete())
{
    // encode to JSON
    echo json_encode(array("message" => "Quote Deleted"));

}
else
{

    echo json_encode(array("message" => "Quote Not Deleted"));
}