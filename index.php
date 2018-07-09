<?php
include "content/function/function.php";
include "content/function/views.php";
session_start();
if ( isset($_SESSION["user_id"]) ) {
    header("location:profile.php");
} 
?>
<!doctype>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>Samnas Store</title>
        <link rel="stylesheet" href="content/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="content/css/mine.css">
        <link rel="stylesheet" href="content/css/bootstrap.min.css">
        <link rel="stylesheet" href="content/css/main.css">
        <link rel="stylesheet" href="content/css/animate.css">
        
       <script src="content/js/jquery-1.10.2.js"></script>
        <script src="content/js/main.js"></script>
        <script src="content/js/bootstrap.js"></script>
        <script src="content/js/wow.min.js"></script>
    </head>
    <body>
      <div id="wrapper">
      <div id="sidebar-wrapper" >
        <ul class="sidebar-nav">
          
          <li class="sidebar-list">
            <a href="#" class="sidebar-link dropdown-toggle" data-toggle="dropdown">
              <div class="menu-logo">
                <span class="fa fa-wrench"></span>
              </div>
              <div class="menu-name">
                <span>Brand</span>
              </div>
            </a>
            <ul class="dropdown-menu" id="get_brand" style="position: relative; background-color: #444;">
            </ul>
          </li>
          <li class="sidebar-list">
            <a href="#" class="sidebar-link dropdown-toggle" data-toggle="dropdown">
              <div class="menu-logo">
                <span class="fa fa-wrench"></span>
              </div>
              <div class="menu-name">
                <span>Category</span>
              </div>
            </a>
            <ul class="dropdown-menu" id="get_category" style="position: relative; background-color: #444;">
            </ul>
          </li><!--  -->
          <li class="sidebar-list" id="collapse-sidebar">
            <a href="#" class="sidebar-link">
              <div class="menu-logo">
                <span class="fa fa-play-circle"></span>
              </div>
              <div class="menu-name">
                <span>Collapse Menu</span>
              </div>
            </a>
          </li>
        </ul>


      </div>
      <div id="content-wrapper">
        <div class="row">
          
          <div class="col-xs-12 col-md-12 col-sm-12" >
          <!-- navbar -->   
           <nav class="navbar mynav">
           <div class="container">
               <div class="navbar-header">
                   <a href="#" id="toggle-butn">
                      <span style="color: #fff; background:#444; " class="fa fa-2x fa-bars"></span>
                    </a>
                   <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-brand">
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
                           <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><span class="fa fa-home fa-default"></span>Home</a>
                       </li>
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
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa  fa-cart-plus fa-default"></span>Cart <span class="badge">0</span></a>
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
                       <li>
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user fa-default"></span>Sign In</a>
                       <ul class="dropdown-menu">
                           <div style="width:300px">
                               <div class="panel panel-primary">
                                   <div class="panel-heading"> Login</div>
                                   <div class="panel-heading">
                                      <label for="email">Email</label>
                                       <input type="email" placeholder="EMAIL" class="form-control" id="useremail" required>
                                      <label for="password">Password</label>
                                       <input type="password" placeholder="PASSWORD" class="form-control" id="userpassword" required>
                                       <p><br></p>
                                       <a href="content/pages/reset-password.php" style="color:#fff">Forget Password</a><p></p><input type="button" value="Login" name="login" id="login" class="btn btn-success">
                                   </div>
                                   <div class="panel-footer" id="msg"></div>
                               </div>
                           </div>
                       </ul>
                       </li>
                       <li><a href="content/pages/signup.php"><span class="fa fa-user fa-default"></span>Sign Up</a></li>
                   </ul>
               </div>
           </div>
       </nav><?php modal(); ?>
       <div class="row" style="background-color: transparent;">
                         <div class="col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8 col-md-offset-2 col-md-8 " id="errorM" ></div>
                    </div>
        <div class="panel panel-info">
                       <div class="panel-heading"><h3>Product </h3></div>
                       <div class="panel-body">
                           <div id="get_product">
                            

                               <!--get product jquery ajax request-->
                               
                           </div>
                           <!--<div class="col-md-4 col-xs-4">
                               <div class="panel panel-info">
                                   <div class="panel-heading">Sony</div>
                                   <div class="panel-body">
                                       <img src="content/img/rose.jpg" class="img-thumbnail" alt="rose for sale">
                                   </div>
                                   <div class="panel-footer">#150,000<button class="btn btn-danger btn-xs" style="float:right;"><span class="fa fa-cart-plus"></span> Add To Cart</button></div>
                               </div>
                           </div>-->
                       </div>
                       <!--<div class="panel-footer">
                           &copy;2017
                       </div>-->
                       <div class="panel-footer">
                           
                           <div class='row' style="background-color: transparent;">
                               
                               <div class='col-md-4'><h3>&copy;2017</h3></div>
                                   <div class="text-right col-md-8">
                                       <ul class="pagination pagination-success" id='pageNo'>
                                       
                                        </ul>
                                   </div>
                           </div>
                       </div>
                   </div>

          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      /*$(document).ready(function() {
            var size=screen.height;
            $('#sidebar-wrapper').height(size+500);
      })*/
    </script>
    </body>
</html>