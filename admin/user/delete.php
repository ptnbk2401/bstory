<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>

<?php 
    if(isset($_GET['idUser'])){
        $idUser = $_GET['idUser'];
        if($idUser == 1){
            header('location: /admin/user/?p=user&tb=Đừng hòng xóa được Admin nhé!  ');
            die();
        }
        else {
            $sql = "DELETE FROM users WHERE id = {$idUser}";
            $query = $conn->query($sql);
            if($query){
                header('location: /admin/user/?p=user&tb=Xóa User thành công!');
            }
            else {
                header('location: /admin/user/?p=user&tb=Xóa User thất bại!');
            }
        }
        

    }


?>