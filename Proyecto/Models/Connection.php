<?php

require_once('Config.php');

class Connection
{

    private $host;
    private $user;
    private $password;
    private $database;

    public function __construct()
    {
        $this->host = constant("HOST");
        $this->user = constant("USER");
        $this->password = constant("CLAVE");
        $this->database = constant("DATABASE");
    }

    public function connect()
    {
        $connect = "";
        try {
            $connect = new mysqli($this->host, $this->user, $this->password, $this->database);
        } catch (Exception $e) {
            echo $e;
        }
        return $connect;
    }
}
