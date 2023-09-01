<?php  
session_start();

if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['username']) && 
	isset($_GET['post_id']) &&
    isset($_GET['publish'])) {
  
  include_once("../db_conn.php");
  $post_id = $_GET['post_id'];
  $publish = $_GET['publish'];
  if ($publish) {
	  $sql = "UPDATE post SET publish=1
	          WHERE post_id=?";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute([$post_id]);
	  $sm = "Successfully publish!"; 
      header("Location: post.php?success=$sm");
      exit;
  }else {
  	$sql = "UPDATE post SET publish=0";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sm = "Successfully unpublish!"; 
    header("Location: post.php?success=$sm");
    exit;
  }

}else {
    header("Location: ../admin-login.php");
    exit;
}