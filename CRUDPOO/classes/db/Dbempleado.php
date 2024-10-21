<?php

require_once ROOT_DIR . "/classes/db/Dbconnect.php";
require_once ROOT_DIR . "/classes/app/Empleado.php";

class Dbempleado extends Dbconnect{

    public function __construct(){
        parent::__construct();
    }


    public function getEmpleados(){

        $query = "SELECT emp_no, apellido, comision, dept_no, dir, fecha_alt, oficio, salario FROM empleados";

        try{
            $resultado = $this->dbconnect->prepare($query);

            $resultado->execute();

            $empleados = $resultado->fetchAll(PDO::FETCH_CLASS, 'Empleado');

            return $empleados;
        }catch(PDOException $ex){
            echo "Error en la selección: " . $ex->getMessage();
        }
    }

}