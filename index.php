<?php

function __autoload($class){
	include_once($class.".php");
}

$model= new model("model.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD APPLICATION</title>
</head>
<body>
	<br/><a href="insert.php"><input type="button" name="insert" value="Create New Record" style="margin-left: 10%;"></a><br/><br/>
	<table border="1" width="80%" align="center">
		<tr>
			<th>User ID</th>
			<th>First Name</th>
			<th>Middle Name</th>
			<th>Last Name</th>
			<th>Action</th>
		</tr>
<?php
$cur_page=1;
if(isset($_REQUEST['page'])){
	$cur_page=$_REQUEST['page'];
}
foreach($model->showData("user",$cur_page) as $result){
extract($result);

echo <<<show
		<tr>
			<td align="center">$u_id</td>
			<td align="center">$fname</td>
			<td align="center">$mname</td>
			<td align="center">$lname</td>
			<td align="center"><a href="edit.php?uid=$u_id"><input type="button" name="edit" value="Edit"></a>
				<a href="delete.php?uid=$u_id"><input type="button" name="delete" value="Delete"></a></td>
		</tr>
show;
}
?>
	</table>
	<div style="width: 80%;margin-left: 10%;"><br/>
		<?php
		$model->paginate("user",$cur_page);
		?>
	</div>
</body>
</html>