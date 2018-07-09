<?php

$limit=7;
session_start();
include '../function/function.php';
$adminstor_id=$_SESSION["admin_id"];

try {
    database();
    $sql=$conn->prepare("SELECT privileges FROM admin_info WHERE admin_id='$adminstor_id'");
    $sql->execute();
    $row_count=$sql->rowCount();
    if ($row_count!=1) {
        errorMess("Record does not exist");
    } else {
        $row_count=$sql->fetch(PDO::FETCH_ASSOC);
        $privilege =$row_count["privileges"];
    }
    
} catch (PDOException $e) {
    $message= $e->getMessage();
    errorMess($message);
}
if(isset($_POST["change_password"])){
    $old_password=$_POST["old_password"];
    $new_password=$_POST["new_password"];
    $confirm_new_password=$_POST["confirm_new_password"];
    $admin_id=$_POST["admin_id"];
    if(!empty($old_password) || !empty($new_password) || !empty($confirm_new_password)){
        try{
            $new_password=PASSWORD($new_password);
            $old_password=PASSWORD($old_password);
            $confirm_new_password=PASSWORD($confirm_new_password);
            database();
            $sql=$conn->prepare("SELECT password FROM admin_info WHERE admin_id='$admin_id' AND password='$old_password' LIMIT 1");
            $sql->execute();
            $row=$sql->rowCount();
            if($row !=1){
                errorMess("Record does not exist");
            }else{
                $row=$sql->fetch(PDO::FETCH_ASSOC);
                $pass =$row["password"];
                if($new_password==$confirm_new_password){
                    $sql="UPDATE admin_info SET password='$new_password' where admin_id='$admin_id' ";
                    $stmt=$conn->prepare($sql);
                    if ($stmt->execute()){
                        
                    Mess("Input update successfully <a href='../pages/logout.php'>Login again</a>");
                    }else{
                        errorMess("Input update unsuccessfully ");
                    }
                }else{
                   errorMess("Check  your password fields"); 
                }
            }
        }catch(PDOException $e){
            $message= $e->getMessage();
            errorMess($message);
        }
       # Mess("$admin_id  $old_password  $new_password $confirm_new_password");
    }
    
}

if (isset($_POST["usersInfomation"]) ) {
    
   if (isset($_POST["setAdminPage"])) {
      $page_id= $_POST["page_id"];
      
       $start=($page_id*$limit)-$limit;
   }else{
    $start=0;
   }
    try {
         echo "<tr><th>FirstName </th>
    <th>LastName</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Adresses1</th>
    <th>Adresses2</th>";
    if ($privilege==0) {
       echo "";
    } else {
        echo "<th>Block</th><th>Show Cart</th><th>Send mail</th></tr>";
    }
    
    database();

    $sql="SELECT * FROM user_info LIMIT $start,$limit";
    $user=$conn->query($sql);
    foreach ($user as $row) {

       $user_id= $row['user_id'];
       $firstName= $row['firstName'];
       $lastName= $row['lastName'];
       $email= $row['email'];
       $mobile= $row['mobile'];
       $adresses1= $row['adresses1'];
       $adresses2= $row['adresses2'];
       $status= $row['status'];
    $user_status = ($status==1) ? " status='$status' class='btn btn-danger user_status'>Block" : " status='$status' class='btn btn-success user_status'> Unblock" ;

       echo "<tr>
    <td>$firstName</td>
    <td>$lastName</td>
    <td>$email</td>
    <td>$mobile</td>
    <td>$adresses1</td>
    <td>$adresses2</td>
   ";
     if ($privilege==0) {
       echo "</tr>";
    } else {

        echo "  <td><a href='#' user_id='$user_id'  $user_status</a></td>
        <td><a href='#' user_id='$user_id'  id='showing_cart' class='btn btn-info' data-target='#myModal_admin' data-toggle='modal'><span class='fa fa-info-circle'></span> Show Cart</a></td>
        <td><a href='#' user_id='$user_id' email='$email' firstName='$firstName' lastName='$lastName'  id='sending_mail' class='btn btn-warning' data-target='#myModal_admin' data-toggle='modal'><span class='fa fa-envelope-o'></span> Send Mail</a></td>
       </tr>";
    }
    
    
    }
    } catch (Exception $e) {
        $message= $e->getMessage();
        errorMess($message);   
    }
}


