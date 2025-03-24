<?php


header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }


    include_once '../../config/Database.php';
    

    // Instantiate DB & connect
    $database = new Database();
    $pdo = $database->connect(); // Get the database connection



    // Handle GET request to fetch all categories
if ($method === 'GET') {
    try {
        
        // Fetch categories from database
        $query = "SELECT * FROM categories";
        $stmt = $pdo->query($query);
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($categories) {
            echo json_encode($categories);
        } else {
            echo json_encode(["message" => "No categories found."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}
?>