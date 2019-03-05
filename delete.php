<?php

function __autoload($class){
	include_once($class.".php");
}

$model= new model("model.php");

if(empty($_REQUEST['uid'])){
	header("Location:index.php");
}

if(isset($_REQUEST['delete'])){
	extract($_REQUEST);
	if($model->delete($id,"user")){
		header("Location:index.php?status=Data Successfully Deleted");
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD APPLICATION</title>
</head>
<body>
<?php
extract($model->getById($_REQUEST['uid'],"user"));
echo @<<<show
	<form action="delete.php" method="post">
	<h3>Are you  sure you  want to delete?</h3><br/>
		User ID: $u_id <br/>
		Name: $fname $mname $lname <br/>
		<input type="number" name="id" min="1" value="$u_id" hidden><br/><br/>
		<input type="submit" name="delete" value="Yes, Delete Record">
		<a href="index.php"><input type="button" name="cancel" value="cancel"></a>
	</form>
show;
?>
</body>
</html>