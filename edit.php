<?php

function __autoload($class){
	include_once($class.".php");
}

$model= new model("model.php");

if(empty($_REQUEST['uid'])){
	header("Location:index.php");
}

if(isset($_REQUEST['update'])){
	extract($_REQUEST);
	if($model->update($id,$fname,$mname,$lname,"user")){
		header("Location:index.php?status=Data Successfully Updated");
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD APPLICATION</title>
</head>
<body>
	<br/><h3>Update Record</h3><br/><br/>
<?php
extract($model->getById($_REQUEST['uid'],"user"));
echo @<<<show
	<form action="edit.php" method="post">
		<label>User ID:</label><br/>
		<input type="number" name="id" min="1" value="$u_id" readonly><br/><br/>
		<label>First Name:</label><br/>
		<input type="text" name="fname" min="1" value="$fname"><br/><br/>
		<label>Middle Name:</label><br/>
		<input type="text" name="mname" min="1" value="$mname"><br/><br/>
		<label>First Name:</label><br/>
		<input type="text" name="lname" min="1" value="$lname"><br/><br/>
		<input type="submit" name="update" value="Update Record">
		<a href="index.php"><input type="button" name="cancel" value="cancel"></a>
	</form>
show;
?>
</body>
</html>