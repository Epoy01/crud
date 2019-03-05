<?php

function __autoload($class){
	include_once($class.".php");
}

$model= new model("model.php");


if(isset($_REQUEST['insert'])){
	extract($_REQUEST);
	if($model->insert($id,$fname,$mname,$lname,"user")){
		header("Location:index.php?status=Data Successfully Inserted");
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD APPLICATION</title>
</head>
<body>
	<br/><h3>Create New Record</h3><br/><br/>
	<form action="insert.php" method="post">
		<label>User ID:</label><br/>
		<input type="number" name="id" min="1" value="" required><br/><br/>
		<label>First Name:</label><br/>
		<input type="text" name="fname" value="" required><br/><br/>
		<label>Middle Name:</label><br/>
		<input type="text" name="mname"  value="" required><br/><br/>
		<label>First Name:</label><br/>
		<input type="text" name="lname"  value="" required><br/><br/>
		<input type="submit" name="insert" value="Create New Record">
		<a href="index.php"><input type="button" name="cancel" value="Cancel"></a>
	</form>
</body>
</html>