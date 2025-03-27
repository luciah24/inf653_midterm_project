<?php
// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../../config/Database.php';
include_once '../../models/Author.php';


// Instantiate/Create DB and Connect
$database = new Database(); 
$db = $database->connect();


$author = new Author($db);

$result = $author->read();

$num = $result->rowCount(); 

// Check for any athors
if ($num > 0)
{

   $authors_arr = array();

   while ($row = $result->fetch(PDO::FETCH_ASSOC))
   {
        extract($row); 

         // AUTHOR ITEM        
        $author_item = array('id' => $id, 'author' => $author);

        // Push to "data"
        array_push($authors_arr, $author_item);
    }


    echo json_encode($authors_arr);
}
else
{
 
    // else if there are No Authors 
    echo json_encode(array("message" => "No Authors Found"));

}