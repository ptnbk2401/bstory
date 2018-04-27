<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php 
    if(isset($_GET['idCat'])){
        $idCat = $_GET['idCat'];
        $sql1 = "DELETE FROM cat WHERE cat_id = {$idCat}";
        // echo $sql1;die();
        $query1 = $conn->query($sql1);
        // echo $sql1;
        // echo "<br>".$sql2;
        // die();
        
         
        if($query1){
            header('location: /admin/cat/?p=cat&tb=Xóa danh mục thành công!');
        }
        else {
            $sql3 = "SELECT story_id,picture FROM story WHERE cat_id = {$idCat}";
            $query3 = $conn->query($sql3);
            $arName_img = array(); //Mảng chứa id,tên_ảnh của các truyện.
            while($arStory = mysqli_fetch_assoc($query3)){
                $id = $arStory['story_id'];
                $picture = $arStory['picture'];
                $arName_img[$id] = $picture;
            }
            // var_dump($arName_img);die();
            $sql2 = "DELETE FROM story WHERE cat_id = {$idCat}";
            $query2 = $conn->query($sql2);
            if($query2){
                // Xóa thành công tức truyện không chứa khóa ngoại của bảng comment.
                foreach($arName_img as $id => $picture){
                    $image =  $picture;
                    // Kiểm tra có hình rồi mới xóa
                    if(!empty($image)){
                        unlink($_SERVER['DOCUMENT_ROOT'].'/files/images/'.$image);
                    }
                }
                //xóa lại danh mục: 
                $query1 = $conn->query($sql1);
                header('location: /admin/cat/?p=cat&tb=Xóa danh mục thành công!');
                die();
            }
            else {
                // Xóa không thành công tức truyện có chứa khóa ngoại của bảng comment.
                // Xóa bảng comment trước
                foreach($arName_img as $id => $picture){
                    $sql4 = "DELETE FROM comment WHERE story_id = {$id}";
                    $query4 = $conn->query($sql4);
                    if(!$query4){
                        echo $sql4;
                        die();
                    }
                    $image =  $picture;
                    // Kiểm tra có hình rồi mới xóa
                    if(!empty($image)){
                        if(unlink($_SERVER['DOCUMENT_ROOT'].'/files/images/'.$image)){
                            echo "<div class='bg-warning' >{$id} + {$image}</div>";
                        }
                        else "Không tìm thấy ảnh:{$id} + {$image} ";
                    }
                }
               
                // Xóa lại truyện: 
                $query2 = $conn->query($sql2);
                if($query2){
                    // Xóa lại danh mục: 
                    $query1 = $conn->query($sql1);
                    header('location: /admin/cat/?p=cat&tb=Xóa danh mục thành công!');
                    die();
                }
                
            }


            header('location: /admin/cat/?p=cat&tb=Xóa danh mục thất bại!');
            die();
        }

    }


?>