<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php 
   if(isset($_GET['id'])){
        $id = $_GET['id'];
        $idStory =$_GET['idStory'];
        $sql = "DELETE FROM comment WHERE id = {$id}";
        $query = $conn->query($sql);
        if($query){
          $sql = "SELECT * FROM comment WHERE story_id = {$idStory}";
          $query = $conn->query($sql);
          $cmt =$query->num_rows ;
          $sql = "UPDATE story SET so_comment = {$cmt} WHERE story_id = {$idStory}";
          $query = $conn->query($sql);
          header('location: /admin/story/xembinhluan.php?p=story&id='.$idStory);
            
        }
        else {
            header('location: /admin/story/xembinhluan.php?p=story&id=id='.$idStory);
        }

    }


?> 
