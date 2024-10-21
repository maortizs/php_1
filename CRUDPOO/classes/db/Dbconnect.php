<?php

require_once ROOT_DIR . "/config/dbconfig.php";

class Dbconnect{

    protected $dbconnect;

    public function __construct(){

        try{

            $this->dbconnect = new PDO(DB_DSN, DB_USER, DB_PWD);
            $this->dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        }catch(PDOException $ex){
            echo ("Error en la conexión: ") . $ex->getMessage();
        }
    }
}