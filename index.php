<!-- Susanne Stenshagen, Silje Lien, Espen Kalstad -->
<?php
	require_once("database/connect.php");
	/*include("search/livesearch.php"); */

	/* Sets a cookie for remembering users sorting preferences */
	$cat = isset($_GET['cat']) ? "?cat={$_GET['cat']}" : "";
	
	/* Sets cookie for rating and gives user newsfeed sorted by popularity */
	if(isset($_GET['order']) AND $_GET['order'] == "rating" ) {
		unset($_COOKIE['orderC']);
		setCookie('orderC', 'rating', time()+(86400*30));
		header("location: index.php$cat");
		
	} /* Sets cookie for date and gives user newsfeed sorted by news recently added */
	elseif(isset($_GET['order']) AND $_GET['order'] == "date"){
		unset($_COOKIE['orderC']);
		setCookie('orderC', null, -1);
		header("location: index.php$cat");
	}	
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
	

	<!-- 
 	<script src="search/search.js"></script>
	 -->
</head>
<body>

	
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Gi gjerne, ikke fjerne</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Hjem <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Logg inn</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Registrer</a>
      </li>
      <li class="nav-item">
        <div class="dropdown">
					<a class="btn dropdown-toggle" href="index.php" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">Sorter</a>

					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item nav-link" href="index.php">Vis alle kategorier</a>
						<?php /* Get all tables from category */
							$query = "SELECT * FROM category ORDER BY category_name";
							$result = $pdo->prepare($query);
							$result->execute();
							$rows = $result->fetchAll();
							foreach ($rows as $row) { 
								/* Variable $get fetches all categories with id and then puts each category as a link for user to click to get newsarticle sorted by category */
								$get = isset($_GET['order']) ? "?cat={$row['category_id']}&order={$_GET['order']}" : "?cat={$row['category_id']}";
								echo "<a href='$get' class='dropdown-item'>{$row['category_name']}</a>";
							}
						?>
					</div>
				</div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input onkeyup="showResult(this.value)" class="form-control mr-sm-2" type="text" placeholder="Søk her">
      <div id="livesearch"></div>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Søk</button>
    </form>
  </div>
</nav>

<!-- <?php if(isset($_SESSION['username'])){ ?>
	<div class="col-12">
	<h3 id="welcomemsg">Welcome back, <?= $_SESSION['username'] ?> </h3> </div>
	<div class="col-2 text-center">
		<a href="news/addnews.php" class="btn btn-secondary">Add news</a></div>	 Only logged in users can add news
<?php } ?>
Only logged in users can see profile and logout button
<?php if(isset($_SESSION['username'])){ ?>
	<div class="col-2 text-center">
		<a href="users/profile.php" class="btn btn-secondary">Profile</a>	</div>
	If it is admin (admin is ranked 1, everyone else is 0)
	<?php if(isset($_SESSION['username']) AND $_SESSION['rank'] == 1) { ?>
		<div class="col-2 text-center">
			<a href="users/admin.php" class="btn btn-secondary">Manage users</a>	</div>	
	<?php }   ?> 			
	Log out
	<div class="col-2 text-center">
		<a href="users/logout.php" class="btn btn-secondary">Log out</a> </div>
<?php }  else { ?>
	Visitors who are not logged in
	<div class="col-2 text-center">	
		<a href="users/login.php" class="btn btn-secondary">Login</a></div>
	<div class="col-2 text-center">	
		<a href="users/login.php" class="btn btn-secondary">Register</a></div>
<?php }?> -->
	
	<div class="container-fluid">
		
			
		<!-- Newsarticles -->
	<div class="row justify-content-center">
		<h2>Finn et matprodukt</h2>
	</div>

	<?php 

			$query = "SELECT * FROM items ORDER BY status";
			$result = $pdo->prepare($query);
			$result->execute();
			/* News articles */
			$rows = $result->fetchAll();
			/* Does not show any HTML if there is no articles to find (if rows are 0) 
				If rows are not 0, the foreach-loop goes through
			*/
			if($result->rowCount() !== 0){


			foreach ($rows as $row) { ?>
				<div class="row justify-content-center">
					<div class="col-2">
						<img id="indeximg" class="img-fluid" src="images/<?=  $row['image'] ?>" />
					</div>
					<div class="col-4">
						<header>
							<a class="link" href="items/items.php?id=<?=$row['item_id']?>"><h3> <?= $row['item_name'] ?> </h3></a>
								<h4><?php 
				if($row['status'] == 1) {
					echo 'Produktet er ikke tilgjengelig lenger';
				} else if($row['status'] == 0)  {
					echo 'Tilgjengelig';
				}; 
									
									
									?> </h4>
								<h5>Hentested: <?= $row['pickup_place'] ?> </h5>
						</header>
							<a href="items/items.php?id=<?=$row['item_id']?>" class="readmore">Finn ut mer om produktet</a>
					</div>
				</div>	
			<?php } 
			} else {
				echo 'This Category is Empty!';
			}
			?>
		
			
	</div>
	<!-- Bootstrap JavaScript plugins, jQuery, and Tether -->
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>