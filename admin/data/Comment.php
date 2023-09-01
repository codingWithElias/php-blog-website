<?php 

// Get All 
function getAllComment($conn){
   $sql = "SELECT * FROM comment";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if($stmt->rowCount() >= 1){
   	   $data = $stmt->fetchAll();
   	   return $data;
   }else {
   	 return 0;
   }
}

// getById
function getCommentById($conn, $id){
   $sql = "SELECT * FROM comment WHERE comment_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if($stmt->rowCount() >= 1){
         $data = $stmt->fetch();
         return $data;
   }else {
       return 0;
   }
}

function CountByPostID($conn, $id){
   $sql = "SELECT * FROM comment WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   return $stmt->rowCount();
}
// LIKE count
function likeCountByPostID($conn, $id){
   $sql = "SELECT * FROM post_like WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   return $stmt->rowCount();
}
//isliked
function isLikedByUserID($conn, $post_id, $user_id){
   $sql = "SELECT * FROM post_like WHERE post_id=? AND liked_by=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$post_id, $user_id]);

   if ($stmt->rowCount() > 0) {
      return 1;
   }else return 0;
}
function getCommentsByPostID($conn, $id){
   $sql = "SELECT * FROM comment WHERE post_id=? ORDER BY comment_id desc";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if($stmt->rowCount() >= 1){
      $data = $stmt->fetchAll();
      return $data;
   }else {
       return 0;
   }
}

// Delete By ID
function deleteCommentById($conn, $id){
   $sql = "DELETE FROM comment WHERE comment_id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   if($res){
   	   return 1;
   }else {
   	 return 0;
   }
}
function deleteCommentByPostId($conn, $id){
   $sql = "DELETE FROM comment WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   if($res){
         return 1;
   }else {
       return 0;
   }
}

function deleteLikeByPostId($conn, $id){
   $sql = "DELETE FROM post_like WHERE post_id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   if($res){
         return 1;
   }else {
       return 0;
   }
}