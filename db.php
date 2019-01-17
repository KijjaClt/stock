<?php

class DB
{
    private $servername = "localhost";
    private $username = "stock";
    private $password = "stock@2019";
    private $dbname = "stock";

    private $conn;

    public function connect()
    {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql)
    {
        mysqli_query($this->conn, "set names 'utf8'");
        return mysqli_query($this->conn, $sql);
    }

    public function close()
    {
        $this->conn->close();
    }
}
