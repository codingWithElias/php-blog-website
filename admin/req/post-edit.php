<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {

    if(isset($_POST['title']) && 
       isset($_FILES['cover']) && 
       isset($_POST['text'])  &&
       isset($_POST['post_id']) &&
       isset($_POST['cover_url']) ){
      include "../../db_conn.php";
      $title = $_POST['title'];
      $text = $_POST['text'];
      $post_id = $_POST['post_id'];
      $cu = $_POST['cover_url'];

      if(empty($title)){
         $em = "Title is required"; 
         header("Location: ../post-edit.php?error=$em&post_id=$post_id");
         exit;
      }else if(empty($title)){
         $em = "Title is required"; 
         header("Location: ../post-edit.php?error=$em&post_id=$post_id");
         exit;
      } 
    
      $image_name = $_FILES['cover']['name'];

      if($cu != "default.jpg" && $image_name != ""){
           $clocation = "../../upload/blog/".$cu;

           // delete the img
           if (!unlink($clocation)) {
              
           }
      }

      if($image_name != ""){
       $image_size = $_FILES['cover']['size'];
       $image_temp = $_FILES['cover']['tmp_name'];
       $error = $_FILES['cover']['error']; 
       if ($error === 0) {
           if ($image_size > 130000) {
               $em = "Sorry, your file is too large."; 
                header("Location: ../post-edit.php?error=$em&post_id=$post_id");
                exit;
           }else {
              $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
              $image_ex = strtolower($image_ex);

              $allowed_exs = array('jpg', 'jpeg', 'png');


              if (in_array($image_ex, $allowed_exs )) {
                  $new_image_name = uniqid("COVER-", true).'.'.$image_ex;
                  $image_path = '../../upload/blog/'.$new_image_name;
                  move_uploaded_file($image_temp, $image_path);

                  $sql = "UPDATE post SET post_title=?, post_text=?,cover_url=? WHERE post_id=?";
                  $stmt = $conn->prepare($sql);
                  $res = $stmt->execute([$title, $text, $new_image_name, $post_id]);
              }else {
                $em = "You can't upload files of this type"; 
                header("Location: ../post-add.php?error=$em&post_id=$post_id");
                exit;
              }

           }
       }

      }else {
          $sql = "UPDATE post SET post_title=?, post_text=? WHERE post_id=?";
          $stmt = $conn->prepare($sql);
          $res = $stmt->execute([$title, $text, $post_id]);
      }
      
     if ($res) {
          $sm = "Successfully Created!"; 
          header("Location: ../post-edit.php?success=$sm&post_id=$post_id");
          exit;
      }else {
        $em = "Unknown error occurred"; 
        header("Location: ../post-edit.php?error=$em&post_id=$post_id");
        exit;
      }


    }else {
        header("Location: ../post-edit.php&post_id=$post_id");
        exit;
    }


}else {
    header("Location: ../admin-login.php");
    exit;
} 