if (isset($_POST["block"])) {
    $status=$_POST["status"];
    $user_id=$_POST["user_id"];
    try {
        database();
        $user_status = ($status==1) ? 0 : 1 ;
        $sql="UPDATE user_info SET status='$user_status' where user_id='$user_id'";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()){
            Mess("Record successfully updated");
        }
    } catch (Exception $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
}

if(isset($_POST["admin_page"])){
    try{
        database();
        $sql=$conn->prepare("SELECT * FROM user_info ");
        $sql->execute();
        $row=$sql->rowCount();
        $pageNo= ceil( $row/$limit);
        for ($i=1; $i <= $pageNo; $i++) { 
            echo "<li><a href='#' userPage='$i' id='adminPageLink'>$i</a></li>";
        }
    }catch(PDOException $e){
        $message= $e->getMessage();
        errorMess($message);
    }
}

if (isset($_POST["brandInformation"]) ) {

   if (isset($_POST["setBrandPage"])) {


        $page_id=$_POST['page_id'];
      $start=($page_id*$limit)-$limit;
   } else {
       $start=0;
   }
   
    try {
        database();
        echo "<tr>
                <th>ID</th>
                <th>BRAND TITLE</th>";
                if ($privilege==0) {
                   echo "";
                } else {
                    echo "
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>";
                }
                

    $sql="SELECT * FROM brands LIMIT $start,$limit";
    $user=$conn->query($sql);
    foreach ($user as $row) {
        $brand_id=$row['brand_id'];
        $brand_title=$row['brand_title'];

        echo "<tr>
                <td>$brand_id</td>
                <td>$brand_title</td>";
            if ($privilege==0) {
                echo "";
            } else {
                echo "
                <td><a href='#' class='btn btn-success' brand_id='$brand_id' brand_title='$brand_title' id='edit_brand'><span class='fa fa-info-circle'></span> Edit</a></td>
                <td><a href='#' id='delete_brand' brand_id='$brand_id' class='btn btn-danger'><span class='fa fa-trash'></span> Delete</a></td>
            </tr>";
            }
               
    }
    }catch(PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
}/**/
if (isset($_POST['brand_page'])){
    try{
        database();
        $sql=$conn->prepare("SELECT * FROM brands");
        $sql->execute();
        $row=$sql->rowCount();
        $pageNo= ceil( $row/$limit);
        for ($i=1; $i <= $pageNo; $i++) { 
            echo "<li><a href='#' brand='$i' id='brandPageLink'>$i</a></li>";
        }
    }catch(PDOException $e){
        $message= $e->getMessage();
        errorMess($message);
    }
}
if (isset($_POST["edit"])) {
    try {
        $brand_id=$_POST["brand_id"];
        $brand_title=$_POST["brand_title"];
        database();
        $sql="UPDATE brands SET brand_title='$brand_title' WHERE brand_id=$brand_id";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()) {
            Mess("Record successfully updated");
        }
    }catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
}
if (isset($_POST['cartegoryInfomation'])) {

    if (isset($_POST["setCatPage"])) {
         $cat_no=$_POST["cat_no"];
       $start=($cat_no*$limit)-$limit;
   } else {
       $start=0;
   }
 try {
        database();
        echo "<tr>
                <th>ID</th>
                <th>CATEGORY TITLE</th>";
            if ($privilege==0) {
                echo "";
            } else {
                echo "
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>";
            }
    $sql="SELECT * FROM categories LIMIT $start,$limit";
    $user=$conn->query($sql);
    foreach ($user as $row) {
        $cat_id=$row['cat_id'];
        $cat_title=$row['cat_title'];

        echo "<tr>
                <td>$cat_id</td>
                <td>$cat_title</td>";
            if ($privilege==0) {
                echo "";
            } else {
                echo "   <td><a href='#' class='btn btn-success' cat_id='$cat_id' cat_title='$cat_title' id='edit_cat'><span class='fa fa-info-circle'></span> Edit</a></td>
                <td><a href='#' id='delete_cat' cat_id='$cat_id' class='btn btn-danger'><span class='fa fa-trash'></span> Delete</a></td>
            </tr>";
            }
             
    }
            
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }   
}
if (isset($_POST["categories_page"])) {
    try {
        database();
        $sql=$conn->prepare("SELECT * FROM categories");
        $sql->execute();
        $row=$sql->rowCount();
         $pageNo=ceil($row/$limit);
        for ($i=1; $i <= $pageNo; $i++) { 
            echo "<li><a href='#' cat='$i' id='catPageLink'>$i</a></li>";
        }
    }catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
}
if (isset($_POST["cat_edit"])) {
    $cat_id=$_POST["cat_id"];
    $cat_title=$_POST["cat_title"];
    try {
        database();
        $sql="UPDATE categories SET cat_title='$cat_title' WHERE cat_id=$cat_id";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()) {
            Mess("Record successfully updated");
        }
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
}
if (isset($_POST["products_page"])) {
   try {
       database();
       echo "string";
       $sql=$conn->prepare("SELECT * FROM products");
        $sql->execute();
        $row=$sql->rowCount();
         $pageNo=ceil($row/$limit);
        for ($i=1; $i <= $pageNo; $i++) { 
            echo "<li><a href='#' products_id='$i' id='productPageLink'>$i</a></li>";
        }

   } catch (PDOException $e) {
       $message= $e->getMessage();
        errorMess($message);
   }
}
if (isset($_POST["productsInfomation"])) {
    if (isset($_POST["setProductsPage"])) {
        
        $products_id=$_POST["products_id"];
        $start=($products_id*$limit)-$limit;
    }else{
        $start=0;
    }
    echo "<tr>
        <th>Product Image</th>
        <th>Product Title</th>
        <th>Product Price</th>
        <th>Product Keywords</th>
        <th>Product Description</th>";
        if ($privilege==0) {
                echo "";
            } else {
                echo "
        <th class='text-info'>View</th>
        <th class='text-success'>Edit</th>
        <th class='text-warning'>Add More Images</th>
        <th class='text-danger'>Delete</th>
    </tr>";
            }

    try {
        database();
        $sql="SELECT * FROM products LIMIT $start,$limit";
        $user=$conn->query($sql);
        foreach ($user as $key) {
            $product_id=$key["product_id"];
            $product_brand=$key["product_brand"];
            $product_cat=$key["product_cat"];
            $product_title=$key["product_title"];
            $product_price=$key["product_price"];
            $product_desc=$key["product_desc"];
            $product_image=$key["product_image"];
            $product_keywords=$key["product_keywords"];
            echo "<tr>
                <td><img src='../img/$product_image' class='img img-thumbnail' height='70px' width='60px'></td>
                <td>$product_title</td>
                <td>$product_price</td>
                <td>$product_keywords</td>
                <td>$product_desc</td>";
        if ($privilege==0) {
                echo "</tr>";
            } else {
                echo "
                <td><a href='#' product_id='$product_id' product_title='$product_title' product_image='$product_image' product_price='$product_price' product_keywords='$product_keywords' product_desc='$product_desc' product_brand='$product_brand' product_cat='$product_cat' id='view_product' class='btn btn-info' data-target='#myModal' data-toggle='modal'><span class='fa fa-info-circle' ></span> View</a></td> 
                <td><a href='#' product_id='$product_id' product_title='$product_title' product_image='$product_image' product_price='$product_price' product_keywords='$product_keywords' product_desc='$product_desc' product_brand='$product_brand' product_cat='$product_cat' id='edit_product' class='btn btn-success' data-target='#myModal' data-toggle='modal'><span class='fa fa-info-circle' ></span> Edit</a></td>
                <td><a href='#' product_id='$product_id' id='add_more' class='btn btn-warning' data-target='#myModal' data-toggle='modal'><span class='fa fa-image'></span> Add More Image</a></td>
    
    <td><a href='#' product_id='$product_id' id='delete_product' class='btn btn-danger'><span class='fa fa-trash'></span> Delete</a></td>
            </tr>";
            }

                
            /*product_id product_brand product_cat product_title product_price product_desc product_image product_keywords*/
        }
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
}

if (isset($_POST["display_products"])) {
    $product_id=$_POST["product_id"];
    $product_title=$_POST["product_title"];
    $product_image=$_POST["product_image"];
    $product_price=$_POST["product_price"];
    $product_keywords=$_POST["product_keywords"];
    $product_desc=$_POST["product_desc"];
    $product_brand=$_POST["product_brand"];
    $product_cat=$_POST["product_cat"];
    try{
        database();
        $sql=$conn->prepare("SELECT brand_title FROM brands WHERE brand_id=$product_brand");
        $sql->execute();
        $row=$sql->rowCount();
            if($row==1){
                $result=$sql->fetch(PDO::FETCH_ASSOC);
                $brand_title=$result["brand_title"];
                $sql2=$conn->prepare("SELECT cat_title FROM categories WHERE cat_id=$product_cat");
                $sql2->execute();
                $row2=$sql2->rowCount();
                if($row2==1){
                    $result1=$sql2->fetch(PDO::FETCH_ASSOC);
                    $cat_title=$result1["cat_title"];
                }else{
                    errorMess("Record not existing ");
                }
            }else{
                errorMess("Record not existing ");
            }

        echo "<h4><b>$product_title</b><b style='float:right;'>$brand_title  $cat_title</b></h4>
        <div id='mycarousel' class='carousel slide' data-ride='carousel'>
        <!-- indicators -->
            <ol class='carousel-indicators'>
                <li data-target='#mycarousel' data-slide-to='0' class='active' ></li>
                ";
                $user=array_from_db($product_id,"images");
                $count=0;
                foreach ($user as $key) {
                    echo "
                    <li data-target='#mycarousel' data-slide-to='".++$count."' class=''></li>
                    ";
                }
                
                    echo "
            </ol>
            <div class='carousel-inner' style='height: 500px; background-color: #000;'>
                
                ";
                $user=array_from_db($product_id,"images");
                
                foreach ($user as $key) {
                    $image_title=$key["image_title"];
                    $image_id=$key["image_id"];

                    echo "
                    <div class='item'>
                    <div class='carousel-caption' style='position: relative; right: 0px; left:0px;'>
                        <div>
                            <div >
                                <a href='#' id='deleting_image' image_id='$image_id' class='btn btn-danger'>Delete Image</a>
                            </div>
                            <img src='../img/$image_title'  class='img-thumbnail img' height='80px;' alt='$product_keywords'/>
                            
                        </div>
                        
                    </div>
                </div>
                    ";
                }
                /**/
                echo "
                <!-- 3RD -->
                <div class='item active'>
                    <div class='carousel-caption' style='position: relative; right: 0px; left:0px;'>
                        <div >
                            <img src='../img/$product_image' class='img-thumbnail img' height='80px;' alt='$product_keywords'/> 
                        </div>
                    </div>
                </div>
            </div>

                <!--/.carousel-inner-->
                    <a class='right carousel-control hidden' href='#mycarousel' data-slide='prev' role='button'>
                        <i class='fa fa-angle-left fa-3x' aria-hidden='true'></i>
                    </a>
                    <a class='right carousel-control hidden' href='#mycarousel' data-slide='next' role='button'>
                        <i class='fa fa-angle-right fa-3x' aria-hidden='true'></i>
                    </a>     
    </div>
        <h3><i class='' style='float:right;'>#$product_price.00</i><i class='text-right'>Description</i></h3>
        <p>
            $product_keywords
        </p><p>
            $product_desc
        </p>";
    } catch (PDOException $e) {
       $message= $e->getMessage();
        errorMess($message); 
    }
    
}

if (isset($_POST["edit_this_product"])) {
    $product_id=$_POST["product_id"];
    $product_title=$_POST["product_title"];
    $product_image=$_POST["product_image"];
    $product_price=$_POST["product_price"];
    $product_keywords=$_POST["product_keywords"];
    $product_desc=$_POST["product_desc"];
    $product_brand=$_POST["product_brand"];
    $product_cat=$_POST["product_cat"];
    echo "<input type='hidden' id='product_id' name='product_id' value='$product_id'>
    <div class='row' style='background-color:transparent'>
    
        <div class='col-md-4'>
            <input required='required' type='text' class='form-control' name='product_title' id='product_title' value='$product_title'>
        </div>
        <div class='col-md-4'>
            <input required='required' type='text' class='form-control' id='product_price' name='product_price' value='$product_price'>
        </div>
        
    </div><h3><div class='col-md-12'>
            <input required='required' type='file' class='form-control' name='product_image' id='product_image' value='$product_image'>
        </div></h3>
    <div class='row' style='background-color:transparent'>
        <div class='col-md-6'>
            <select id='brands' name='brands' class='form-control'>";
        $user=get_array_from_db("brands");
        foreach ($user as $key ) {
            $brand_id=$key["brand_id"];
            $brand_title=$key["brand_title"];
            if ($product_brand==$brand_id) {
                echo "<option value='$brand_id' selected>$brand_title</option>";
            }else{
                echo "<option value='$brand_id'>$brand_title</option>";
            }
            
        }
        echo "
            </select>
        </div>
        <div class='col-md-6'>
            <select name='categories' id='categories' class='form-control'>";
        $user=get_array_from_db("categories");
        foreach ($user as $key ) {
            $cat_id=$key["cat_id"];
            $cat_title=$key["cat_title"];
            if ($product_cat==$cat_id) {
                echo "<option value='$cat_id' selected>$cat_title</option>";
            }else{
               echo "<option value='$cat_id'>$cat_title</option>"; 
            }
        }
        echo "
                
            </select>
        </div>
    </div>
        <div class='col-md-12'>
            <textarea required='required' id='product_desc' name='product_desc' rows='8' class='form-control'>$product_desc</textarea>
        </div>
    <h3 class='col-md-12'>
         <textarea required='required' id='product_keywords' name='product_keywords' rows='8' class='form-control'>$product_keywords</textarea>
    </h3>
    <h3 class='text_centre'>
        <input required='required' type='submit' name='editing_product' id='submit_edit' class='btn btn-info btn-lg col-md-12'value='Submit'/>
    </h3>
    ";
}


if (isset($_POST["count_admin"])) {
    try {
        database();
        $sql=$conn->prepare("SELECT * FROM admin_info");
        $sql->execute();
        $row=$sql->rowCount();
        $pageNo=ceil($row/$limit);

        for ($i=1; $i <= $pageNo; $i++) { 
            echo "<li><a href='#' admin_no='$i' id='adminPageLink'>$i</a></li>";
        }
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message); 
    }
}
if (isset($_POST["adminstrators"])) {

    if (isset($_POST["set_admin_page"])) {
        $admin_no=$_POST["adminNo"];
        echo $admin_no;

        $start=($admin_no*$limit)-$limit;
    }else{
        $start=0;
    }
    try {
        database();
        echo "<tr>
            <th>Admin Name </th>
            <th>Sex</th>
            <th>Email</th>
            <th>DOB</th>
            <th>First Address</th>
            <th>Second Address</th>
            <th>Password</th>
            <th> Privileges </th>";
        if ($privilege==0) {
                echo "";
            } else {
                echo "<th class='text-success'>Edit</th>
        </tr>";
            }

        $sql="SELECT * FROM admin_info LIMIT $start,$limit";
        $user=$conn->query($sql);
        foreach ($user as $value) {
           $admin_id= $value["admin_id"];
           $admin_name= $value["admin_name"];
           $sex= $value["sex"];
           $email= $value["email"];
           $dob= $value["dob"];
           $first_address= $value["first_address"];
           $second_address= $value["second_address"];
           $password= $value["password"];
           $privileges= $value["privileges"];
            echo "<tr>
            <td> $admin_name</td>
            <td>$sex</td>
            <td>$email</td>
            <td>$dob</td>
            <td>$first_address</td>
            <td>$second_address</td>
            <td>$password</td>
            <td>";
            if ($privileges==0) {
                echo "<b class='text-danger'>View Only</b>";
            }else{
                echo "<b class='text-success'>All Privileges</b>";
            }
        if ($privilege==0) {
                echo "";
            } else {
               
            echo "</td>
            <td><a href='#' id='edit_privillege' privileges='$privileges' admin_id='$admin_id' class='btn btn-success'>Edit</a></td>
        </tr>";
            }

        }
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message); 
    }
}
if (isset($_POST["edit_privillege"])) {
    $admin_id=$_POST["admin_id"];/*privileges*/
    $privileges=$_POST["privileges"];/*privileges*/
    $retVal = ($privileges==0) ? 1 : 0 ;

    try {
        database();
        $sql=$conn->prepare("UPDATE admin_info SET privileges='$retVal' WHERE admin_id='$admin_id'");
        if ($sql->execute()) {
            Mess("successfully updated");
        }else{
            errorMess("Error updating");
        }
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message); 
    }
}
if (isset($_POST["addingBrand"])) {
    $set_brand=test_input($_POST["set_brand"]);
    
    try {
        database();
        if (!empty($set_brand)) {
        $sql=$conn->prepare("Select * From brands where brand_title = '$set_brand' LIMIT 1");
      $sql->execute();
      $row=$sql->rowCount();
      #check if input already exists
      if($row ==0){
        $sql="INSERT INTO brands VALUES(NULL, '$set_brand')";
        if($conn->query($sql)){
            echo "Input successfully inserted";
        }
    }else{
        echo "Input already exist";
    }
        
    }   
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
    }

if (isset($_POST["addingCategory"])) {
    $set_category=test_input($_POST["set_category"]);
    try {
        database();
            if (!empty($set_category)) {
            $sql=$conn->prepare("Select * From categories where cat_title = '$set_category' LIMIT 1");
          $sql->execute();
          $row=$sql->rowCount();
          #check if input already exists
          if($row ==0){
            $sql="INSERT INTO categories VALUES(NULL, '$set_category')";
            if($conn->query($sql)){
                echo "Input successfully inserted";
            }
        }else{
            echo "Input already exist";
        }
            
        }
        } catch (PDOException $e) {
            $message= $e->getMessage();
            errorMess($message);
        }
    }
if (isset($_POST["delete_product"])) {
    $product_id=$_POST['product_id'];

    try{
        database();
        $sql="DELETE FROM products WHERE product_id=$product_id";
        $sql2="DELETE FROM images WHERE product_id=$product_id";
        if($conn->query($sql) && $conn->query($sql2)){
            echo "Data successfully deleted";
        }else{
            echo "Data not deleted";
        }
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
}
if (isset($_POST["show_add_product"])) {
    try {
        echo "<div class='form-group' style='background-color:transparent'>
        <div class='col-md-4 col-xs-12'>
            <input required='required' type='text' class='form-control' placeholder='Product Title' name='product_title' id='product_title' />
        </div>
        <div class='col-md-4 col-xs-12'>
            <input required='required' type='text' class='form-control' placeholder='Product Price' id='product_price' name='product_price' >
        </div>
        <div class='col-md-4 col-xs-12'>
            <input required='required' type='file' class='form-control' placeholder='Product Image' name='product_image' id='product_image' >
        </div>
    </div>
    <div class='form-group' style=' background-color:transparent'>
        <div class='col-md-6'>
            <select id='brands' name='brands' placeholder='Brands' class='form-control'>";
            database();
        $user=get_array_from_db("brands");
        foreach ($user as $key ) {
            $brand_id=$key["brand_id"];
            $brand_title=$key["brand_title"];
             echo "<option value='$brand_id'>$brand_title</option>";
            
        }
        echo "  </select>
        </div>
        <div class='col-md-6'>
            <select name='categories' id='categories' placeholder='Categories' class='form-control'>";
        $user=get_array_from_db("categories");
        foreach ($user as $key ) {
            $cat_id=$key["cat_id"];
            $cat_title=$key["cat_title"];
            
            echo "<option value='$cat_id'>$cat_title</option>";
        }
        echo "
                
            </select>
        </div>
    </div>
        <h3 class='col-md-12'>
            <textarea id='product_desc' name='product_desc' rows='5' placeholder='Product Description' class='form-control'></textarea>
        </h3>
    <h3 class='col-md-12'>
         <textarea id='product_keywords' name='product_keywords' rows='5' placeholder='Product Keywords' class='form-control'></textarea>
    </h3>
    <h3 class='text_centre'>
        <input required='required' type='submit' name='add' class='btn btn-info btn-lg col-md-12'value='Submit'/>
    </h3>
    ";
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
}

if (isset($_POST['change_admin_Info'])) {
     echo '<h3>Edit Adminstrator\'s Information</h3>
     <input type="hidden" name="admin_id" value="'.$adminstor_id.'">';
try {
                    database();
            $sql=$conn->prepare("SELECT * FROM admin_info WHERE admin_id='$adminstor_id'");
            $sql->execute();
            $row=$sql->rowCount();
            if($row !=1){
                errorMess("Record does not exist");
            }else{
                $row=$sql->fetch(PDO::FETCH_ASSOC);
                $dob =$row["DOB"];
                $admin_name =$row["admin_name"];
                $first_address =$row["first_address"];
                $second_address =$row["second_address"];
                $sex =$row["sex"];
                $email =$row["email"];
                echo'
        <div class="form-group">
            <div class="col-md-6 col-xs-12">
                <input required="required" value="'.$admin_name.'" type="text" placeholder="Admin Name" class="form-control" name="admin_name">
            </div>
            
            <div class="col-md-6 col-xs-12">
                <input required="required" value="'.$dob.'" type="date" class="form-control" placeholder="Date Of Birth" name="dob">
            </div>
        </div>
        <div class="form-group">
            <h3 class="col-md-6 col-xs-12">
                <input required="required" value="'.$email.'" type="email" class="form-control" placeholder="Email" name="email">
            </h3>
            
            <h3 class="col-md-6 col-xs-12">
                <select name="sex" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </h3>
        </div>
        <div class="form-group">
            <h3 class="col-md-12 col-xs-12">
                <input required="required" type="text" value="'.$first_address.'" class="form-control" placeholder="First Address" name="first_address">
            </h3>
        </div>
        <div class="form-group">
            <h3 class="col-md-12 col-xs-12">
                <input required="required" value="'.$second_address.'" type="text" class="form-control" placeholder="Second Address" name="second_address">
            </h3>
        </div>
        <h3 class="text-center">
            <input type="submit" value="Edit Admin" class="btn btn-success" name="edit_admin" id="edit_admin">
        </h3>';
            }
                } catch (PDOException $e) {
                    $message= $e->getMessage();
                    errorMess($message);
                }
     
 }
if (isset($_POST["add"])) {
     echo '
     <h3>Add Adminstrator\'s Information</h3>
     <div class="form-horizontal">
        <div class="form-group">
            <h3 class="col-md-4 col-xs-12">
                <input required="required" type="text" placeholder="Admin_Name" class="form-control" name="admin_name">
            </h3>
            <h3 class="col-md-4 col-xs-12">
                <input required="required" type="email" class="form-control" placeholder="Email" name="email">
            </h3>
            <h3 class="col-md-4 col-xs-12">
                <input required="required" type="date" class="form-control" placeholder="Date Of Birth" name="dob">
            </h3>
        </div>
        <div class="form-group">
            <h3 class="col-md-4 col-xs-12">
                <input required="required" type="text" class="form-control" placeholder="First Address" name="first_address">
            </h3>
            <h3 class="col-md-4 col-xs-12">
                <input required="required" type="text" class="form-control" placeholder="Second Address" name="second_address">
            </h3>
            <h3 class="col-md-4 col-xs-12">
                <select name="sex" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </h3>
        </div>
        <div class="form-group">
            <h3 class="col-md-6 col-xs-12">
                <input required="required" type="password" class="form-control password" placeholder="Password" name="password">
            </h3>
            <h3 class="col-md-6 col-xs-12">
                <input required="required" type="password" class="form-control password" placeholder="Confirm Password" name="confirm_new_password">
            </h3>
            
        </div>
        <h4 style="margin-left: 20px;">
            <input type="checkbox" id="shp"><i class="text_success" style="color:#000;" id="txtshp">Show Password</i>
        </h4>
        <h3 class="text-center">
            <input type="submit" value="Add Admin" class="btn btn-success" name="add_admin" id="add_admin">
        </h3>
    
     </div>
        ';
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
                 errorMess("Password is too weak");
             }else{
                Mess("$password $admin_name $second_address $first_address $dob $email $sex $confirm_new_password");
             }
         }else{
            errorMess("Password and Confirm Password are not similar");
         }
     }else{
        errorMess("fields are empty");
     }
     /*Mess("hrllo");*/
 }
 if (isset($_POST["changing_password"])) {
     echo '<div class="message">
     </div>
     <input type="hidden" class="form-control" id="admin_id" value="'.$adminstor_id.'">
                           <div class="form-group">
                               <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock fa-2x fa-default lock"></i>';
                try {
                    database();
            $sql=$conn->prepare("SELECT password FROM admin_info WHERE admin_id='$adminstor_id' LIMIT 1");
            $sql->execute();
            $row=$sql->rowCount();
            if($row !=1){
                errorMess("Record does not exist");
            }else{
                $row=$sql->fetch(PDO::FETCH_ASSOC);
                $pass =$row["password"];
                //$pass =PASSWORD($pass);//md5($pass);
                echo '   <input type="password" id="old_password" name="old_password" placeholder="Old Password"  class="form-control password" value="" required="required"/>';
            }
                } catch (PDOException $e) {
                    $message= $e->getMessage();
                    errorMess($message);
                }

                echo'
                                    </span>
                            </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock fa-2x fa-default lock"></i>
                                        <input type="password" id="new_password" name="new_password" placeholder="New Password"  class="form-control password" required="required"/>
                                    </span>
                                </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock fa-2x fa-default lock"></i>
                                        <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm New Password"  class="form-control password " required="required"/>
                                    </span>
                                </div>
                           </div>
                            <div class="form-group" >
                                <h4 style="margin-left: 20px;">
                                    <input type="checkbox" id="shp"><i id="txtshp">Show Password</i>
                                </h4>
                            </div>
                          <div class="text-center" >
                              <input type="button" name="change_password" value="Save Change" id="change_password" class="btn btn-primary btn-lg">
                          </div>';
 }
 if (isset($_POST["showing_cart"])) {
         $user_id=$_POST["user_id"];
         
        try {
           database();
           $sql="SELECT * FROM cart WHERE user_id='$user_id'";
           $user=$conn->query($sql);
           echo "<table class='table table-reponsive table-stripped'>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Title</th>
                        <th>Quatity</th>
                        <th>Price</th>
                        <th>Total Amount</th>
                    </tr>";
           foreach ($user as $key){
               $p_id=$key["p_id"];
                
                $sql=$conn->prepare("SELECT * FROM products WHERE product_id='$p_id' LIMIT 1");
                $sql->execute();
                $row=$sql->rowCount();
                if($row !=1){
                    errorMess("Record does not exist");
                }else{
                    $row=$sql->fetch(PDO::FETCH_ASSOC);
                    $product_image=$row["product_image"];
                    $product_title=$row["product_title"];
                    $product_price=$row["product_price"];
                }
                

                $qty=$key["qty"];
                $total_amount=$key["total_amount"];
                echo "<tr>
                                    <td><img style='height:80px;' src='../img/$product_image' class='img img-thumbnail'> </td>
                                    <td>$product_title</td>
                                    <td>$qty</td>
                                    <td>$product_price</td>
                                    <td>$total_amount</td>
                                </tr>
                            ";/*<h4></h4>*/

           }echo "</table>";
        } catch (PDOException $e){
            $message= $e->getMessage();
            errorMess($message);
        }
 }
 if (isset($_POST["sending_mail"])) {
        $user_id=$_POST["user_id"];
        $email=$_POST["email"];
        $firstName=$_POST["firstName"];
        $lastName=$_POST["lastName"];
        try {
            database();

        } catch (PDOException $e) {        
            $message= $e->getMessage();
            errorMess($message);
        }
 }
 if (isset($_POST["delete_cat"])) {
        $cat_id=$_POST["cat_id"];
        try {
            database();
            $sql=$conn->prepare("SELECT * FROM products WHERE product_cat='$cat_id'");
            $sql->execute();
            $row=$sql->rowCount();
            if($row !=0){
                errorMess("Record cannot be deleted because it has a child data");
            }else{
                $sql="DELETE FROM categories where cat_id=$cat_id";
                if ($conn->query($sql)) {
                    Mess("Input successfully deleted");
                }else{
                    errorMess("Input not deleted");
                }
            }
            
        } catch (PDOException $e) {
            $message= $e->getMessage();
            errorMess($message);
        }
 }
 if (isset($_POST["delete_brand"])){
        $brand_id=$_POST["brand_id"];
        try {
            database();
            
                $sql=$conn->prepare("SELECT * FROM products WHERE product_brand='$brand_id'");
            $sql->execute();
            $row=$sql->rowCount();
            if($row !=0){
                errorMess("Record cannot be deleted because it has a child data");
            }else{
                $sql="DELETE FROM brands WHERE brand_id=$brand_id";
                if ($conn->query($sql)) {
                    Mess("Input successfully deleted");
                }else{
                    errorMess("Input not deleted");
                }
            }
            
            
        } catch (PDOException $e) {
            $message= $e->getMessage();
            errorMess($message);
        }
 }
 if (isset($_POST['add_more'])) {
     $product_id=$_POST["product_id"];
     echo '<input type="hidden" name="product_id" value="'.$product_id.'">
        <div class="form-group">
            <div class="col-md-8">
                <input type="file" name="image" class="form-control image">
            </div>
        </div>
          <div class="text-center">
              <input type="submit" class="btn btn-info" name="adding_image" value="Adding image" >
          </div>
        </div>';
 }
 if (isset($_POST["deleting_image"])) {
     $image_id=$_POST["image_id"];
     try {
         database();
         $sql="DELETE FROM images WHERE image_id=$image_id";
         if($conn->query($sql)){
            Mess("Input successfully deleted");
        }else{
            errorMess("Input not deleted");
        }
     } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
     }
 }
$conn = null;
?>  
