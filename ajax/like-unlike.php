<?php  

session_start();

if (isset($_SESSION['user_id'])  && 
	isset($_SESSION['username']) &&
    isset($_POST['post_id'])){
    
    include "../db_conn.php";
	$user_id = $_SESSION['user_id'];
	$post_id = $_POST['post_id'];
	if (empty($post_id)) {
		echo "...";
	}else {
		$sql = "SELECT * FROM post_like
		        WHERE post_id=? AND liked_by=?";
    	$stmt = $conn->prepare($sql);
    	$res = $stmt->execute([$post_id, $user_id]);
    	if($stmt->rowCount() > 0){
           // unlike
    		$sql  = "DELETE FROM post_like
		            WHERE post_id=? AND liked_by=?";
		    $stmt = $conn->prepare($sql);
		    $res  = $stmt->execute([$post_id, $user_id]);
    	}else {
            $sql  = "INSERT INTO post_like(liked_by, post_id) VALUES(?,?)";
		    $stmt = $conn->prepare($sql);
		    $res  = $stmt->execute([$user_id, $post_id]);
    	}
        
        $sql = "SELECT * FROM post_like
		        WHERE post_id=?";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$post_id]);
    	if($stmt->rowCount() >= 0) echo $stmt->rowCount();
    	else echo "...";
	}

	
    

}else {
	echo "...";
}