
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConnection
 *
 * @author Annette
 */
class DBConnection{

    private $servername;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    function __construct(){
        $this->servername = "localhost";
        $this->dbname = "vonbulowplanning";
        $this->username = "root";
        $this->password = "root";
        $this->pdo = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
    }
    
    public function prepare($q){
        $stmt=$this->pdo->prepare($q);
        return $stmt;
    }
    
    public function close(){
        unset($this->pdo);
    }

}
