<?php
include "../function/function.php";
include "../function/views.php";
session_start();
if (!( isset($_SESSION["admin_id"]) )) {
    header("location:login.php");
}
$admin_id=$_SESSION["admin_id"];
$value='<form method="post" action="#">
	<div class="form-horizontal">
		<input type="hidden" name="admin_id" value="$admin_id">
		<div class="form-group">
			<div class="col-md-4 col-xs-12">
				<input type="text" class="form-control" name="admin_name">
			</div>
			<div class="col-md-4 col-xs-12">
				<input type="email" class="form-control" name="email">
			</div>
			<div class="col-md-4 col-xs-12">
				<input type="date" class="form-control" name="dob">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-xs-12">
				<input type="text" class="form-control" name="first_address">
			</div>
			<div class="col-md-4 col-xs-12">
				<input type="email" class="form-control" name="second_address">
			</div>
			<div class="col-md-4 col-xs-12">
				<select name="sex" class="form-control">
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</div>
		</div>
		<div class="text-center">
			<input type="submit" value="Edit Admin" class="btn btn-success" name="edit_admin" id="edit_admin">
		</div>
	</div>
</form>';
views($value);

?>
<!-- 
Full texts	
admin_id
admin_name
sex
email
DOB
first_address
second_address
password -->
