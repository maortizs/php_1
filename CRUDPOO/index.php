<?php
define ("ROOT_DIR", __DIR__);

require_once "./classes/db/Dbempleado.php";
//require_once "Empleado.php";

function validarEntrada($data){
    return htmlspecialchars(stripslashes((trim($data))));
}

$emp_no = $apellido = $comision = $dept_no = $dir = $fecha_alt = $oficio = $salario = "";
$boton = "alta";
$mensaje = "Crear empleado nuevo";

$dbempleado = new Dbempleado();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["eliminar"])){
        $emp_no = validarEntrada($_POST["emp_no"]);

        $query = "DELETE FROM empleados WHERE emp_no = :emp_no";

        try{
            $resultado = $dbconnect->prepare($query);
            $resultado->bindValue(":emp_no", $emp_no);
            $resultado->execute();
        }catch(PDOException $ex){
            echo "Error al eliminar: " . $ex->getMessage();
        }
    }

    elseif(isset($_POST["alta"])){
        $query = "SELECT max(emp_no) FROM empleados";
        try{
            $resultado = $dbconnect->prepare($query);
            $resultado->execute();
            $emp_no = $resultado->fetch()[0] + 1; 

            $query = "INSERT INTO empleados (emp_no, apellido, comision, dept_no, dir, fecha_alt, oficio, salario)
                      VALUES (:emp_no, :apellido, :comision, :dept_no, :dir, :fecha_alt, :oficio, :salario)";
            $resultado = $dbconnect->prepare($query);

            $resultado->bindValue(":emp_no", $emp_no);
            $resultado->bindValue(":apellido", validarEntrada($_POST["apellido"]));
            if (empty(validarEntrada($_POST["comision"]))){
                $resultado->bindValue(":comision", '0');
            }else{
                $resultado->bindValue(":comision", validarEntrada($_POST["comision"]));
            }
            $resultado->bindValue(":dept_no", validarEntrada($_POST["dept_no"]));
            $resultado->bindValue(":dir", validarEntrada($_POST["dir"]));
            $resultado->bindValue(":fecha_alt", validarEntrada($_POST["fecha_alt"]));
            $resultado->bindValue(":oficio", validarEntrada($_POST["oficio"]));
            $resultado->bindValue(":salario", validarEntrada($_POST["salario"]));
            $resultado->execute();

            
        }catch(PDOException $ex){
            echo "Error durante el alta: " . $ex->getMessage();
        }
    }
    elseif(isset($_POST["carga_modif"])){
        $query = "SELECT emp_no, apellido, comision, dept_no, dir, fecha_alt, oficio, salario FROM empleados
                WHERE emp_no = :emp_no";
        $boton = "modificar";
        $mensaje = "Modificar empleado";

        try{
            $resultado = $dbconnect->prepare($query);

            $resultado->bindValue(":emp_no", validarEntrada($_POST["emp_no"]));
            $resultado->execute();
            $resultado->setFetchMode(PDO::FETCH_ASSOC);
            $empleado = $resultado->fetch();
            extract($empleado);

            /*extract($empleado) es lo mismo que hacer esto

            $emp_no = $empleado["emp_no"];
            $apellido = $empleado["apellido"];
            $comision = $empleado["comision"];
            $dept_no = $empleado["dept_no"];
            $dir = $empleado["dir"];
            $fecha_alt = $empleado["fecha_alt"];
            $oficio = $empleado["oficio"];
            $salario = $empleado["salario"];

            Es válido para arrays asociativos */
            
        }catch(PDOException $ex){
            echo "Error durante el alta: " . $ex->getMessage();
        }
    }
    elseif(isset($_POST["alta"])){
        $query = "SELECT max(emp_no) FROM empleados";
        try{
            $resultado = $dbconnect->prepare($query);
            $resultado->execute();
            $emp_no = $resultado->fetch()[0] + 1; 

            $query = "INSERT INTO empleados (emp_no, apellido, comision, dept_no, dir, fecha_alt, oficio, salario)
                      VALUES (:emp_no, :apellido, :comision, :dept_no, :dir, :fecha_alt, :oficio, :salario)";
            $resultado = $dbconnect->prepare($query);

            $resultado->bindValue(":emp_no", $emp_no);
            $resultado->bindValue(":apellido", validarEntrada($_POST["apellido"]));
            if (empty(validarEntrada($_POST["comision"]))){
                $resultado->bindValue(":comision", '0');
            }else{
                $resultado->bindValue(":comision", validarEntrada($_POST["comision"]));
            }
            $resultado->bindValue(":dept_no", validarEntrada($_POST["dept_no"]));
            $resultado->bindValue(":dir", validarEntrada($_POST["dir"]));
            $resultado->bindValue(":fecha_alt", validarEntrada($_POST["fecha_alt"]));
            $resultado->bindValue(":oficio", validarEntrada($_POST["oficio"]));
            $resultado->bindValue(":salario", validarEntrada($_POST["salario"]));
            $resultado->execute();

            
        }catch(PDOException $ex){
            echo "Error durante el alta: " . $ex->getMessage();
        }
    }
    elseif(isset($_POST["modificar"])){
        try{
            $query = "UPDATE empleados SET apellido = :apellido, 
                            comision = :comision, dept_no = :dept_no, dir = :dir, 
                            fecha_alt = :fecha_alt, oficio = :oficio, salario = :salario 
                             WHERE emp_no = :emp_no";
                      
            $resultado = $dbconnect->prepare($query);

            $resultado->bindValue(":emp_no", validarEntrada($_POST["emp_no"]));
            $resultado->bindValue(":apellido", validarEntrada($_POST["apellido"]));
            if (empty(validarEntrada($_POST["comision"]))){
                $resultado->bindValue(":comision", '0');
            }else{
                $resultado->bindValue(":comision", validarEntrada($_POST["comision"]));
            }
            $resultado->bindValue(":dept_no", validarEntrada($_POST["dept_no"]));
            $resultado->bindValue(":dir", validarEntrada($_POST["dir"]));
            $resultado->bindValue(":fecha_alt", validarEntrada($_POST["fecha_alt"]));
            $resultado->bindValue(":oficio", validarEntrada($_POST["oficio"]));
            $resultado->bindValue(":salario", validarEntrada($_POST["salario"]));
            $resultado->execute();

            $emp_no = $apellido = $comision = $dept_no = $dir = $fecha_alt = $oficio = $salario = "";
            $boton = "alta";
            $mensaje = "Crear empleado nuevo";

            
        }catch(PDOException $ex){
            echo "Error durante la actualización: " . $ex->getMessage();
        }
    }

}

