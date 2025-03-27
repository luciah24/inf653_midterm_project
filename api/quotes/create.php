<?php

// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate/Create DB and Connect
$database = new Database(); 
$db = $database->connect();        


$quote = new Quote($db);


$data = json_decode(file_get_contents("php://input"));


$quote->quote = isset($data->quote) ? $data->quote : null;
$quote->author_id = isset($data->author_id) ? $data->author_id : null;
$quote->category_id = isset($data->category_id) ? $data->category_id : null;


if (isset($quote->quote) && isset($quote->author_id) && isset($quote->category_id))
{
    if ($quote->create())
    {
        $quote_arr = array('id' => $quote_id, 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' => $quote->category_id);

        print_r(json_encode($quote_arr));

    }
    else
    {

        echo json_encode(array("message" => "Quote Not Created"));
    }

}