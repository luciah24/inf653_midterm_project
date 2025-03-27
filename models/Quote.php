

<?php 

class Quote
{
// DB 
private $conn;
private $table = 'quotes';  

// properties
public $id;
public $quote;  
public $author_id;  
public $category_id; 
public $author;
public $category;



// Constructor with DB
public function __construct($db) 
{

    $this->conn = $db;

}


public function read()
{

  $query = 'SELECT 
  q.id,
  q.quote,
  a.author,
  c.category
  FROM ' . $this->table . ' AS q 
  LEFT JOIN authors AS a ON q.author_id = a.id 
  LEFT JOIN categories AS c ON q.category_id = c.id';
  

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
  q.id,
  q.quote,
  a.author,
  c.category
  FROM ' . $this->table . ' AS q 
  LEFT JOIN authors AS a ON q.author_id = a.id 
  LEFT JOIN categories AS c ON q.category_id = c.id
  WHERE q.id = ?
  LIMIT 1';
  


    // prepare and execute by way of a try-catch block 
    try 
    {

        $stmt = $this->conn->prepare($query);


        // Bind Param
        $stmt->bindParam(1, $this->id);
    

        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) 
        {
            // Set properties only if a row is found
            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author = $row['author'];
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
    (quote, author_id, category_id)
    VALUES (:quote, :author_id, :category_id)';


  
    // prepare and execute by way of a try-catch block 
    try 
    {

        $stmt = $this->conn->prepare($query);


        // Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    
        // Bind Params
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
    
    
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





public function update() 
{

    $query = 'UPDATE ' . $this->table . '
    SET
      quote = :quote,
      author_id = :author_id,
      category_id = :category_id
    WHERE
      id = :id';




    // prepare and execute by way of a try-catch block 
    try 
    {
        $stmt = $this->conn->prepare($query);


        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    
        // Bind Params
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
    


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



