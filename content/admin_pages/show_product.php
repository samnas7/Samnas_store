<?php
include '../function/function.php';
include '../function/views.php';
session_start();
if (!( isset($_SESSION['admin_id']) )) {
    header('location:login.php');
}
$value="<div class='panel panel-info'>
                <div class='panel-heading'><h4>Products</h4></div>
                <div class='panel-body'>
                   <table class='table table-stripped table-responsive' id='products_table'>
                    
                  </table>
                    <div id='myModal' class='modal fade' role='dialog'>
                                <div class='modal-dialog modal-sm'>
                                   <!--modal content-->
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button class='close' data-dismiss='modal' type='button'>&times;</button>
                                            <h4>More Information on Item</h4>
                                        </div>
                                        <!--modal body-->
                                        <div class='modal-body' id='modal-body modal_body'>
                <form method='post' action='add_to_db.php' enctype='multipart/form-data'>
    <div class='form-horizontal' id='inside_modal_body' >
    
    
     </div>
</form>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class='panel-footer'>
                  <div class='row' style='background-color:transparent;'>
                               
                                   <div class='col-md-4'><h4>&copy;2017</h4></div>
                                     <div class='text-right col-md-8'>
                                         <ul class='pagination pagination-success' id='pagination_products_page_no'>
                                         
                                          </ul>
                                     </div>
                               </div>
                </div>
              </div>";
views($value);

?>

 

            