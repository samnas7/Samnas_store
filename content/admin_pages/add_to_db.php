<?php 

include '../function/function.php';
session_start();
if (!( isset($_SESSION['admin_id']) )) {
    header('location:login.php');
}
$adminstor_id=$_SESSION["admin_id"];
if (isset($_POST['editing_product'])) {
   $product_id=$_POST["product_id"];
    $product_title=$_POST["product_title"];
    $product_image=$_FILES["product_image"]["name"];
    $product_price=$_POST["product_price"];
    $product_keywords=$_POST["product_keywords"];
    $product_desc=$_POST["product_desc"];
    $product_brand=$_POST["brands"];
    $product_cat=$_POST["categories"];
    try{
            $target_dir = "../img/";
            $target_file = $target_dir . basename($product_image);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check =getimagesize($_FILES["product_image"]["tmp_name"]);
            if ($check!= true) {
                /*errorMess("")*/
                Alerts("File is not an image. ");
                $uploadOk=0;
            }
            if ($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="gif" && $imageFileType!="jpeg"){
                Alerts("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                Alerts("Sorry, file already exists.");
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                Alerts("Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                    Alerts( "The file ". basename( $_FILES["product_image"]["name"]). " has been uploaded.");
                     database();
                    $sql=$conn->prepare("SELECT * FROM products WHERE product_title='$product_title' AND product_brand='$product_brand' AND product_cat='$product_cat' AND product_image='$product_image' AND product_desc='$product_desc' AND product_keywords='$product_keywords' LIMIT 1");
                    $sql->execute();
                    $row=$sql->rowCount();
                    if ($row==0) {
                       $sql=$conn->prepare("UPDATE products SET product_title='$product_title', product_price='$product_price', product_keywords='$product_keywords', product_brand='$product_brand', product_desc='$product_desc', product_image='$product_image', product_cat='$product_cat' WHERE product_id='$product_id'");
                    if ($sql->execute()) {
                        Mess("successfully updated");
                        header('location:show_product.php');
                    }else{
                        Alerts("Error updating");
                    } 
                    }
                } else {
                    Alerts("Sorry, there was an error uploading your file.");
                }
                
            }
        } catch (PDOException $e) {
            $message= $e->getMessage();
            Alerts($message);
        }
}
if (isset($_POST["add"])) {
    $product_title=$_POST["product_title"];
    $product_image=$_FILES["product_image"]["name"];
    $product_price=$_POST["product_price"];
    $product_keywords=$_POST["product_keywords"];
    $product_desc=$_POST["product_desc"];
    $product_brand=$_POST["brands"];
    $product_cat=$_POST["categories"];
    try{
            $target_dir = "../img/";
            $target_file = $target_dir . basename($product_image);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check =getimagesize($_FILES["product_image"]["tmp_name"]);
            if ($check!= true) {
                /*errorMess("")*/
                Alerts("File is not an image. ");
                $uploadOk=0;
            }
            if ($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="gif" && $imageFileType!="jpeg"){
                Alerts("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                Alerts("Sorry, file already exists.");
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                Alerts( "Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                    Alerts("The file ". basename( $_FILES["product_image"]["name"]). " has been uploaded.");
                     database();
                    $sql=$conn->prepare("SELECT * FROM products WHERE product_title='$product_title' AND product_brand='$product_brand' AND product_cat='$product_cat' AND product_image='$product_image' AND product_desc='$product_desc' AND product_keywords='$product_keywords' LIMIT 1");
                    $sql->execute();
                    $row=$sql->rowCount();
                    if ($row==0) {
                       $sql=$conn->prepare("INSERT INTO products VALUES (NULL,'$product_brand','$product_cat','$product_title','$product_price','$product_desc','$product_image','$product_keywords')");
                    if ($sql->execute()) {
                        Alerts("successfully updated");
                        header('location:add_product.php');
                    }else{
                        errorMess("Error updating");
                    } 
                    }
                } else {
                    Alerts("Sorry, there was an error uploading your file.");
                }
                
            }
        } catch (PDOException $e) {
            $message= $e->getMessage();
            Alerts($message);
        }
}
if (isset($_POST['adding_image'])) {
    echo $product_id=$_POST['product_id'];
    $image=$_FILES["image"]["name"];
     try{
            $target_dir = "../img/";
            $target_file = $target_dir . basename($image);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check =getimagesize($_FILES["image"]["tmp_name"]);
            if ($check!= true) {
                /*errorMess("")*/
                Alerts("File is not an image. ");
                $uploadOk=0;
            }
            if ($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="gif" && $imageFileType!="jpeg"){
                Alerts("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                Alerts("Sorry, file already exists.");
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                Alerts( "Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
            } else {
                     database();
                       $sql = $conn->prepare("insert into images values (NULL, '$image', '$product_id')");
                       echo "$product_id";
                    if ($sql->execute()) {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            Alerts("The file ".basename( $_FILES["image"]["name"])." has been uploaded.");   
                        } else {
                            Alerts("Sorry, there was an error uploading your file.");
                        }
                        Alerts("successfully updated");
                        header('location:show_product.php');
                    }else{
                        errorMess("Error updating");
                    } 
                 
                
             }
        } catch (PDOException $e) {
            $message= $e->getMessage();
            Alerts($message);
        }
     
 }
 if (isset($_POST["add_admin"])) {
     $admin_name=test_input($_POST["admin_name"]);
     $second_address=$_POST["second_address"];
     $first_address=$_POST["first_address"];
     $dob=$_POST["dob"];
     $email=EMAIL($_POST["email"]);
     $sex=$_POST["sex"];
     $password=$_POST["password"];
     $confirm_new_password=$_POST["confirm_new_password"];
     /*check if empty*/
     if (!empty($admin_name) || !empty($email) || !empty($first_address) || !empty($second_address) || !empty($dob) || !empty($sex) || !empty($password) || !empty($confirm_new_password) ) {
         /*check if pass and conf are equal*/
         if ($password===$confirm_new_password) {
             if (strlen($password) < 9 || strlen($confirm_new_password) < 9) {
                 Alerts("Password is too weak");
             }else{
                /*Mess("$password $admin_name $second_address $first_address $dob $email $sex $confirm_new_password");*/
                $password=PASSWORD($password);
                try {
                    database();
                    $sql=$conn->prepare("SELECT * FROM admin_info WHERE admin_name='$admin_name' AND password='$password' AND email='$email' LIMIT 1");
                    $sql->execute();
                     $row=$sql->rowCount();
                    if ($row==0){
                         $sql=$conn->prepare("INSERT INTO admin_info VALUES (NULL, '$admin_name', '$sex', '$email', '$dob', '$first_address', '$second_address', '$password', 0)");
                        if ($sql->execute()) {
                            Alerts("Input successfully inserted");
                        }
                    }else{
                       Alerts("Input already exists");
                    }
                } catch (PDOException $e) {
                    $message= $e->getMessage();
                    Alerts("error: $message");
                }
             }
         }else{
            Alerts("Password and Confirm Password are not similar");
         }
     }else{
        Alerts("fields are empty");
     }
     /**/
 }
 if (isset($_POST["edit_admin"])) {
     $admin_name=test_input($_POST["admin_name"]);
     $admin_id=$_POST["admin_id"];
     $second_address=$_POST["second_address"];
     $first_address=$_POST["first_address"];
     $dob=$_POST["dob"];
     $email=EMAIL($_POST["email"]);
     $sex=$_POST["sex"];
     /*check if empty*/
     if (!empty($admin_name) || !empty($email) || !empty($first_address) || !empty($second_address) || !empty($dob) || !empty($sex)) {
         /*check if pass and conf are equal*/
         
                Mess(" $admin_name $second_address $first_address $dob $email $sex ");
                try {
                    database();
                    $sql=$conn->prepare("SELECT * FROM admin_info WHERE admin_name='$admin_name' AND email='$email' LIMIT 1");
                    $sql->execute();
                     $row=$sql->rowCount();
                    if ($row==0){
                         /**/$sql=$conn->prepare("UPDATE admin_info SET admin_name='$admin_name', email='$email', sex='$sex', DOB='$dob', first_address='$first_address', second_address='$second_address' WHERE admin_id='$admin_id'");
                        if ($sql->execute()) {
                            Alerts("Input successfully updated");
                        }
                    }else{
                       Alerts("Input already exists");
                    }
                } catch (PDOException $e) {
                    $message= $e->getMessage();
                    Alerts("error: $message");
                }
          
     }else{
        Alerts("fields are empty");
     }
     /**/
 }

 ?>