<html>
<head>
<title><?php echo $username["name"]?>'s Appointments</title>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
</script>

</head>
<style>
a {
	color:white;
	text-decoration: none;
}
button a 
{
	text-decoration: none;
}

h5 a
{
	color:black;
}
#logout
{
	margin-left: 800px;
	margin-top: 20px;
}
</style>
<body>
<?php  
date_default_timezone_set("America/Los_Angeles");
$today = date("F j, Y"); 
?>
<div class="container">
<button class="btn btn-primary" action="/" id="logout"><a href="/">Logout </a></button>
<h3> Welcome, <?php echo $username["name"]?>!</h3>

<h3> Here are your appointments for today, <?php  echo $today ?>:
		
		
		<table class="table class table-bordered table-striped">
		<h3>Your Appointments for Today</h3>
		<thead>
			<tr>
				<th>Tasks</th>
				<th>Dates</th>
				<th>Time</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 
			foreach($tasks as $task)
			{?>
				<td>
				<?php echo $task['tasks'];?>
				<td>
				<?php echo $task['dates'];?>
				<td>
				<?php echo $task['time'];?>
				<td>
				<?php echo $task['status'];?>
				<td>
				<button class="btn btn-danger"><a href="/Users/edit/<?php echo $task['id'] ?>/">Edit</a></button>
				<button class="btn btn-primary"><a href="/Users/delete/<?php echo $task['id'] ?>/">Delete</a></button>
				</td>
				</tr>
				
				

			<?php } ?>
			
			<table class="table class table-striped table-bordered">
				<h3> Other appointments in the future </h3>
				<thead>
					<tr>
						<th>Tasks</th>
						<th>Date</th>
						<th>Time</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php 

			foreach($othertasks as $othertask)
			{?>
				<td>
				<?php  echo $othertask['tasks'];?>
				<td>
				<?php echo $othertask['dates'];?>
				<td>
				<?php echo $othertask['time'];?>
				<td>
				<?php echo $othertask['status'];?>
				<td>
				<button class="btn btn-danger"><a href="/Users/edit/<?php echo $othertask['id'] ?>/">Edit</a></button>
				<button class="btn btn-primary"><a href="/Users/delete/<?php echo $othertask['id'] ?>/">Delete</a></button>
				</td>
			
				<tr>
				</td>
				</tr>
				
			<?php } ?>
					</tr>
				</tbody>
			</table>
			<h3> Add Appointment </h3>
		<form method="post" action="/Users/add">
		<h3> Date : </h3>
		<input type="date" name="date" id="datepicker" />
		<h3> Time : </h3>
		<input type="time" name="time" />
		<h3> Tasks: </h3>
		<input type="text" name="tasks" placeholder="Walk dogs.." />
		<h3> Status: </h3>
		<input type="text" name="status" placeholder="Pending"/>
		<input type= "submit" name="add" value="Add"  class="btn btn-danger"/>

		</form>
			<?php 
			if($this->session->flashdata("Wrong"))
			{
				echo $this->session->flashdata("Wrong");
			
			}
		?>

</div>
</body>
</html>