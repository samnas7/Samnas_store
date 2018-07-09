<?php
include "../function/function.php";
session_start();
?>
<!doctype>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" ..="width=device-width, initial-scale=1">
    <head>
        <title>Samnas Store</title>
        <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/animate.css">
        
       <script src="../js/jquery-1.10.2.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/wow.min.js"></script>
    </head>
    <body>
       <nav class="navbar navbar-inverse mynav">
           <div class="container">
               <div class="navbar-header">
                   <a href="#" class="navbar-brand">
<!--                       <img src="#" alt="#">-->
                  Samnas
                   </a>
                   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mine">
                        <span class="fa fa-bars fa-2x"></span>
                    </button>
               </div>
               <div class="collapse navbar-collapse" id="mine">
                   <ul class="nav navbar-nav">
                       <li>
                           <a href="#"><span class="fa fa-home fa-default"></span>Home</a>
                       </li>
                       <li><a href="#"><span class="fa fa-archive fa-default"></span>Product</a></li>
                       <li>
                           <input style="width:300px; margin-top:10px;" type="text" name="search" class="form-control" id="search">
                       </li>
                       <li>
                           <button style="margin-top:10px;margin-left:20px;" name="search_btn" class="btn btn-success" id="search_btn">
                               Search
                           </button>
                       </li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right">
                       <li>
                           <a href="#" class="dropdow-toggle" data-toggle="dropdown"><span class="fa  fa-cart-plus fa-default"></span>Cart <span class="badge">0</span></a>
                           <div class="dropdown-menu" style="width:400px;">
                               <div class="panel panel-success" >
                                   <div class="panel-heading">
                                       <div class="row">
                                           <div class="col-md-3 col-xs-3">
                                               S/No
                                           </div>
                                           <div class="col-md-3 col-xs-3">
                                               Product Image
                                           </div>
                                           <div class="col-md-3 col-xs-3">
                                               product Name
                                           </div>
                                           <div class="col-md-3 col-xs-3">
                                               Price in #
                                           </div>
                                       </div>
                                   </div>
                               </div>    
                           </div>
                       </li>
                       <li><a href=""><span class="fa fa-user fa-default"></span>Hi <?php echo $_SESSION["firstName"]?></a></li>
                   </ul>
               </div>
           </div>
       </nav>
       <p><br></p>
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-1 col-xs-1"></div>
               <div class="col-md-2 col-xs-2" ><!--style="position:fixed;"-->
                   <div id="get_category"></div>
                   <div id="get_brand"></div>
               </div>
               <div class="col-md-8 col-xs-8">
                   <div class="panel panel-info">
                       <div class="panel-heading">Product</div>
                       <div class="panel-body">
                           <div id="get_product">
                               <!--get product jquery ajax request-->
                               
                           </div>
                           
                       </div>
                       <div class="panel-footer">
                           &copy;2017
                       </div>
                   </div>
               </div>
               <div class="col-md-1 col-xs-1"></div>
           </div>
       </div>
    </body>
</html>