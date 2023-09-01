<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && isset($_GET['post_id'])) {
	$post_id = $_GET['post_id'];
	 
    include_once("data/Post.php");
    include_once("../db_conn.php");
    $post = getByIdDeep($conn, $post_id);
    $category = getCategoryById($conn, $post['category']); 

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - <?=$post['post_title'] ?> </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
      $key = "hhdsfs1263z";
	  include "inc/side-nav.php";

	?>
               
	 <div class="main-table">
         
         <div class="card main-blog-card mb-5">
			  <img src="../upload/blog/<?=$post['cover_url'] ?>" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title"><?=$post['post_title'] ?></h5>
			    <?=$post['post_text'] ?>
			    <hr>
                <p class="card-text d-flex justify-content-between">
                	<b>Category: <?=$category['category']?></b>
                	<small class="text-body-secondary">Date: <?=$post['crated_at'] ?></small>
                </p>
			  </div>
		  </div>
		  
	 </div>
	</section>
	</div>

	 <script>
	 	var navList = document.getElementById('navList').children;
	 	navList.item(1).classList.add("active");
	 </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php }else {
	header("Location: ../admin-login.php");
	exit;
} ?>