<?php
include "../function/function.php";
session_start();
#login for customer
if (isset($_POST["userLogin"] )) {
    try{
    $email=test_input($_POST["userEmail"]);
        $password=PASSWORD($_POST["userPassword"]);
        $sql=$conn->prepare("SELECT * FROM user_info WHERE email='$email' AND password='$password' ");
    $sql->execute();
    $row=$sql->rowCount();
    if ($row==1){
        $result=$sql->fetch(PDO::FETCH_ASSOC);
        $status=$result["status"];
        if ($status==0){
            errorMess("User account blocked ");
        }else{
            $_SESSION["user_id"]=$result["user_id"];
            $_SESSION["firstName"]=$result["firstName"];
            echo true;
        }
    } else {
        errorMess ("User not found "); 
        //echo PASSWORD($password) $row  $email;
    }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
if(isset($_POST["admin_login"] )){
        $admin_name=test_input($_POST["admin_name"]);
        $password=PASSWORD($_POST["password"]);
    try{
       if(empty($admin_name)){
            errorMess("Admin name is empty");
        }
        else if(empty($password)){
            errorMess("Passsword field is empty");
        }else{
            
        $sql=$conn->prepare("Select * From admin_info Where admin_name='$admin_name'AND password='$password' ");
        $sql->execute();
        $row=$sql->rowCount();
        if($row==1){
            $result=$sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION["admin_id"]=$result["admin_id"];
            $_SESSION["admin_name"]=$result["admin_name"];
            if (!( isset($_SESSION["admin_id"]) )) {
                echo false;
            }else{
               echo true; 
            }
            
        }else{
            errorMess("Record not existing ");
        }
            
        }
    }catch(Exception $e){
        errorMess($e->getMessage());
    }
}

?>