<!doctype>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
      
        <title>Login</title>
        <link rel='stylesheet' href='../fontawesome/css/font-awesome.min.css'>
        <link rel='stylesheet' href='../css/bootstrap.min.css'>
        
        <link rel='stylesheet' href='../css/main.css'>
        <link rel='stylesheet' href='../css/animate.css'>
        
       <script src='../js/jquery-1.10.2.js'></script>
        <script src='../js/main.js'></script>
        <script src='../js/bootstrap.js'></script>
        <script src='../js/wow.min.js'></script>
    </head>
    <body id="bodyContainer">
        <nav class="navbar mynav">
           <div class="container">
               <div class="navbar-header">
                   <a href="../../index.php" class="navbar-brand">
                    <!--img src="#" alt="#">-->Samnas
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
                   <!--<ul class="nav navbar-nav navbar-right">
                       <li><a href="#"><span class="fa fa-user fa-default"></span>Sign Up</a></li>
                   </ul>-->
               </div>
           </div>

       </nav>
       <div class="row">
           <div class=" col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 col-xs-offset-2 col-xs-8 well">
              <div class="message">
                  
              </div>
              <h2>Admin login</h2>
               <form action="" method="post">
                   <div class="form-group">
                       <div class="input-group margin-bottom-sm">
			            	<span class="input-group-addon">
				            	<i class="fa fa-user fa-2x" ></i>
				            	<input type="text" id="admin_name" name="admin_name" placeholder="Admin_name"  class="form-control" required="required"/>
			            	</span>
				        </div>
                   </div>
                   <div class="form-group">
                       <div class="input-group margin-bottom-sm">
			            	<span class="input-group-addon">
				            	<i class="fa fa-lock fa-2x fa-default lock" id="lock"></i>
				            	<input type="password" id="password" name="password" placeholder="Password"  class="form-control password" required="required"/>
			            	</span>
				        </div>
                   </div>
					<div class="form-group" >
                        <h4 style="margin-left: 20px;">
                            <input type="checkbox" id="shp"><i id="txtshp">Show Password</i>
                        </h4>
					</div>
                  <div class="text-center" >
                      <input type="button" name="admin_login" value="Login" id="admin_login" class="btn btn-primary btn-lg">
                  </div>
               </form>
           </div>
       </div>
    </body>
</html>