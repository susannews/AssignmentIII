<?php 
	require_once("../database/connect.php");	
	require_once("../database/login-auth.php");

	/* Select news articles and categories */
	$query = "SELECT items.*, category.*, concat(u.firstname, ' ', u.lastname) AS author
	          FROM items
	          LEFT JOIN category ON items.category_id = category.category_id
				 LEFT JOIN users AS u ON news.author = u.user_id
			  WHERE items.item_id = ?
			  GROUP BY items.item_id
			  ";
	$result = $pdo->prepare($query);
	$result->execute([$_GET['item_id']]);
	$row = $result->fetch();
	
	/* Delete newsarticle only if author or admin clicks delete 
	if(isset($_GET['delete']) && ($row['author'] === $_SESSION['id'] || $_SESSION['rank'] == 1)){
		/* Gets 'are you sure' message and if yes, deletes the article and redirects to indexpage 
		if(isset($_GET['areyousure']) && $_GET['areyousure'] == "yes"){
			$query = "DELETE FROM news WHERE news_id = ?";
			$result = $pdo->prepare($query);
			if($result->execute([$row['news_id']])){
				header("location: ../");
			}
		} else { /* if no, nothing happens, user stays on the same page 
			$_GET['areyousure'] = "";
		}
	} */
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


<div class="container-fluid">

<!-- Newsarticles -->
	<div class="row">
	<div class="col-12 text-center space">
	<h2><?= $row['item_name'] ?></h2>
	<h6> <?= $row['name'] ?> </h6>
	<h6> <?= $row['timestamp'] ?> </h6>
	</div>
	<div class="col-5">
		<img id="newsimg" class="img-fluid" src="../images/<?=  $row['image'] ?>" />
	</div>
	<div class="col-6"> <!-- preg_replace: Perform a regular expression search and replace -->
		<p><?= preg_replace("/\n/ui", "<br />", $row['article']) ?></p>
		<hr>
		<p class="margin">Author: <?= $row['author'] ?></p>
		
	</div>
	</div>	
	
	</div>
	<!-- Bootstrap JavaScript plugins, jQuery, and Tether -->
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>