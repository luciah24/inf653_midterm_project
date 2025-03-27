

<?php 

class Category
{
// DB
private $conn;
private $table = 'categories'; 

// properties
public $id;
public $category;  


// Constructor with DB
public function __construct($db)  
{

    $this->conn = $db;

}


public function read()
{
  
  $query = 'SELECT 
   id,
   category
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


public function read_single()
{

  $query = 'SELECT  
  id,
  category
  FROM ' . $this->table . '
  WHERE id = ?
  LIMIT 1'; // want to retrive 1 record





    // prepare and execute by way of a try-catch block 
    try 
    {

        $stmt = $this->conn->prepare($query);


        // Bind Params
        $stmt->bindParam(1, $this->id);


        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) 
        {
            // Set properties only if a row is found
            $this->id = $row['id'];
            $this->category = $row['category'];

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
    (category) 
    VALUES (:category)'; 
  
    // prepare and execute by way of a try-catch block 
    try 
    {

        $stmt = $this->conn->prepare($query);


        // Clean Data 
        $this->category = htmlspecialchars(strip_tags($this->category));
    
        // Bind Params
        $stmt->bindParam(':category', $this->category);
    
    
    
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
      category = :category
    WHERE
      id = :id';




    // prepare and execute by way of a try-catch block 
    try 
    {
        $stmt = $this->conn->prepare($query);


        // Clean Data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));

        // Bind Params
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);


        if ($stmt->execute())
        {
        return true;
        }
        else
        {

            // Print error if something goes wrong
            printf('Error: %s.\n', $stmt->error); 

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
  WHERE id = :id';

  


    try 
    {

        $stmt = $this->conn->prepare($query);

        // Clean Data 
        $this->id = htmlspecialchars(strip_tags($this->id));


        // Bind Params
        $stmt->bindParam(':id', $this->id);


        if ($stmt->execute())
        {
            return true;
        }
        else
        {

            // Print error if something goes wrong
            printf('Error: %s.\n', $stmt->error); 

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





