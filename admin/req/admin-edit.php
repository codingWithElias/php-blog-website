<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    if(isset($_POST['fname']) && 
       isset($_POST['lname']) &&
       isset($_POST['username'])){

      include "../../db_conn.php";
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $username = $_POST['username'];
      $id = $_SESSION['admin_id'];

      if(empty($fname)){
         $em = "First name is required"; 
         header("Location: ../profile.php?error=$em");
         exit;
      }else if(empty($lname)){
         $em = "Last name is required"; 
         header("Location: ../profile.php?error=$em");
         exit;
      }else if(empty($username)){
         $em = "Username is required"; 
         header("Location: ../profile.php?error=$em");
         exit;
      }
    
      $sql = "UPDATE admin SET first_name=?, last_name=?, username=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$fname,$lname,$username, $id]);
    
      
     if ($res) {
        $_SESSION['username'] = $username;
          $sm = "Successfully edited!"; 
          header("Location: ../profile.php?success=$sm");
          exit;
      }else {
        $em = "Unknown error occurred"; 
        header("Location: ../profile.php?error=$em");
        exit;
      }


    }else {
        header("Location: ../profile.php");
        exit;
    }


}else {
    header("Location: ../admin-login.php");
    exit;
} 