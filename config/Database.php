
<?php
class Database { 

private $conn;
private $host;
private $port;
private $dbname;
private $username;
private $password;


public function __construct()
{

    // fetch credentials safely from environment variables
    $this->host = getenv('HOST');
    $this->port = getenv('PORT');
    $this->dbname = getenv('DBNAME');
    $this->username = getenv('USERNAME');
    $this->password = getenv('PASSWORD');

}

public function connect() 
{

    $this->conn = null;

    $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";

    try 
    {

        $this->conn = new PDO($dsn, $this->username, $this->password);

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } 
    catch (PDOException $e) 
    {

        echo 'Connection Error: ' . $e->getMessage();


    }

    return $this->conn;

}

}

