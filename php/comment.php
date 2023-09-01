<?php 

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])){

	if (isset($_POST['comment']) && isset($_POST['post_id'])) {
        $comment = $_POST['comment'];
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['user_id'];
         include "../db_conn.php";

        if (empty($comment)) {
	    	$em = "Comment is required";
	    	header("Location: ../blog-view.php?error=$em&post_id=$post_id#comments");
		    exit;
        }else {
        	$sql = "INSERT INTO comment(comment, user_id, post_id) 
    	        VALUES(?,?,?)";
	    	$stmt = $conn->prepare($sql);
	    	$stmt->execute([$comment, $user_id, $post_id]);

	    	header("Location: ../blog-view.php?success=successfully commented ;) &post_id=$post_id#comments");
		    exit;
        }
		
	}else {
		header("Location: ../blog.php");
	    exit;
	}
 
}else {
	header("Location: ../blog.php");
	exit;
}