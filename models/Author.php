
<?php 

// ALL THAT IS PERTAINING TO THE AUTHOR TABLE
class Author
{
// DB stuff
private $conn;
private $table = 'authors'; 


public $id;
public $author;  


//Constructor with DB
public function __construct($db) // that's 2 underscores for the standard construct function 
{

    $this->conn = $db;

}


// Let's Get the Authors
public function read()
{
 
  $query = "SELECT 
   id,
   author
  FROM " . $this->table; // query has been created 





    // prepare and execute by way of a try-catch block 
    try 
    {

        
    // Prepare Statement by connecting to the query 
    // create a $stmt member variable and use the prepare pre-defined/built-in function 
    

    // $stmt statement goes here

    $stmt = $this->conn->prepare($query);


    // Execute query via the execute pre-defined/built-in function 
    // need the execute pre-defined function to execute the query 
    $stmt->execute();
    

    return $stmt;

    

    }
    catch(PDOException $e)
    {

        // json converted error message goes here; "in JSON"
        echo json_encode(array("error" => "SQL error found", "message" => $e->getMessage()));


        // to indicate failure 
        return null;
    }




}


// Get Single Author 
public function read_single()
{

  $query = "SELECT  
  id,
  author
  FROM " . $this->table . "
  WHERE id = ?
  LIMIT 1"; // want to retrive 1 record





    // prepare and execute by way of a try-catch block 
    try 
    {

        
    // Prepare Statement by connecting to the query 
    // create a $stmt member variable and use the prepare pre-defined/built-in function 
    

    // $stmt statement goes here

    $stmt = $this->conn->prepare($query);


    
    // Bind ID via the bindParam pre-defined function
    $stmt->bindParam(1, $this->id);


    // need the execute pre-defined function to execute the query 
    $stmt->execute();


    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) 
    {
        // Set properties only if a row is found
        $this->id = $row['id'];
        $this->author = $row['author'];

        return true;
    } 
    else 
    {
        // if there is no record found, return false
        return false;
    }

    
    

    }
    catch(PDOException $e)
    {

        // json converted error message goes here; "in JSON"
        echo json_encode(array("error" => "SQL error found", "message" => $e->getMessage()));


        // to indicate failure 
        return null;   
    }





}


public function create() 
{

    
    $query = "INSERT INTO " . $this->table . " 
    (author) 
    VALUES (:author)"; // do not need to insert id since the database will automatically 
    // insert or handle the id for us 



  
    // prepare and execute by way of a try-catch block 
    try 
    {

        $stmt = $this->conn->prepare($query);


        // Clean data by wrapping them in security functions because we do not want 
        // threats of any kind
        // also, we do not want tags which is why we are also using the strip_tags function
        $this->author = htmlspecialchars(strip_tags($this->author));
    
        // Bind Params
        $stmt->bindParam(':author', $this->author);
    
    
    
        if ($stmt->execute())
        {
        return true;
        }
        
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error); // via the pre-defined error member variable
    
    
        return false; 
    

    }
    catch(PDOException $e)
    {

        // json converted error message goes here; "in JSON"
        echo json_encode(array("error" => "SQL error found", "message" => $e->getMessage()));


        // to indicate failure 
        return null;   
    }


}



public function update() 
{


  $query = "UPDATE " . $this->table . "
    SET
      author = :author
    WHERE
      id = :id";




    // prepare and execute by way of a try-catch block 
    try 
    {
        $stmt = $this->conn->prepare($query);


        // Clean data by wrapping them in security functions because we do not want 
        // threats of any kind
        // also, we do not want tags which is why we are also using the strip_tags function
        $this->author = htmlspecialchars(strip_tags($this->author));

        // Bind Params
        $stmt->bindParam(':author', $this->author);


        if ($stmt->execute())
        {
        return true;
        }
        

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error); // via the pre-defined error member variable


        return false; 



    }
    catch(PDOException $e)
    {

        // json converted error message goes here; "in JSON"
        echo json_encode(array("error" => "SQL error found", "message" => $e->getMessage()));


        // to indicate failure 
        return null;   
    }


}



public function delete()
{
  // delete query
  $query = "DELETE FROM " . $this->table . "
  WHERE
   id = :id";

  


    try 
    {


        $stmt = $this->conn->prepare($query);

        // Clean data 
        $this->id = htmlspecialchars(strip_tags($this->id));


        // Bind data
        $stmt->bindParam(':id', $this->id);


        if ($stmt->execute())
        {
        return true;
        }
        

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error); // via the pre-defined error member variable


        return false; 

    }
    catch(PDOException $e)
    {

        // json converted error message goes here; "in JSON"
        echo json_encode(array("error" => "SQL error found", "message" => $e->getMessage()));


        // to indicate failure 
        return null;   
    }
}


}

