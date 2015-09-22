<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
	<style>
		body
		{
			text-align: center;
		}
		a{
			color:white;
		}	
		#back
		{
			margin-left: 150px;
			margin-top: -73px;
		}
	</style>
<body>
	<div class="container">
	<h3> Edit Your Appointments </h3>
<form action='/Users/update' method='post'>
			<input type='hidden' name='id' value ="<?= $tasks['id'] ?>">
			<p>Task:<br><input type='text' name='tasks' value = "<?= $tasks['tasks'] ?>"></p>
			<p>Time:<br><input type='text' name='time' value = "<?= $tasks['time']  ?>"></p>
			<p>Date:<br><input type='text' name='dates' value = "<?= $tasks['dates']  ?>"></p>
			<p>Status:<br><input type='text' name='status' value = "<?= $tasks['status']?>"></p>
			<p><input type='submit' value='Update' class="btn btn-primary"></p>
		</form>
		<button class="btn btn-danger" id="back"><a href="/Users/profile">Back</a></button>
	

		
</div>
</body>
</html>