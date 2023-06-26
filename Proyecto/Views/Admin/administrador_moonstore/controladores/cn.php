<?php
require_once('Config.php');
class cn
{
    private  $servidor;
    private  $usuario;
    private  $clave;
    private  $db;
    public function __construct()
    {
        $this->servidor = constant("HOST");
        $this->usuario = constant("USER");
        $this->clave = constant("CLAVE");
        $this->db = constant("DATABASE");
    }

    public function cn()
    {
        $conec = new mysqli($this->servidor, $this->usuario, $this->clave, $this->db);
        return $conec;
    }
}
