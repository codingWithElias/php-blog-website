<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) 
    && $_GET['comment_id']) {

  $id = $_GET['comment_id'];

  include_once("data/Comment.php");
  include_once("../db_conn.php");
  $res = deleteCommentById($conn, $id);
  if ($res) {
      $sm = "Successfully deleted!"; 
      header("Location: Comment.php?success=$sm");
      exit;
  }else {
    $em = "Unknown error occurred"; 
    header("Location: Comment.php?error=$em");
    exit;
  }

}else {
    header("Location: ../admin-login.php");
    exit;
}