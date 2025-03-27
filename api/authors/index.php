<?php
    
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     $method = $_SERVER['REQUEST_METHOD'];
 
     if ($method === 'OPTIONS')
     {
         header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
         header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
         exit();
     } 

     if ($method === 'GET') 
     {
        try 
        {
            if (isset($_GET['id']))
                include_once 'read_single.php' ;
           else
                include_once 'read.php';
        }
        catch(PDOException $e) 
        {
            echo("Read_single or read file not found: " . $e->getMessage());
        }
     }
     else if ($method === 'POST') 
     {
        try 
        {
            include_once 'create.php';
        }
        catch(PDOException $e)  
        {
            echo("Create file not found: " . $e->getMessage());
        }
     }
     else if ($method === 'PUT') 
     {
        try {
            include_once 'update.php';
        }
        catch(PDOException $e)  
        {
            echo("Update file not found: " . $e->getMessage());
        }
     }
     else if ($method === 'DELETE') 
     {
        try 
        {
            include_once 'delete.php'; 
        }
        catch(PDOException $e)  
        {
            echo("Delete file not found: " . $e->getMessage());
        }
     }
     else
        echo ("No action requested");

