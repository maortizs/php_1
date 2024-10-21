<?php

class Empleado{
    private $emp_no;
    private $apellido;
    private $comision;
    private $dept_no;
    private $dir;
    private $fecha_alt;
    private $oficio;
    private $salario;

    

    public function getEmp_no() {
    	return $this->emp_no;
    }

    /**
    * @param $emp_no
    */
    public function setEmp_no($emp_no) {
    	$this->emp_no = $emp_no;
    }

    public function getApellido() {
    	return $this->apellido;
    }

    /**
    * @param $apellido
    */
    public function setApellido($apellido) {
    	$this->apellido = $apellido;
    }

    public function getComision() {
    	return $this->comision;
    }

    /**
    * @param $comision
    */
    public function setComision($comision) {
    	$this->comision = $comision;
    }

    public function getDept_no() {
    	return $this->dept_no;
    }

    /**
    * @param $dept_no
    */
    public function setDept_no($dept_no) {
    	$this->dept_no = $dept_no;
    }

    public function getDir() {
    	return $this->dir;
    }

    /**
    * @param $dir
    */
    public function setDir($dir) {
    	$this->dir = $dir;
    }

    public function getFecha_alt() {
    	return $this->fecha_alt;
    }

    /**
    * @param $fecha_alt
    */
    public function setFecha_alt($fecha_alt) {
    	$this->fecha_alt = $fecha_alt;
    }

    public function getOficio() {
    	return $this->oficio;
    }

    /**
    * @param $oficio
    */
    public function setOficio($oficio) {
    	$this->oficio = $oficio;
    }

    public function getSalario() {
    	return $this->salario;
    }

    /**
    * @param $salario
    */
    public function setSalario($salario) {
    	$this->salario = $salario;
    }

    public function __toString()
    {
        $cadena = "";

        $propiedades = get_object_vars($this);

        foreach($propiedades as $propiedad){
            $cadena .= " " . $propiedad;        
        }

        return $cadena;
    }

    public function toTable()
    {
        $cadena = "";

        $propiedades = get_object_vars($this);

        foreach($propiedades as $propiedad){
            $cadena .= "<td>" . $propiedad . "</td>";
        }

        return $cadena;
    }

    public function toList()
    {
        $cadena = "";

        $propiedades = get_object_vars($this);

        foreach($propiedades as $propiedad){
            $cadena .= "<li>" . $propiedad . "</li>";
        }

        return $cadena;
    }

    public function toArray()
    {
        $array = [];

        $propiedades = get_object_vars($this);

        foreach($propiedades as $nombre => $propiedad){
            $array[$nombre] = $propiedad;
        }

        return $array;
    }
}