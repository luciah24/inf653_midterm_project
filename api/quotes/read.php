<?php

// accessing our front-facing API
// Header notic how the heder names are in capital letters 
// GET request 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate/Create DB and Connect
$database = new Database(); // new database object
$db = $database->connect(); // the connect pre-defined function


// Instantiate/create new (blog) post object
$quote = new Quote($db);


// gather the post query 
$result = $quote->read();

$num = $result->rowCount(); // pre-defined row count function


if ($num > 0)
{
    // post_array local variable that is empty 
    $quotes_arr = array();
    $quotes_arr["data"] = array();


    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row); // this is an alternative to $row['title']; gets the title from said row 

        // QUOTE ITEM
        $quote_item = array(
            'id' => $id,  
            'quote' => $quote,
            'author_id' => $author_id,
            'category_id' => $category_id
        );

        // Push to "data"
        array_push($quotes_arr['data'], $quote_item);
    }


    echo json_encode($quotes_arr);

}
else
{

    echo json_encode(array("message" => "No Quotes Found"));
    // just learned that with the array pre-defined function you can create a message.
}