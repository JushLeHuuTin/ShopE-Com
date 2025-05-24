<?php
$filepath = realpath(dirname(__FILE__));
include($filepath. '/../config/config.php');
?>
<?php
class Database extends PDO
{
    public $host = DB_HOST;
    public $user = DB_USER;
    public $password = DB_PASS;
    public $dBname = DB_NAME;
    public $dBport = DB_PORT;

    public $link;
    public $erros;

    public function __construct()
    {
        $this->connectDB();
        echo $this->connectDB();
    }

    public function connectDB()
    {
        $this->link = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->dBname,
            $this->dBport
        );
        if (!$this->link) {
            $this->error = "Connection fail" . $this->link->connect_error;
            die($this->error);
            return false;
        }
    }
    public function select($query)
  {
    $result = $this->link->query($query);
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return false;
    }
  }

  // Insert data
  public function insert($query)
  {
    $insert_row = $this->link->query($query);
    if ($insert_row) {
      return $insert_row;
    } else {
      return false;
    }
  }

  // Update data
  public function update($query)
  {
    $update_row = $this->link->query($query);
    if ($update_row) {
      return $update_row;
    } else {
      return false;
    }
  }

  // Delete data
  public function delete($query)
  {
    $delete_row = $this->link->query($query);
    if ($delete_row) {
      return $delete_row;
    } else {
      return false;
    }
  }

}