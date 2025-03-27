<?php
// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate/Create DB and Connect
$database = new Database();
$db = $database->connect(); 

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));


$category->id = isset($data->id) ? $data->id : null;



if ($category->delete())
{

    echo json_encode(value: array("message" => "Category Deleted"));

}
else
{

    echo json_encode(value: array("message" => "Category Not Deleted"));

}