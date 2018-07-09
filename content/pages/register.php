<?php
include "../function/function.php";

try{
    
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $confirm_password=$_POST["confirm_password"];
    $mobile=$_POST["mobile"];
    $address1=$_POST["address1"];
    $address2=$_POST["address2"];
    $name="/^[A-Z][a-zA-Z]+$/";
    $emailVal="/^[_a-z0-9-]+(\.[_a-z0-9-])*@[a-z0-9]+(\.[a-z]{2,4})$/";
    $number="/^\+?[0-9]{1,4}[-\. ]?(\d{3})[-\. ]?([0-9]{7})+$/";
     $num="/^([+]{1}[0-9]{1,4}|0{1})[0-9]{10,11}$/";
        if(empty($f_name) || empty($l_name) ||empty($password) || empty($confirm_password) ||empty($mobile) || empty($address1) || empty($address2) ){
            $message="Fields are empty , please fill them";
            errorMess($message);
        }else{
            #for names
        if(!preg_match($name,$f_name) || !preg_match($name,$l_name)){
            $message=(!preg_match($name,$f_name))?"$f_name must be alphabets only and must start with a capital letter":"$l_name must be alphabets only and must start with a capital letter";
            //="Name must be alphabets only and must start with a capital letter";
            errorMess($message);
        }
        #for email
        if(!preg_match($emailVal,$email)){
            $message="$email is invalid, Please re-enter another email";
            errorMess($message);
        }
        #for passwords
        if(strlen($password) < 9 || strlen($confirm_password) < 9){
            $message="Password is too weak";
            errorMess($message);
        }
        #check if password aand coonfirm password are the same
        if ($password != $confirm_password) {
            $message="Password and Confirm Password does not match";
            errorMess($message);
        }
        #for mobile no
        if (!preg_match($num,$mobile)) {
            $message=" Mobile number $mobile is Invalid";
            errorMess($message);
        }
        #check length of mobile number
        if( !(strlen($mobile) < 15 || strlen($mobile) >10) ){
            $message=" Mobile number $mobile is Invalid";
            errorMess($message);
        }

      #for database connection 
      database();
      $sql=$conn->prepare("Select * From user_info where email = '$email' LIMIT 1");
      $sql->execute();
      $row=$sql->rowCount();
      #check if input already exists
      if($row ==0){
          $password=PASSWORD($password);
          $email=EMAIL($email);
          $address1=test_input($address1);
          $address2=test_input($address2);
          $sql="Insert into user_info values (NULL,'$f_name','$l_name','$email','$password','$mobile','$address1','$address2',1)";
          if ($conn->exec($sql)) {
              $message="Input successfully inserted ";
              Mess($message);
          } else {
              $message="Input not successfully inserted ";
              errorMess($message);
          }
      } else {
              $message="Input exist in the database ";
              errorMess($message);
          }
    } 

}
catch(PDOException $e){
    echo $e->getMessage();
}
    
?>