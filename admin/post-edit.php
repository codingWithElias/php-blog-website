<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && isset($_GET['post_id'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Create Edit</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/side-bar.css">
	<link rel="stylesheet" href="../css/style.css">


    <link rel="stylesheet" href="../css/richtext.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.richtext.min.js"></script>
</head>
<body>
	<?php 
      $key = "hhdsfs1263z";
	  include "inc/side-nav.php"; 
      include_once("data/Post.php");
      include_once("../db_conn.php");
      $post_id =  $_GET['post_id'];
      $post = getById($conn, $post_id);
      $categories = getAllCategories($conn);

	?>
               
	 <div class="main-table">
	 	<h3 class="mb-3">Create New Post
	 		<a href="post.php" class="btn btn-secondary">Posts</a></h3>
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
    	      action="req/post-edit.php" 
    	      method="post"
    	      enctype="multipart/form-data">

		  <div class="mb-3">
		    <label class="form-label">Title</label>
		    <input type="text" 
		           class="form-control"
		           name="title"
		           value="<?=$post['post_title']?>">
		    <input type="text" 
		           class="form-control"
		           name="post_id"
		           value="<?=$post['post_id']?>" 
		           hidden>
		    <input type="text" 
		           class="form-control"
		           name="cover_url"
		           value="<?=$post['cover_url']?>" 
		           hidden>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Cover Image</label>
		    <input type="file" 
		           class="form-control"
		           name="cover">
		     <img src="../upload/blog/<?=$post['cover_url']?>" width="200">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Text</label>
		    <textarea
		           class="form-control text"
		           name="text"><?=$post['post_text']?></textarea>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Category</label>
		    <select name="category" class="form-control">
		    	<?php foreach ($categories as $category) { 
                  
		    	?>
		    	<option value="<?=$category['id']?>"
		    		 <?php  echo ($category['id'] == $post['category']) ? "selected": "" ?>>
		    		<?=$category['category']?></option>
		        <?php } ?>
		    </select>
		    
		  </div>
		  <button type="submit" class="btn btn-primary">Create</button>
		</form>
	 </div>
	</section>
	</div>

	 <script>
	 	var navList = document.getElementById('navList').children;
	 	navList.item(1).classList.add("active");

        $(document).ready(function() {
            $('.text').richText();
        });
	 </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php }else {
	header("Location: ../admin-login.php");
	exit;
} ?>