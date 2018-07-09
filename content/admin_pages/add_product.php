<?php
include "../function/function.php";
include "../function/views.php";
session_start();
if (!( isset($_SESSION["admin_id"]) )) {
    header("location:login.php");
}
$value="<form method='post' action='add_to_db.php' enctype='multipart/form-data'>
    <div class='form-horizontal bg-success' id='form_horizontal' >
    
     </div>
</form>
";
views($value);

?>
