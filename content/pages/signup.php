<!doctype>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                           <a href="../../index.php"><span class="fa fa-home fa-default"></span>Home</a>
                       </li>
                       <li><a href="#"><span class="fa fa-archive fa-default"></span>Product</a></li>
                    </ul>
                </div>
             </div>
         </nav>
         <p><br></p>
         <div class="container-fluid">
             <div class="row">
                    <div class="col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8 col-md-offset-2 col-md-8  " id="sign_msg" ></div>
             </div>
             <div class="row">
                 <div class="col-md-2"></div>
                 <div class="col-md-8">
                     <div class="panel panel-primary">
                         <div class="panel-heading">
                             Customer Signup form
                         </div>
                         <div class="panel-body">
                             <form action="#" method="post">
                                 <div class="row">
                                     <div class="col-md-6">
                                        <label for="f_name">First Name</label>
                                         <input type="text" name="f_name" class="form-control" id="f_name"  placeholder="First Name">
                                     </div>
                                     <div class="col-md-6">
                                        <label for="l_name">Last Name</label>
                                         <input type="text" name="l_name" class="form-control" id="l_name" placeholder="Last Name">
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        <label for="email">Email</label>
                                         <input type="email" name="email" class="form-control" id="email"  placeholder="Email">
                                     </div>
                                 </div>
                                <div class="row">
                                     <div class="col-md-12">
                                        <label for="password">Password</label>
                                         <input type="password" name="password" class="form-control" id="password"  placeholder="Password">
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        <label for="confirm_password">Confirm Password</label>
                                         <input type="password" name="confirm_password" class="form-control" id="confirm_password"  placeholder="Confirm Password">
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        <label for="mobile">Mobile</label>
                                         <input type="text" name="mobile" class="form-control" id="mobile"  placeholder="Mobile">
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        <label for="address1">Address 1</label>
                                         <input type="text" name="address1" class="form-control" id="address1"  placeholder="Address1">
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        <label for="address2">Address 2</label>
                                         <input type="text" name="address2" class="form-control" id="address2"  placeholder="Address2">
                                     </div>
                                 </div>
                                 <p><br></p>
                                 <div class="row">
                                     <div class="col-md-offset-1 col-md-10">
                                         <input name="signup" type="button" style="float:right;" class="btn btn-lg btn-success" value="Sign Up" id="signup">
                                     </div>
                                 </div>
                             </form>
                         </div>
                         <div class="panel-footer"> </div>
                     </div>
                 </div>
                 <div class="col-md-2"></div>
             </div>
            
         </div>
    </body>
</html>