$empleados = $dbempleado->getEmpleados();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="10">LISTADO DE EMPLEADOS</th>
        </tr>
        <tr>
            <td>Número</td>
            <td>Apellido</td>
            <td>Comisión</td>
            <td>Departamento</td>
            <td>Dirección</td>
            <td>Fecha de alta</td>
            <td>oficio</td>
            <td>Salario</td>
            <td colspan="2"></td>
        </tr>
        <?php foreach($empleados as $empleado):?>
            <tr>
                <?=$empleado->toTable()?>
                <td>
                    <form method="post">
                        <input type="hidden" name="emp_no" value="<?=$empleado->getEmp_no();?>">
                        <input type="submit" name="eliminar" value="Eliminar">
                    </form>
                </td>
                <td>
                <form method="post">
                        <input type="hidden" name="emp_no" value="<?=$empleado->getEmp_no();?>">
                        <input type="submit" name="carga_modif" value="Modificar">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <h3><?=$mensaje?></h3>
    <form method="post">
        <input type="hidden" name="emp_no" value="<?=$emp_no?>">
        <p><label for="apellido">Apellido: </label>
            <input type="text" name="apellido" id="apellido" value="<?=$apellido?>"></p>
        <p><label for="dir">Dirección: </label>
            <input type="text" name="dir" id="dir" value="<?=$dir?>"></p>
        <p><label for="oficio">Oficio: </label>
            <input type="text" name="oficio" id="oficio" value="<?=$oficio?>"></p>
        <p><label for="dept_no">Departamento: </label>
            <input type="text" name="dept_no" id="dept_no" value="<?=$dept_no?>"></p>
        <p><label for="salario">Salario: </label>
            <input type="text" name="salario" id="salario" value="<?=$salario?>"></p>
        <p><label for="comision">Comisión: </label>
            <input type="text" name="comision" id="comision" value="<?=$comision?>"></p>
        <p><label for="fecha_alt">Fecha de alta: </label>
            <input type="text" name="fecha_alt" id="fecha_alt" value="<?=$fecha_alt?>"></p>
        <p><input type="submit" name="<?=$boton?>" value="Enviar"></p>
    </form>
</html>