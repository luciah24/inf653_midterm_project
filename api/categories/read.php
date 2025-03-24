<?php

// accessing our front-facing API
// Header notic how the heder names are in capital letters 
// GET request 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate/Create DB and Connect
$database = new Database(); // new database object
$db = $database->connect(); // the connect pre-defined function


// Instantiate/create new (blog) post object
$category = new Category($db);


// gather the post query 
$result = $category->read();

$num = $result->rowCount(); // pre-defined row count function


// Check for any posts
if ($num > 0)
{
    // post_array local variable that is empty 
    $categories_arr = array();
    $categories_arr["data"] = array();


    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row); // this is an alternative to $row['title']; gets the title from said row 

        // CATEGORY ITEM
        $category_item = array(
            'id' => $id,  
            'category' => $category
        );

        // Push to "data"
        array_push($categories_arr['data'], $category_item);
    }


    // Turn/encode to JSON and output; pass in empty posts_arr
    echo json_encode($categories_arr);

}
else
{

    // else if there are No Posts
    echo json_encode(array("message" => "No Categories Found"));
    // just learned that with the array pre-defined function you can create a message.
}