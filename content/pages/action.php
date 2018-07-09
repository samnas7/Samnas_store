<?php
session_start();
include "../function/function.php";

/*for brands display */
if(isset($_POST["brands"])){
    try{
        database();
        $sql="select * from brands";
        $user=$conn->query($sql);
        
        echo '<ul class="nav nav-pills nav-stacked">';
        
        foreach($user as $row){
            $brand_id=$row['brand_id'];
            $brand_title=$row['brand_title'];
            echo  "<li><a class='brand' brand_id='$brand_id'  href='#'> $brand_title</a></li>";
        }
        
        echo '</ul>';
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
/*for category display*/
if(isset($_POST["category"])){
    try{
        database();
        $sql="select * from categories";
        $user=$conn->query($sql);
        
        echo '<ul class="nav nav-pills nav-stacked">';
        
        foreach($user as $row){
            $cat_id=$row['cat_id'];
            $cat_title=$row['cat_title'];
            echo  "<li><a class='category' cat_id='$cat_id' href='#'> $cat_title</a></li>";
        }
        echo '</ul>';
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}



/*for displaying product*/
if(isset($_POST["getProduct"]) || isset($_POST["get_selected_brand"]) || isset($_POST["get_selected_category"]) || isset($_POST['search'])){
    try{
            
        database();
        if(isset($_POST['getProduct'])){#check if get product is set
        $limit=9;
        if(isset($_POST["setPage"])){
            $pageNum=$_POST["pageNum"];
            $start=($limit*$pageNum)-$limit;
          }else{
            $start=0;
          }
        $sql="Select * from products LIMIT $start,$limit";
        }
        else if(isset($_POST['get_selected_category'])){#check if get selected category is set
            $cat_id=$_POST['cat_id'];
        $sql="SELECT * FROM products WHERE product_cat='$cat_id'";
        }else if(isset($_POST['get_selected_brand'])){#check if get selected BRAND IS set
            $brand_id=$_POST['brand_id'];
        $sql="SELECT * FROM products WHERE product_brand='$brand_id'";
        }else if(isset($_POST['search']) ){#check if SEARCH BTN is set
            $keyword=strtolower($_POST['keyword']);
        $sql="SELECT * FROM products WHERE LCASE(product_keywords) LIKE '%$keyword% ' OR LCASE(product_keywords) LIKE '$keyword%' OR LCASE(product_keywords) LIKE '%$keyword'  ";
        }
        $user=$conn->query($sql);
        foreach($user as $row){
            $product_id=$row["product_id"];
            $product_cat=$row["product_cat"];
            $product_brand=$row["product_brand"];
            $product_title=$row["product_title"];
            $product_price=$row["product_price"];
            $product_image=$row["product_image"];
            $product_keywords=$row["product_keywords"];
            
            echo "<div class='col-md-4'>
                               <div class=' panel panel-info'>
                                   <div class=' panel-heading'><b>$product_title</b><b style='float:right;'>#$product_price.00</b></div>
                                   <div class=' panel-body'>
                                   <div class=' text-center'>
                                       <img src='content/img/$product_image' class='img-thumbnail img-responsive' style='width:160px; height:250px;' alt='$product_keywords'></div>
                                   </div>
                                   <div class='panel-footer'>
                                   <div class='row' style='background-color:transparent;'><a product_id='$product_id' id='addProduct' class='btn btn-danger col-md-offset-2 col-md-6 col-xs-12' style='float:right;'><span class='fa fa-cart-plus'></span> Add To Cart</a>
                                   <a product_id='$product_id' id='viewProduct' data-target='#myModal' data-toggle='modal' class='btn btn-info col-md-4 col-xs-12' style='float:left;'><span class='fa fa-cart-plus'></span>View More</a></div>
                                   </div>
                               </div>
                           </div>";
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

/*adding product to cart*/
if(isset($_POST["addProduct"])){
    $product_id=$_POST["product_id"];
    $user_id= $_SESSION["user_id"];

    try{
        database();
        $sql=$conn->prepare("SELECT * FROM cart WHERE p_id='$product_id' AND user_id='$user_id' ");
        $sql->execute();
        $row=$sql->rowCount();
        if($row > 0){
           $message=  "product already added to cart Please Coutinue shopping ";
            errorMess($message); 
        }
        else{
            $sql=$conn->prepare("SELECT * FROM products WHERE product_id ='$product_id'");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);
            $id =$row["product_id"];
            $product_price =$row["product_price"];
            $sql="INSERT INTO cart VALUES(NULL,'$product_id',NULL,'$user_id',
            '','$product_price')";
            if ($conn->exec($sql)) {
                $message= "Product added";
                Mess($message);
            } else {
                $message= "Product not added";
                errorMess($message);
            }
        }
        

    }catch(PDOException $e){
        $message= $e->getMessage();
        errorMess($message);
    }
}

/*print out cart*/
if (isset($_POST["get_cart_product"]) || isset($_POST["cart_checkout"])  ) {
    $user_id=$_SESSION["user_id"];
    try{  
        database();     
        $sql="SELECT * FROM cart WHERE user_id='$user_id'";
        $user=$conn->query($sql);
        $n=1;
        $all_total_amnt=0;
        foreach ($user as $key) {
            $id=$key["id"];
            $p_id=$key["p_id"];
            $qty=$key["qty"];
            $total_amount=$key["total_price"];
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
               

            
            if(isset($_POST["get_cart_product"] )){
                echo "<div class='row' style='background-color: transparent;'>
                        <div class='col-md-3 col-xs-3'>$n</div>
                        <div class='col-md-3 col-xs-3'>
                                       <img src='content/img/$product_image' class='img-thumbnail img-responsive' style='width:100px; height:80px;' alt=''></div>
                        <div class='col-md-3 col-xs-3'>$product_title </div>
                        <div class='col-md-3 col-xs-3'>  #$product_price.00</div>
                    </div> <br>";
                $n=$n+1;
            }if(isset($_POST["cart_checkout"])){
                echo "<div class='row'>
                                <div class='col-md-2 col-sm-2 col-xs-2 '>
                                    <div class='btn-group'>
                                        <a href='' cart_id='$id' p_id='$p_id' class='btn btn-danger' id='delete'><span class='fa fa-trash'></span></a>
                                        <a href='' cart_id='$id' p_id='$p_id' class='btn btn-success' id='adding'><span class='fa fa-check-circle-o'></span></a>
                                        <a href='' cart_id='$id' p_id='$p_id' class='btn btn-primary' id='info' data-target='#myModal' data-toggle='modal'><span class='fa fa-info'></span></a>
                                    </div>
                                </div>
                                <div class='col-md-2 col-sm-2 col-xs-2 '>
                                    <img src='../img/$product_image' alt='G-shock wrist watch' class='img img-thumbnail' width='50px' height='40px'>
                                </div>
                                <div class='col-md-2 col-sm-2 col-xs-2 '>
                                    $product_title
                                </div>
                                <div class='col-md-2 col-sm-2 col-xs-2 '>
                                    <input type='text' class='form-control qty' id='qty-$p_id' p_id='$p_id' value='$qty'>
                                </div>
                                <div class='col-md-2  col-sm-2 col-xs-2 '>
                                    <input type='text' class='form-control price' id='price-$p_id' p_id='$p_id'  value='$product_price' disabled>
                                </div>
                                <div class='col-md-2  col-sm-2 col-xs-2 '>
                                    <input type='text' class='form-control total' id='total-$p_id' p_id='$p_id' value='$total_amount' disabled>
                                </div>
                            </div>";
            }
            $all_total_amnt+=$total_amount;
        }
        if(isset($_POST["cart_checkout"])){
            echo "<div class='row'>
                                <div class='col-md-6 col-md-offset-6'>
                                    <h4>TOTAL AMOUNT OF ITEM IS #<b id='total_amt'>$all_total_amnt</b></h4>
                                </div>
                            </div>
                        </div>";
        }
    }catch(PDOException $e){
       $message= $e->getMessage();
        errorMess($message);
    }

}

if (isset($_POST["deleteCart"])) {
    $cart_id=$_POST["cart_id"];
    try{
        database();
        $sql="DELETE FROM cart WHERE id='$cart_id'";
        $query=$conn->exec($sql);
        if($query){
           $message= "Record deleted successfully";
           Mess($message); 
        }else{
            $message= "Record deleted unsuccessfully";
           erorrMess($message);
        }
    }catch(PDOException $e){
        $message= $e->getMessage();
        errorMess($message);
    }
} 

if(isset($_POST["cartInfo"])) {
    $cart_id=$_POST["cart_id"];
    $p_id=$_POST["p_id"];
    try{
        database();
        $sql=" SELECT * FROM  products WHERE product_id='$p_id' ";
        $user=$conn->query($sql);
        foreach($user as $row){
            $product_id=$row["product_id"];
            $product_cat=$row["product_cat"];
            $product_brand=$row["product_brand"];
            $product_title=$row["product_title"];
            $product_price=$row["product_price"];
            $product_image=$row["product_image"];
            $product_keywords=$row["product_keywords"];

            echo "<div class='row'>
                               <div class='col-md-8 col-md-offset-2'>
                                    <div class=' text-center'>
                                       <div id='mycarousel' class='carousel slide' data-ride='carousel'>
        <!-- indicators -->
            <ol class='carousel-indicators'>
                <li data-target='#mycarousel' data-slide-to='0' class='active'></li>";
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
                
                <div class='item active'>
                    <div class='carousel-caption' style='position: relative; right: 0px; left:0px;'>
                        <div >
                            <img src='../img/$product_image' class='img-thumbnail img' height='80px;' alt='$product_keywords'/> 
                        </div>
                    </div>
                </div>
                ";
                $user=array_from_db($product_id,"images");
                
                foreach ($user as $key) {
                    $image_title=$key["image_title"];
                    $image_id=$key["image_id"];

                    echo "
                    <div class='item'>
                    <div class='carousel-caption' style='position: relative; right: 0px; left:0px;'>
                        <div>
                            
                            <img src='../img/$image_title'  class='img-thumbnail img' height='80px;' alt='$product_keywords'/>
                            
                        </div>
                        
                    </div>
                </div>
                    ";
                }
            echo "</div>

                <!--/.carousel-inner-->
                    <a class='right carousel-control hidden' href='#mycarousel' data-slide='prev' role='button'>
                        <i class='fa fa-angle-left fa-3x' aria-hidden='true'></i>
                    </a>
                    <a class='right carousel-control hidden' href='#mycarousel' data-slide='next' role='button'>
                        <i class='fa fa-angle-right fa-3x' aria-hidden='true'></i>
                    </a>     
    </div>
                                </div> 
                            </div>
                            <div class='row'>
                               <div class='col-md-12'>
                                        <h3> <b>Description </b></h3>
                                        <h3 class='text-right' style='text-align:right'><b>#$product_price.00</b></h3>
                                    <hr>
                                    <h2>$product_title</h2>
                                    <p> $product_keywords</p>
                                </div> 
                            </div>";
        }
    }catch(PDOException $e){
        $message= $e->getMessage();
        errorMess($message);
    }
}

if(isset($_POST["cartAdding"])){
    $cart_id=$_POST["cart_id"] ;
    $p_id=$_POST["p_id"] ;
    $qty=$_POST["qty"] ;
    $total=$_POST["total"];
    try{
        database();
        $sql="UPDATE cart SET qty='$qty', total_amount='$total' WHERE p_id=$p_id AND id=$cart_id ";
				$stmt=$conn->prepare($sql);
		if ($stmt->execute()){
        Mess("Input update successfully ");
        }else{
            errorMess("Input update unsuccessfully ");
        }

    }  catch(PDOException $e){
        $message= $e->getMessage();
        errorMess($message);
    }  
    
}

if(isset($_POST["page"])){
    try{
        database();
        $sql=$conn->prepare("SELECT * FROM products ");
        $sql->execute();
        $row=$sql->rowCount();
        $pageNo= ceil( $row/9);
        for ($i=1; $i <= $pageNo; $i++) { 
            echo "<li><a href='#' page='$i' id='pageLink'>$i</a></li>";
        }
    }catch(PDOException $e){
        $message= $e->getMessage();
        errorMess($message);
    }
}

/*cart count */
if(isset($_POST["cart_count"]) && isset($_SESSION["user_id"]) ){
    $user_id= $_SESSION["user_id"];
    try{
        database();
        $sql=$conn->prepare("SELECT * FROM cart WHERE user_id='$user_id' ");
        $sql->execute();
        $row=$sql->rowCount();
            echo $row;
    }
    catch(PDOException $e){
        $message= $e->getMessage();
        errorMess($message);
    }
}
if (isset($_POST["viewProduct"])) {
    $product_id=$_POST['product_id'];
    /*
Full texts  
product_id
product_brand
product_cat
product_title
product_price
product_desc
product_image
product_keywords*/
    try {
        database();
        $sql=$conn->prepare("SELECT * FROM products WHERE product_id='$product_id' ");
        $sql->execute();
        $row=$sql->rowCount();
        if ($row==1) {
            $result=$sql->fetch(PDO::FETCH_ASSOC);
            $product_brand=$result['product_brand'];
            $product_title=$result['product_title'];
            $product_cat=$result['product_cat'];
            $product_price=$result['product_price'];
            $product_desc=$result['product_desc'];
            $product_image=$result['product_image'];
            $product_keywords=$result['product_keywords'];

            $sql2=$conn->prepare("SELECT * FROM brands WHERE brand_id='$product_brand'");
            $sql2->execute();
            $row2=$sql2->rowCount();

            $sql3=$conn->prepare("SELECT * FROM categories WHERE cat_id='$product_cat'");
            $sql3->execute();
            $row3=$sql3->rowCount();
            if ($row2!=1 && $row3!=1) {
                errorMess("Does not exist in the db or too much record");
            }else{
            $result2=$sql2->fetch(PDO::FETCH_ASSOC);
            $brand_title=$result2['brand_title'];

                $result3=$sql3->fetch(PDO::FETCH_ASSOC);
            $cat_title=$result3['cat_title'];
                echo "<h4><b>$product_title</b><b style='float:right;'>$brand_title  $cat_title</b></h4>
<div id='mycarousel' class='carousel slide' data-ride='carousel'>
        <!-- indicators -->
            <ol class='carousel-indicators'>
               <li data-target='#mycarousel' data-slide-to='0' class='active'></li>";
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
                
                <div class='item active'>
                    <div class='carousel-caption' style='position: relative; right: 0px; left:0px;'>
                        <div >
                            <img src='content/img/$product_image' class='img-thumbnail img' height='80px;' alt='$product_keywords'/> 
                        </div>
                    </div>
                </div>
                ";
                $user=array_from_db($product_id,"images");
                
                foreach ($user as $key) {
                    $image_title=$key["image_title"];
                    $image_id=$key["image_id"];

                    echo "
                    <div class='item'>
                    <div class='carousel-caption' style='position: relative; right: 0px; left:0px;'>
                        <div>
                            
                            <img src='content/img/$image_title'  class='img-thumbnail img' height='80px;' alt='$product_keywords'/>
                            
                        </div>
                        
                    </div>
                </div>
                    ";
                }
           echo "</div>

                <!--/.carousel-inner-->
                    <a class='right carousel-control hidden' href='#mycarousel' data-slide='prev' role='button'>
                        <i class='fa fa-angle-left fa-3x' aria-hidden='true'></i>
                    </a>
                    <a class='right carousel-control hidden' href='#mycarousel' data-slide='next' role='button'>
                        <i class='fa fa-angle-right fa-3x' aria-hidden='true'></i>
                    </a>     
    </div>
        <h3><i class='' style='float:right;'>#$product_price</i><i class='text-right'>Description</i></h3>
        <p>
            $product_keywords
        </p><p>
            $product_desc
        </p>";
            }

            

        }
    } catch (PDOException $e) {
        $message= $e->getMessage();
        errorMess($message);
    }
    
}
?>