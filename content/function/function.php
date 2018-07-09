<?php
$dbname="samnas_store";
$hostname="localhost";
$dbuser="root";
$dbpassword="0907IT02352";
    $conn=new PDO("mysql:host=$hostname;dbname=$dbname",$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function database(){
    global $dbname,$dbpassword,$dbuser,$hostname,$conn;
}

function errorMess($message){
    echo " <div class='alert alert-danger'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>$message</b>
         </div>";
    exit();
}function Mess($message){
    echo " <div class='alert alert-success'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>$message</b>
         </div>";
    
}
function Alerts($message)
{
    echo "<script>alert('$message');
        
    </script>";
}
	function test_input($data)
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
    function get_array_from_db($value='')
    {
        $dbname="samnas_store";
$hostname="localhost";
$dbuser="root";
$dbpassword="0907IT02352";
        $conn=new PDO("mysql:host=$hostname;dbname=$dbname",$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM $value";
        $stmt=$conn->query($sql);
        return $stmt;
    }
    function array_from_db($value='',$DB)
    {
        $dbname="samnas_store";
$hostname="localhost";
$dbuser="root";
$dbpassword="0907IT02352";
        $conn=new PDO("mysql:host=$hostname;dbname=$dbname",$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM $DB WHERE product_id='$value'";
        $stmt=$conn->query($sql);
        return $stmt;
    }
	function EMAIL($email)
	{
        $email=test_input($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr= "invalid email format";
            echo errorMess($emailErr);
        }else{
            return $email;
        }   
	}
function PASSWORD($password)
    {
        $password=test_input($password);
        $password= md5($password);
        return $password;
    }
?>