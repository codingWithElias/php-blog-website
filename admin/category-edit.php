<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && $_GET['id']) {
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Category Edit</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
      $key = "hhdsfs1263z";
      $id = $_GET['id'];
	  include "inc/side-nav.php"; 
      include_once("data/Category.php");
      include_once("../db_conn.php");
      $categoryx = getById($conn, $id);

      if (isset($_GET['category'])) {
      	$category = $_GET['category'];
      }else {
      	$category = $categoryx['category'];
      	$category_id = $categoryx['id'];
      }

	?>
               
	 <div class="main-table">
	 	<h3 class="mb-3">Edit
	 		<a href="Category.php" class="btn btn-success">Category</a></h3>
	 	<?php if (isset($_GET['error'])) { ?>	
	 	<div class="alert alert-warning">
			<?=htmlspecialchars($_GET['error'])?>
		</div>
	    <?php } ?>

        <?php if (isset($_GET['success'])) { ?>	
	 	<div class="alert alert-success">
			<?=htmlspecialchars($_GET['success'])?>
		</div>
	    <?php } ?>
        <form class="shadow p-3" 
    	      action="req/Category-edit.php" 
    	      method="post">

		  <div class="mb-3">
		    <label class="form-label">Category</label>
		    <input type="text" 
		           class="form-control"
		           name="category"
		           value="<?=$category?>">
		    <input type="text" 
		           class="form-control"
		           name="id"
		           value="<?=$category_id?>"
		           hidden>
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Create</button>
		</form>
	 	
	 </div>
	</section>
	</div>

	 <script>
	 	var navList = document.getElementById('navList').children;
	 	navList.item(2).classList.add("active");
	 </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php }else {
	header("Location: ../admin-login.php");
	exit;
} ?>