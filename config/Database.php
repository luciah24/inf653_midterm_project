
<?php
class Database { 

// we need to connect to the Azure Postgres database

private $host = 'dpg-cvaqbdlrie7s73985udg-a.ohio-postgres.render.com'; // host URL from Render.com
// or the host name is either dpg-cvaqbdlrie7s73985udg-a  
private $port = '5432';  // default PostgreSQL port
private $db_name = 'quotesdb_yv0r';
private $username = 'quotesdb_yv0r_user';
private $password = 'nGtaHiuBLgNcj5aN39YVEkeBSaJzsJH6';
private $conn;

// the .htaccess file is only for your local development environment.

// now, in the .htaccess file we have to set environement variables so that we can 
// use it in in our local development environment 

// "When you deploy your PHP project to Render, you will set the environment variables in the project settings. 
// Never send files like .htaccess (that contain passwords to GitHub) 
// Don't worry about deploying PHP to Render yet. We have not discussed those details.



public function connect() 
{

    $this->conn = null;


    // fetch credentials safely from environment variables
    $host = getenv('HOST');
    $port = getenv('PORT');
    $db_name = getenv('DBNAME');
    $username = getenv('USERNAME');
    $password = getenv('PASSWORD');

    // to ensure that no missing environment variables
    if (!$host || !$port || !$db_name || !$username || !$password) {
    die(json_encode(["error" => "Database environment variables are not set properly."]));
    }

    

    $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

    try 
    {

    $this->conn = new PDO($dsn, $this->username, $this->password);

    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } 
    catch (PDOException $e) 
    {
    // echo for tutorial, but log the error for production

    echo 'Connection Error: ' . $e->getMessage();


    }

    return $this->conn;

}

}

