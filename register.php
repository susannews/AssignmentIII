<!-- Susanne Stenshagen, Silje Lien, Espen Kalstad -->
<?php

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
<body ng-app="">	
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class="col-4" ng-app="">
			<form name="register">
				
				<div class="form-group row">
					<div class="col-12">
						<input  name="firstname" class="form-control" type="text" value="" placeholder="Fornavn" style="text-transform: capitalize;" id="example-text-input">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-12">
						<input name="lastname" class="form-control" type="text" value="" placeholder="Etternavn" style="text-transform: capitalize;" id="example-text-input">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-12">
						<input name="email" class="form-control" type="email" value="" placeholder="E-post" id="example-email-input" ng-model="email" required>
						<p><span ng-show="login.email.$touched && login.email.$invalid">Epost kreves.</span></p>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-12">
						<input name="username" class="form-control" type="text" value="" placeholder="Brukernavn" id="example-text-input">
					</div>
				</div>		
			
				<div class="form-group row">
					<div class="col-12">
						<input class="form-control" name="password" type="password" value="" placeholder="Ditt passord" id="example-password-input" ng-model="password" required>
						<div class="row">
						<input class="form-control" name="password" type="password" value="" placeholder="Ditt passord igjen" id="example-password-input" ng-model="password" required></div>
						<p><span ng-show="login.password.$touched && login.password.$invalid">Passord kreves.</span></p>
					</div>
				</div>
				<div class="form-group row">
				  <div class="col-12">
					 <input class="form-control" type="tel" value="" placeholder="Ditt telefonnummer" id="example-tel-input">
				  </div>
				</div>		
				<div class="col-12">
					<button type="submit" class="btn btn-secondary">Logg inn</button>	
				</div>		

				<div class="row justify-content-md-center">
					<a href="index.php">Tilbake til forsiden</a>
				</div>	
			</form>
			</div>	
		</div>
	</div>
	<!-- Bootstrap JavaScript plugins, jQuery, and Tether -->
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>