
<?php 

class Author
{
// DB 
private $conn;
private $table = 'authors'; 

// properties
public $id;
public $author;  


// Constructor with DB
public function __construct($db) 
{

    $this->conn = $db;

}


public function read()
{
 
  $query = 'SELECT 
   id,
   author
  FROM ' . $this->table .
  ' ORDER BY id ASC'; 




    // prepare and execute by way of a try-catch block 
    try 
    {

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;

        

    }
    catch(PDOException $e)
    {

        echo json_encode(array('error' => 'SQL error found', 'message' => $e->getMessage()));

        // to indicate failure 
        return null;
    }




}


// Get Single Author 
public function read_single()
{

  $query = 'SELECT  
  id,
  author
  FROM ' . $this->table . '
  WHERE id = ?
  LIMIT 1'; // want to retrive 1 record





    // prepare and execute by way of a try-catch block 
    try 
    {

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

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
        
        echo json_encode(array('error' => 'SQL error found', 'message' => $e->getMessage()));

        // to indicate failure 
        return null;   
    }





}


public function create() 
{

    
    $query = 'INSERT INTO ' . $this->table . ' 
    (author) 
    VALUES (:author)'; 


    // prepare and execute by way of a try-catch block 
    try 
    {

        $stmt = $this->conn->prepare($query);


        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));
    
        // Bind Params
        $stmt->bindParam(':author', $this->author);
    
    
    
        if ($stmt->execute())
        {

            return true;
        }
        else
        {

            // Print error if something goes wrong
            printf('Error: %s.\n', $stmt->error); // via the pre-defined error member variable
        
            return false; 

        }
    
       
    

    }
    catch(PDOException $e)
    {

        echo json_encode(array('error' => 'SQL error found', 'message' => $e->getMessage()));

        // to indicate failure 
        return null;   
    }


}



public function update() 
{


  $query = 'UPDATE ' . $this->table . '
    SET
      author = :author
    WHERE
      id = :id';




    // prepare and execute by way of a try-catch block 
    try 
    {
        $stmt = $this->conn->prepare($query);


        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));
       
        //Bind data
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute())
        {
        return true;
        }
        else
        {
            
            // Print error if something goes wrong
            printf('Error: %s.\n', $stmt->error); // via the pre-defined error member variable

            return false; 


        }
    



    }
    catch(PDOException $e)
    {

        echo json_encode(array('error' => 'SQL error found', 'message' => $e->getMessage()));

        // to indicate failure 
        return null;   
    }


}



public function delete()
{
  // delete query
  $query = 'DELETE FROM ' . $this->table . '
  WHERE
   id = :id';

  


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
        else
        {

            // Print error if something goes wrong
            printf('Error: %s.\n', $stmt->error); // via the pre-defined error member variable

            return false; 
        
        }
        

       

    }
    catch(PDOException $e)
    {

        echo json_encode(array('error' => 'SQL error found', 'message' => $e->getMessage()));

        // to indicate failure 
        return null;   
    }
}


}

