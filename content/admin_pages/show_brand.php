<?php
include "../function/function.php";
include "../function/views.php";
session_start();
if (!( isset($_SESSION["admin_id"]) )) {
    header("location:login.php");
}
$value='<div class="panel panel-info">
                <div class="panel-heading"><h4>Categories</h4></div>
                <div class="panel-body">
                   <table class="table table-stripped table-responsive" id="brand_table">
                    
                  </table>
                    
                </div>
                <div class="panel-footer">
                  <div class="row" style="background-color:transparent;">
                               
                                   <div class="col-md-4"><h4>&copy;2017</h4></div>
                                     <div class="text-right col-md-8">
                                         <ul class="pagination pagination-success" id="brandPageNo">
                                         
                                          </ul>
                                     </div>
                               </div>
                </div>
              </div>';
              views($value);
?>

<!-- 
 -->