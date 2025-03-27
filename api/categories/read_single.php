<?php
// accessing our front-facing API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate/Create DB and Connect
$database = new Database();
$db = $database->connect(); 

$category= new Category($db);

$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$category->read_single();




if ($category->read_single())
{

    echo json_encode(array('id' => $category->id, 'category' => $category->category));
}
else
{

    echo json_encode(array("message" => "Category Not Found"));

}