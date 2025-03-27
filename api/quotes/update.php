<?php

// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");



include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate/Create DB and Connect
$database = new Database(); 
$db = $database->connect(); 


$quote = new Quote($db);


$data = json_decode(file_get_contents(filename: "php://input"));


$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;


 
if (isset($quote->quote) && isset($quote->author_id) && isset($quote->category_id))
{
    if ($quote->update())
    {
        $quote_arr = array('id' => $quote->id, 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' => $quote->category_id);

        echo json_encode($quote_arr);

    }
    else
    {

        echo json_encode(array("message" => "No Quotes Found"));
    }

}
else if (!isset($quote->author_id) && isset($quote->category_id))
{
    echo json_encode( array('message' => 'author_id Not Found')); 

}
else if (isset($quote->author_id) && !isset($quote->category_id)) 
{
    echo json_encode(array('message' => 'category_id Not Found')); 
}
else
{
    echo json_encode(array('message' => 'Missing Required Parameters')); 
}