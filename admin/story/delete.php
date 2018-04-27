<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php 
   if(isset($_GET['idStory'])){
        $image = $_GET['img'];
        $idStory = $_GET['idStory'];
        $sql = "DELETE FROM story WHERE story_id = {$idStory}";
        $query = $conn->query($sql);
        if($query){
           if(!empty($image)){
               if($image != "story-default.jpg") unlink($_SERVER['DOCUMENT_ROOT'].'/files/images/'.$image);
            } 
            header('location: /admin/story/?p=story&tb=Xóa truyện thành công!');
        }
        else {
            $sql4 = "DELETE FROM comment WHERE story_id = {$idStory}";
            $query4 = $conn->query($sql4);
            $image =  $picture;
            // Kiểm tra có hình rồi mới xóa
            if(!empty($image)){
                if($image != "story-default.jpg") unlink($_SERVER['DOCUMENT_ROOT'].'/files/images/'.$image);
            } 
            $query = $conn->query($sql);
            if($query){
                header('location: /admin/story/?p=story&tb=Xóa truyện thành công!');
                die();
            }
            echo $sql4;
            die();
            header('location: /admin/story/?p=story&tb=Xóa truyện thất bại!');

        }
       
    }


?> 
