<?php

// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate/Create DB and Connect
$database = new Database(); 

// new database object
$db = $database->connect(); 


// Instantiate/create new author object
$author = new Author($db);


$data = json_decode(file_get_contents("php://input"));



 $author->id = isset($data->id) ? $data->id : null;


if (isset($author->id))
{ 
        
    if ($author->delete())
    {

        $author_arr = array('id' => $author->id);

        print_r(json_encode($author_arr));
    }
    else
    {
        echo json_encode(array('message' => 'Author Not Deleted'));
    }
    
}

