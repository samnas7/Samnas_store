<?php 
 function views($value="")
{
	echo '<!doctype>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>Samnas Store</title>
        <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/mine.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/animate.css">
        <style type="text/css">
          #modal-body .row{
          background-color: transparent;margin:0px;padding:0px;
          }
        </style>
    </head>
    <body>
      <div id="wrapper">
      <div id="sidebar-wrapper" >
        <ul class="sidebar-nav">
          <li class="sidebar-list">
            <a href="admin.php" class="sidebar-link">
              <div class="menu-logo">
                <span class="fa fa-home"></span>
              </div>
              <div class="menu-name">
                <span>Home</span>
              </div>
            </a>
          </li>
          <li class="sidebar-list">
            <a href="show_brand.php" class="sidebar-link">
              <div class="menu-logo">
                <span class="fa fa-thumb-tack"></span>
              </div>
              <div class="menu-name">
                <span>Brand</span>
              </div>
            </a>
          </li>
          <li class="sidebar-list">
            <a href="show_category.php" class="sidebar-link">
              <div class="menu-logo">
                <span class="fa fa-wrench"></span>
              </div>
              <div class="menu-name">
                <span>Category</span>
              </div>
            </a>
          </li><!-- -->
          <li class="sidebar-list">
            <a href="show_product.php" class="sidebar-link">
              <div class="menu-logo">
                <span class="fa fa-wrench"></span>
              </div>
              <div class="menu-name">
                <span>Product</span>
              </div>
            </a>
          </li><li class="sidebar-list">
            <a href="show_cart.php" class="sidebar-link">
              <div class="menu-logo">
                <span class="fa fa-wrench"></span>
              </div>
              <div class="menu-name">
                <span>Cart</span>
              </div>
            </a>
          </li>
          <li class="sidebar-list">
            <a href="show_admin.php" class="sidebar-link">
              <div class="menu-logo">
                <span class="fa fa-wrench"></span>
              </div>
              <div class="menu-name">
                <span>Adminstrator</span>
              </div>
            </a>
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
          <!-- navbar -->   
          <nav class="navbar mynav">
            <div class="container-fluid">
              <div class="navbar-header"> 
              <!-- toggle button -->
                <!-- <div id="toggle-holder">
                </div> -->  
                  <a href="#" id="toggle-butn">
                    <span style="color: #fff; background:#444; " class="fa fa-2x fa-bars"></span>
                  </a>    
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="fa fa-2x fa-bars" style="color: #fff; font-size: x-large;"></span> 
                </button>
                <a href="#" class="navbar-brand">
                  <img src="../img/sbo.jpg" alt="Logo" class="img" style="width: 30px; height:30px;">
                </a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li><a href="../../index.php">Home</a></li>
                  <li><a href="add_product.php" >Add Product</a></li>
                  <li><a href="#" id="add_brand" data-target="#add_modal" data-toggle="modal">Add Brand</a></li>
                  <li><a href="#" id="add_category" data-target="#add_modal" data-toggle="modal">Add Category</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li>
                    <a href="#" class="dropdown-toggle" style="color: #fff" data-toggle="dropdown">
                      <span class="fa fa-user fa-2x"></span><b> <?php echo $_SESSION["admin_name"]; ?></b>
                      <span class="fa fa-sort-down"></span>
                    </a>
                    <ul class="dropdown-menu" style="background-color: #444">
                      <li><a href="#" id="changing_password" data-target="#myModal_admin" data-toggle="modal">Change Password</a></li>
                      <li><a id="change_admin_Info" data-target="#myModal_admin" data-toggle="modal">Change Admin Info</a></li>
                      <li><a id="add_admin_Info" data-target="#myModal_admin" data-toggle="modal">Add Admin Info</a></li>
                      <li><a href="logout.php">Logout</a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
          <div class="col-md-10 col-xs-10 col-offset-md-1" id="message">
             

            </div>
            <div class="well" style="border: none;">
              <div id="myModal_admin" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-sm">
                                   <!--modal content-->
                                    <div class="modal-content modal-info">
                                        <div class="modal-header">
                                            <button class="close" data-dismiss="modal" type="button">&times;</button>
                                            <h4> Information </h4>
                                        </div>
                                        <!--modal body-->
                                        <div class="modal-body bg-info" id="modal-body">
                <form method="post" action="add_to_db.php" id="admin_changing" enctype="multipart/form-data">
    <div class="form-horizontal" id="adding_admin">
        <div  id="changing">
    
    
     </div>
    
     </div>
</form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
              '.$value.'
      </div>
    </div>
    
       <script src="../js/jquery-1.10.2.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/bootstrap.js"></script>
    </body>
</html>';
}
 function modal()
 {
   echo '<div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-sm">
                                   <!--modal content-->
                                    <div class="modal-content modal-info">
                                        <div class="modal-header">
                                            <button class="close" data-dismiss="modal" type="button">&times;</button>
                                            <h4> Information </h4>
                                        </div>
                                        <!--modal body-->
                                        <div class="modal-body bg-info" id="modal-body">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
 }

 ?>
 	