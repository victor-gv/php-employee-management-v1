<?php
session_start();
include('./employeeManager.php');

//request method is GET, call the getQueryStringParameters() function
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    getQueryStringParameters($_GET["empl"]);
    
} else if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST["info"])){
        //gte the info to Show in employee.php
        $employeeData = getEmployee($_POST["info"]);
        $_SESSION["employeeData"] = $employeeData;
        
        
        header ("Location: ../employee.php?info=true");

    }else if(isset($_POST["employee"])){
        //UpdateEmployee
        if($_POST["employee"] != "0"){
            echo "actualizando empleado";
            $employeeActive = array(
                "id" => $_POST["employee"],
                "name" => $_POST["name"],
                "lastName" => $_POST["lastName"],
                "email" => $_POST["email"],
                "gender" =>$_POST["gender"],
                "age" => $_POST["age"],
                "streetAddress" => $_POST["streetAddress"],
                "city" => $_POST["city"],
                "state" => $_POST["state"],
                "postalCode" => $_POST["postalCode"],
                "phoneNumber" => $_POST["phoneNumber"]);
        
            updateEmployee($employeeActive);
        }else{
            //CreateEmployee
            $newEmployee = array(
                "id" => "",
                "name" => $_POST["name"],
                "lastName" => $_POST["lastName"],
                "email" => $_POST["email"],
                "gender" =>$_POST["gender"],
                "age" => $_POST["age"],
                "streetAddress" => $_POST["streetAddress"],
                "city" => $_POST["city"],
                "state" => $_POST["state"],
                "postalCode" => $_POST["postalCode"],
                "phoneNumber" => $_POST["phoneNumber"]);
            addEmployee($newEmployee, 0);

        }
    }else{
        //Make the post for delete or add employee, the array in fecth will take 1 element if wants to delete employee or more elements in other case
        $data = count(json_decode(file_get_contents('php://input'), true));
        if ($data > 1) {//Add employ 
            $newEmployee = file_get_contents('php://input');
            $newEmployee = json_decode($newEmployee, true);
            addEmployee($newEmployee, 1);
        } else {//Delete employee
            $deletedEmployee = file_get_contents('php://input');
            $deletedEmployee = json_decode($deletedEmployee, true);
            deleteEmployee($deletedEmployee['id']);
        }
    }
}