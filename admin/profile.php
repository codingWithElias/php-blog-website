<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Users</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
      $key = "hhdsfs1263z";
	  include "inc/side-nav.php"; 
      include_once("data/Admin.php");
      include_once("../db_conn.php");
      $admin = getByID($conn, $_SESSION['admin_id']);

	?>
               
	 <div class="main-table">
	 	<h3 class="mb-3">Admin Profile </h3>
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
    	      action="req/admin-edit.php" 
    	      method="post">
          <h3>Change Profile Info</h3>
		  <div class="mb-3">
		    <label class="form-label">First name</label>
		    <input type="text" 
		           class="form-control"
		           name="fname"
		           value="<?=$admin['first_name']?>">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Last name</label>
		    <input type="text" 
		           class="form-control"
		           name="lname"
		           value="<?=$admin['last_name']?>">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Username</label>
		    <input type="text" 
		           class="form-control"
		           name="username"
		           value="<?=$admin['username']?>">
		  </div>
		  <button type="submit" class="btn btn-primary">Change</button>
		</form>

		<form class="shadow p-3 mt-5" 
    	      action="req/admin-edit-pass.php" 
    	      method="post">
          <h3 id="cpassword">Change password</h3>
          <?php if (isset($_GET['perror'])) { ?>	
	 	<div class="alert alert-warning">
			<?=htmlspecialchars($_GET['perror'])?>
		</div>
	    <?php } ?>

        <?php if (isset($_GET['psuccess'])) { ?>	
	 	<div class="alert alert-success">
			<?=htmlspecialchars($_GET['psuccess'])?>
		</div>
	    <?php } ?>
		  <div class="mb-3">
		    <label class="form-label">Current Password</label>
		    <input type="password" 
		           class="form-control"
		           name="cpass">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">New password</label>
		    <input type="password" 
		           class="form-control"
		           name="new_pass">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Confirm password</label>
		    <input type="password" 
		           class="form-control"
		           name="cnew_pass">
		  </div>
		  <button type="submit" class="btn btn-primary">Change password</button>
		</form>
	 	
	 </div>
	</section>
	</div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php }else {
	header("Location: ../admin-login.php");
	exit;
} ?>