<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
	    <?php 
	    	// Use a default page title if one wasn't provided...
			if (isset($page_title)) { 
					echo $page_title; 
			} else { 
					echo APP_NAME; 
			} 
		?>
	</title>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

  </head>

  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-fixed-top">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php" style="color: #468847;"> <?PHP echo APP_NAME;?> </a>
          <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">

<?php 
	// Dynamically create header menus...

	// Array of labels and pages (without extensions):
	$pages = array (
		'Home' => 'index.php',
		//'About' => '#',
		//'Contact' => '#',
		'Cadastra-se' => 'register.php'
	);

	// The page being viewed:
	$this_page = basename($_SERVER['PHP_SELF']);

	// Create each menu item:
	foreach ($pages as $k => $v) {

		// Start the item:
		echo '<li';

		// Add the class if it's the current page:
		if ($this_page == $v) echo ' class="active"';

		// Complete the item:
		echo '><a href="' . $v . '">' . $k . '</a></li>
		';

	} // End of FOREACH loop.

	// Show the user options:
	if (isset($_SESSION['user_id'])) {

		// Show basic user options:
		// Includes references to some bonus material discussed in Part Four!
		echo '<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="logout.php">Logout</a></li>
				<li><a href="renew.php">Renew</a></li>
				<li><a href="change_password.php">Change Password</a></li>
				<li><a href="favorites.php">Favorites</a></li>
				<li><a href="#">Recommendations</a></li>
			</ul>
		</li>';
		
		// Show admin options, if appropriate:
		if (isset($_SESSION['user_admin'])) {
			echo '<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="add_page.php">Add Page</a></li>
					<li><a href="add_pdf.php">Add PDF</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>';		
		}
		
	} // user_id not set.

?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/container-->
      </div><!--/navbar-->

      <!-- Begin page content -->
      <div class="container">
	
		<div class="row">
			
			<div class="col-3">
				<h3 class="text-success">Conteúdo</h3>
			<div class="list-group">
                            
<?php 
	// Dynamically generate the content links:
	$q = 'SELECT * FROM categories ORDER BY category';
	$r = mysqli_query($dbc, $q);
	while (list($id, $category) = mysqli_fetch_array($r, MYSQLI_NUM)) {
		echo '<a href="category.php?id=' . $id . '" class="list-group-item" title="' . $category . '">' . htmlspecialchars($category) . '
		</a>';
	}
?>
                            

			  <a href="pdfs.php" class="list-group-item" title="PDFs">PDF Guides
			  </a>
			</div><!--/list-group-->

<?php 
	// Should we show the login form?
	if (!isset($_SESSION['user_id'])) {
		require('includes/login_form.inc.php');
	}
?>
			</div><!--/col-3-->
		  
			
		  <div class="col-9">
			<!-- CONTENT -->
