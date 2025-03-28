<?php

// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate/Create DB and Connect
$database = new Database(); 
$db = $database->connect(); 


$quote = new Quote($db);


$data = json_decode(file_get_contents("php://input"));


$quote->id = isset($data->id) ? $data->id : null;


if ($quote->delete())
{
    $quote_arr = array('id' => $quote->id);

    print_r(json_encode($quote_arr));
}
else
{
    echo json_encode(array('message' => 'No Quotes Found'));  
}