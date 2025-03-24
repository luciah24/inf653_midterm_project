<?php

// accessing our front-facing API
// Header notic how the heder names are in capital letters 
// GET request 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate/Create DB and Connect
$database = new Database(); // new database object
$db = $database->connect(); // the connect pre-defined function


// Instantiate/create new (blog) post object
$author = new Author($db);


// gather the post query 
$result = $author->read();

$num = $result->rowCount(); // pre-defined row count function


// Check for any posts
if ($num > 0)
{
    // post_array local variable that is empty 
    $authors_arr = array();
    $authors_arr["data"] = array();


    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row); // this is an alternative to $row['title']; gets the title from said row 

        // AUTHOR ITEM
        $author_item = array(
            'id' => $id,  
            'author' => $author
        );

        // Push to "data"
        array_push($authors_arr['data'], $author_item);
    }


    // Turn/encode to JSON and output; pass in empty posts_arr
    echo json_encode($authors_arr);

}
else
{

    // else if there are No Posts
    echo json_encode(array("message" => "No Authors Found"));
    // just learned that with the array pre-defined function you can create a message.
}