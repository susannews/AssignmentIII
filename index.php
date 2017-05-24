<!-- Susanne Stenshagen, Silje Lien, Espen Kalstad -->
<?php
	require_once("database/connect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gi gjerne, ikke fjerne</title>
	
	<!-- Angular -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	
	<!-- Our stylesheet -->
	<link rel="stylesheet" href="styles/stylesheet.css">
</head>
<body>	
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class="col-4" ng-app="">
				<p>Input something in the input box:</p>
				<p>Name : <input type="text" ng-model="name" placeholder="Enter name here"></p>
				<h1>Hello {{name}}</h1>

				<?php /* Get all tables from category */
					$query = "SELECT * FROM users ORDER BY username";
					$result = $pdo->prepare($query);
					$result->execute();
					$rows = $result->fetchAll();
					foreach ($rows as $row) { 
						/* Variable $get fetches all categories with id and then puts each category as a link for user to click to get newsarticle sorted by category */
						$get = isset($_GET['username']);
						echo "<a href='$get' class='dropdown-item'>{$row['username']}</a>";
					}
				?>
		
			</div>
		</div>
		
		<div class="row justify-content-md-center">
			<a href="login.php">Logg inn her</a>
		</div>	
			
	</div>
	<!-- Bootstrap JavaScript plugins, jQuery, and Tether -->
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>