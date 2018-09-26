<?php 
	
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "1234", "todoapp");


	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {

	
	
	if (empty($_POST['title']) && empty($_POST['desc'])) {
			$errors = "Error";
		}else {
		    if (strlen($_POST['title'])>10 && strlen($_POST['title'])<255 && strlen($_POST['desc']<255))
		    {$title = $_POST['title'];
				$desc = $_POST['desc'];
				$query= "INSERT INTO tasks VALUES ('$title','$desc')";
			mysqli_query($db, $query);
			header('location: index.php');
		}
		else{	$errors = "Error";}
		}
	}
if (isset($_GET['del_task'])) {

		mysqli_query($db, "DELETE FROM tasks ");
		header('location: index.php');
	}

if (isset($_GET['remove'])) {	

}

// select all tasks if page is visited or refreshed
$tasks = mysqli_query($db, "SELECT * FROM tasks");

?>
<!DOCTYPE html>
<html>

<head>
	<title>ToDo List App</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<script>function remove() {
    var elem = document.getElementById('res');
    elem.parentNode.removeChild(elem);
    return false;
}</script>
</head>

<body>

	<div class="heading">
		<h2 >ToDo List App</h2>
	</div>


	<form method="post" action="index.php" class="input_form">
		<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<input type="text" required name="title" class="task_input">
		<input type="text" name="desc" class="desc_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn btn">Add Task</button>
		<a href="index.php?del_task=<?php  ?>" class=" btn">remove in sql</a>
			<button  name="remove" o class=" btn" onclick="remove()"  id="remove" >remove</button>
	</form>


		<form method="post" action="index.php" class="resultt_form">
			<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
				<div id="res"></div>	<div class="title "> <?php echo $row['title']; ?> </div>
					<div class="desc "> <?php echo $row['desc']; ?> </div>
					</div>
				</form>
			<?php $i++; } ?>	
		</tbody>
	</table>

</body>
</html>