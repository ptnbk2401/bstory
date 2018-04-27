<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php 
   if(isset($_GET['id'])){
        $image = $_GET['img'];
        $id = $_GET['id'];
        $sql = "DELETE FROM slide WHERE ID = {$id}";
        $query = $conn->query($sql);
        if($query){
            if(!empty($image)){
                unlink($_SERVER['DOCUMENT_ROOT'].'/files/slide/'.$image);
                header('location: /admin/slide/?p=slide&tb=Xóa ảnh thành công!');
            } else{
               die("Xóa hình ảnh THẤT BẠI") ;
            }
            
        }
        else {
            header('location: /admin/slide/?p=slide&tb=Xóa truyện thất bại!');
        }

    }


?> 
