<?php
include '../function/function.php';
session_start();
if (!( isset($_SESSION['user_id']) )) {
    header('location:../../index.php');
} 
?>
<!doctype>
<html lang='en'>
    <meta charset='utf-8'>
    <meta name='viewport' ..='width=device-width, initial-scale=1'>
    <head>
        <title>Samnas Store</title>
        <link rel='stylesheet' href='../fontawesome/css/font-awesome.min.css'>
        <link rel='stylesheet' href='../css/bootstrap.min.css'>
        <link rel='stylesheet' href='../css/main.css'>
        <link rel='stylesheet' href='../css/animate.css'>
        
       <script src='../js/jquery-1.10.2.js'></script>
        <script src='../js/main.js'></script>
        <script src='../js/bootstrap.js'></script>
        <script src='../js/wow.min.js'></script>
    </head>
    <body>
       <nav class='navbar navbar-inverse mynav'>
           <div class='container'>
               <div class='navbar-header'>
                   <a href='#' class='navbar-brand'>
<!--                       <img src='#' alt='#'>-->
                  Samnas
                   </a>
                   <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#mine'>
                        <span class='fa fa-bars fa-2x'></span>
                    </button>
               </div>
               <div class='collapse navbar-collapse' id='mine'>
                   <ul class='nav navbar-nav'>
                       <li>
                           <a href='../../index.php'><span class='fa fa-home fa-default'></span>Home</a>
                       </li>
                       <li><a href='#'><span class='fa fa-archive fa-default'></span>Product</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <p><br></p>
        <div class='container-fluid'>
           <div class='row'>
               <div class='col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2' id='errorM'></div>
           </div>
            <div class='row'>
                <div class='col-md-2 col-sm-2 col-xs-2'></div>
                <div class='col-md-8 col-sm-8'>
                    <div class='panel panel-primary'>
                        <div class='panel-heading'></div>
                        <div class='panel-body'>
                            <div class='row'>
                                <div class='col-md-2 col-sm-2 col-xs-2'>
                                    <b>Action</b>
                                </div>
                                <div class='col-md-2 col-sm-2 col-xs-2'>
                                    <b>Product Image</b>
                                </div>
                                <div class='col-md-2 col-sm-2 col-xs-2'>
                                    <b>Product Name</b>
                                </div>
                                <div class='col-md-2 col-sm-2 col-xs-2'>
                                    <b>Quantity</b>
                                </div>
                                <div class='col-md-2 col-sm-2 col-xs-2'>
                                    <b>Product Price</b>
                                </div>
                                <div class='col-md-2 col-sm-2 col-xs-2'>
                                   <b> Price in #</b>
                                </div>
                            </div>
                            <br>
                            <div id="cart_checkout"></div>
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-sm">
                                   <!--modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button class="close" data-dismiss="modal" type="button">&times;</button>
                                            <h4>More Information on Item</h4>
                                        </div>
                                        <!--modal body-->
                                        <div class="modal-body" id="modal-body">
                                            <!--<div class="row">
                                               <div class="col-md-8">
                                                    <img src="content/img/cr7.JPG" class="img-thumbnail img"  alt="Cristiano Ronaldo">
                                                </div> 
                                            </div>
                                            <div class="row">
                                               <div class="col-md-12">
                                                    <h3 class="text-right">Description</h3>
                                                    <hr>
                                                    <p>
                                                        These two arrays could be combined into one multidimensional array like so:These two arrays could be combined into These two arrays could be combined into one multidimensional array like so: one multidimensional array like so:These two arrays could be combined into one multidimensional array like so: These two arrays could be combined into one multidimensional array like so:These two arrays could be combined into These two arrays could be combined into one multidimensional array like so: one multidimensional array like so: These two arrays could be combined into These two arrays could be combined into one multidimensional array like so: one multidimensional array like so:
                                                    </p>
                                                </div> 
                                            </div>-->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class='row'>
                                <div class='col-md-2'>
                                    <div class='btn-group'>
                                        <a href='#' class=' btn btn-danger'><span class='fa fa-trash'></span></a>
                                        <a href='#' class=' btn btn-primary'><span class='fa fa-check-circle-o'></span></a>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <img src='../img/G-shock.png' alt='G-shock wrist watch' class='img img-thumbnail' width='50px' height='40px'>
                                </div>
                                <div class='col-md-2'>
                                    Price in $
                                </div>
                                <div class='col-md-2'>
                                    <input type='text' class='form-control' value='1'>
                                </div>
                                <div class='col-md-2'>
                                    <input type='text' class='form-control' value='5000' disabled >
                                </div>
                                <div class='col-md-2'>
                                    <input type='text' class='form-control' value='5000' disabled >
                                </div>
                                
                            </div>-->
                            
                        <div class='panel-footer'></div>
                    </div>
                </div>
                <div class='col-md-2 col-sm-2 col-xs-2'></div>
            </div>
        </div>
    </body>
</html>